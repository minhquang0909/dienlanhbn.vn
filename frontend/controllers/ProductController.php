<?php

namespace frontend\controllers;

use common\components\CFunction;
use common\models\AirConditionerTypes;
use common\models\Product;
use common\models\ArticleAttachment;
use common\models\ProductCategory;
use common\models\ProductOrderItems;
use common\models\ProductOrders;
use frontend\models\OrderForm;
use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ProductController extends FrontendController
{
    /**
     * @return string
     */
    /**
     * @sitemap priority=0.5 changefreq=monthly route=['/product/detail','slug'=>$model->slug] model=common\models\Product condition=['status'=>1]
     */
    public function actionIndex($category_slug='')
    {

        $CategoryModel = new ProductCategory();
        $category = array();
        if($category_slug == "" || !$category = $CategoryModel->getCatBySlug($category_slug)){
            $category_ids = null;
            $categoryTree = null;
            $this->pageTitle = "Sản phẩm";
        }else{
            $category = array(
                'id' => $category['id'],
                'parent_id' => $category['parent_id'],
                'slug' => $category['slug'],
                'sort_order' => $category['sort_order'],
                'title' => $category['title']
            );
            $this->pageTitle = $category['title'];
            $category_ids = $CategoryModel->getCategoryTree($category['id']);
        }

        $request = Yii::$app->request;
        $page = max(1,$request->get('page'));
        $sort = $request->get('sort','date');
        $keyword = $request->get('keyword','');
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $total_product = Product::countProducts($category_ids, null, $keyword);
        $total_page = ceil($total_product / $limit);
        $products = [];
        if($total_product > 0){
            if($page > $total_page){
                return $this->redirect(Url::to(['product/index']));
            }
            $products = Product::getProducts($offset, $limit, $sort, $category_ids, null, $keyword);
        }
        if($category_ids){
            $pagination = CFunction::buildPagination(Url::to(['product/index', 'category_slug' => $category_slug,'sort'=>$sort]), $total_page, $page, 3);
        }else{
            $pagination = CFunction::buildPagination(Url::toRoute(['product/index','sort'=>$sort]), $total_page, $page, 3);
        }


        return $this->render('index', [
            'category_slug' =>  $category_slug,
            'page' =>  $page,
            'limit' =>  $limit,
            'offset' =>  $offset,
            'total_product' =>  $total_product ,
            'total_page' =>  $total_page,
            'products' =>  $products,
            'pagination' =>  $pagination,
            'category_ids'  =>  $category_ids,
            'category'  =>  $category,
            'sort'  =>  $sort,
            'keyword'  =>  $keyword,
        ]);
    }

    public function actionTypes($category_slug=''){
        $model = AirConditionerTypes::getBySlug($category_slug);
        if($model){
            $request = Yii::$app->request;
            $page = max(1,$request->get('page'));
            $sort = $request->get('sort','date');
            $keyword = $request->get('keyword','');
            $limit = 10;
            $offset = ($page - 1) * $limit;
            $total_product = Product::countProducts(null,$model['id']);
            $total_page = ceil($total_product / $limit);
            $products = [];
            if($total_product > 0){
                if($page > $total_page){
                    return $this->redirect(Url::to(['product/index']));
                }
                $products = Product::getProducts($offset, $limit, $sort, null, $model['id']);
            }
            $pagination = CFunction::buildPagination(Url::toRoute(['product/types','category_slug'=>$category_slug,'sort'=>$sort]), $total_page, $page, 3);

            $this->pageTitle = $model['title'];

            return $this->render('type', [
                'category_slug' =>  $category_slug,
                'page' =>  $page,
                'limit' =>  $limit,
                'offset' =>  $offset,
                'total_product' =>  $total_product ,
                'total_page' =>  $total_page,
                'products' =>  $products,
                'pagination' =>  $pagination,
                'model'  =>  $model,
                'sort'  =>  $sort,
                'keyword'  =>  $keyword,
            ]);
        }else{
            throw new NotFoundHttpException("Loại điều hòa không tồn tại");
        }
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetail($slug)
    {

        $model = Product::find()->active()->andWhere(['slug'=>$slug])->one();
        if ($model) {
            //
            $CategoryModel = new ProductCategory();
            $category = $CategoryModel->getCatByID($model['category_id']??0);
            $category_parent =false;
            $air_type =false;
            if($category){
                $category_parent = $CategoryModel->getCatByID($category['parent_id']??0);
                $air_type = AirConditionerTypes::getById($model['air_conditioner_types']??0);
            }
            $this->pageTitle = $model->title;
            $this->pageDecription = $model->title;
            $this->pageImage = CFunction::image_url_absolute($model->thumbnail['path']);
            $this->fb_content_type = 'article';

            $next_product = Product::findNextPreviousProduct($model['id'], $category['id']);
            $pre_product = Product::findNextPreviousProduct($model['id'],$category['id'],false);

            //images
            $images  = [];
            $images[] = [
                'thumbnail_path'  =>  $model->thumbnail['path'],
                'thumbnail_base_url'  => $model->thumbnail['base_url']
            ];
            $image_list = Json::decode($model->image_list);
            if(is_array($image_list) && count($image_list) > 0){
                foreach ($image_list as $im){
                    $images[] = [
                        'thumbnail_path'  =>  $im['path'],
                        'thumbnail_base_url'   => $im['base_url']
                    ];
                }
            }
            //
            $relate_products = Product::getRelateProducts($model,5);

            return $this->render('detail', [
                'slug' => $slug,
                'model'=>$model,
                'category' =>  $category,
                'air_type' =>  $air_type,
                'category_parent' =>  $category_parent,
                'next_product' =>  $next_product,
                'pre_product' =>  $pre_product,
                'pre_product' =>  $pre_product,
                'images' =>  $images,
                'relate_products' =>  $relate_products,
            ]);
        }else{
            throw new NotFoundHttpException("Sản phẩm không tồn tại");
        }
    }

    public function actionAddToCart(){
        $request = Yii::$app->request;
        $id = $request->post('id');
        $quantity = (int)max(1, $request->post('quantity'));
        $model = Product::find()->active()->andWhere(['id'=>$id])->one();
        if ($model) {
            $cookie_name = 'dl_cart';

            $cart_data  = [];
            $cookie_cart = CFunction::getCookie('dl_cart');
            if($cookie_cart){
                $cookie_cart = Json::decode($cookie_cart);
                if(is_array($cookie_cart)){
                    if(isset($cookie_cart[$id])){
                        $cookie_cart[$id]+= $quantity;
                    }else{
                        $cookie_cart[$id] = $quantity;
                    }
                    $cart_data = Json::encode($cookie_cart);
                    CFunction::setCookie($cookie_name, $cart_data);
                }
            }else{
                $cart_data[$id] = $quantity;
                $cart_data = Json::encode($cart_data);
                CFunction::setCookie($cookie_name, $cart_data);
            }

            echo Json::encode([
                'status'    =>  1,
                'message'   =>  'Thêm sản phẩm vào giỏ hàng thành công',
                'url'       =>  Url::to(['product/cart'])
            ]);
        }else{
            echo Json::encode([
                'status'    =>  -1,
                'message'   =>  'Sản phẩm không tồn tại'
            ]);
        }
    }

    public function actionSearch(){

    }

    public function actionCart(){
        $cookie_name = 'dl_cart';
        $cart = CFunction::getCookie('dl_cart');
        $products = [];
        if($cart){
            $cart = Json::decode($cart);
            if(is_array($cart) && count($cart) > 0) {
                $product_ids = [];
                foreach ($cart as $id=>$q){
                    $product_ids[] = $id;
                }

                $products = Product::getProducts(0,5000, 'date', null, null, "", $product_ids);
            }else{
                CFunction::deleteCookie($cookie_name);
            }
        }else{
            CFunction::deleteCookie($cookie_name);
        }
        if(Yii::$app->request->isPost){
            $cart = Yii::$app->request->post('cart');
            if(is_array($cart) && count($cart) > 0){

            }else{
                $cart = false;
            }
            CFunction::setCookie($cookie_name, Json::encode($cart));
        }

        return $this->render('cart', [
            'cart' => $cart,
            'products' => $products,
        ]);
    }

    public function actionOrder(){
        $cookie_name = 'dl_cart';
        $cart = CFunction::getCookie($cookie_name);
        $products = [];
        $quantity = $total_amount = 0;
        if($cart){
            $cart = Json::decode($cart);
            if(is_array($cart) && count($cart) > 0) {
                $product_ids = [];
                foreach ($cart as $id=>$q){
                    $product_ids[] = $id;
                }

                $products = Product::getProducts(0,5000, 'date', null, null, "", $product_ids);
                if(is_array($products) && count($products) > 0){
                    foreach ($products as $product){
                        $price = $product['price'];
                        if ($product['price_discount'] && $product['price_discount'] < $product['price']) {
                            $price = $product['price_discount'];
                        }
                        $pro_quantity = $cart[$product['id']]??0;
                        $real_price = $pro_quantity * $price;
                        $quantity+= $pro_quantity;
                        $total_amount += $real_price;
                    }
                }else{
                    CFunction::deleteCookie($cookie_name);
                    Yii::$app->session->setFlash('error','Chưa có sản phẩm nào trong giỏ hàng');
                    $this->redirect(array('site/index'));
                }
            }else{
                CFunction::deleteCookie($cookie_name);
                Yii::$app->session->setFlash('error','Chưa có sản phẩm nào trong giỏ hàng');
                $this->redirect(array('site/index'));
            }
        }else{
            CFunction::deleteCookie($cookie_name);
            Yii::$app->session->setFlash('error','Chưa có sản phẩm nào trong giỏ hàng');
            $this->redirect(array('site/index'));
        }
        //
        $orderForm = new OrderForm();
        if(Yii::$app->request->isPost){
            $orderForm->load(Yii::$app->request->post());
            if($orderForm->validate()){
                $cookie_name = 'dl_cart';

                $order_key = Yii::$app->security->generateRandomString();

                //insert to order
                $orderModel = new ProductOrders();
                $orderModel->fullname = $orderForm['fullname'];
                $orderModel->phone = $orderForm['phone'];
                $orderModel->email = $orderForm['email'];
                $orderModel->address = $orderForm['address'];
                $orderModel->quantity = $quantity;
                $orderModel->total_amount = $total_amount;
                $orderModel->created_ip = Yii::$app->request->getUserIP();
                $orderModel->created_ip = Yii::$app->request->getUserIP();
                $orderModel->note = $orderForm['note'];
                $orderModel->order_key = $order_key;

                $orderModel->insert(false);
                $order_id = $orderModel['id'];
                //insert to order items
                if(is_array($products) && count($products) > 0) {
                    foreach ($products as $product) {
                        $pro_quantity = $cart[$product['id']]??0;

                        $itemModel = new ProductOrderItems();
                        $itemModel->order_id = $order_id;
                        $itemModel->product_id = $product['id']??0;
                        $itemModel->title = $product['title']??'';
                        $itemModel->quantity = $pro_quantity;
                        $itemModel->price = $product['price']??0;
                        $itemModel->discount_price = $product['price_discount']??0;
                        $itemModel->insert(false);
                    }
                }
                CFunction::setCookie($cookie_name,Json::encode(false));
                CFunction::deleteCookie($cookie_name);
                $this->redirect(Url::to(['product/order-success','id'=>$order_id, 'k'=>$order_key]));
            }
        }

        return $this->render('order', [
            'cart' => $cart,
            'products' => $products,
            'orderForm' => $orderForm,
        ]);
    }

    public function actionRemove(){
        $cookie_name = 'dl_cart';
        $cart = CFunction::getCookie('dl_cart');
        $request = Yii::$app->request;
        $id = (int)$request->post('id');
        if($cart){
            $cart = Json::decode($cart);
            if(is_array($cart) && count($cart) > 0){
                if(isset($cart[$id])){
                    unset($cart[$id]);
                }
                CFunction::setCookie($cookie_name, Json::encode($cart));
            }else{
                CFunction::deleteCookie($cookie_name);
            }
        }else{
            CFunction::deleteCookie($cookie_name);
        }
        echo Json::encode([
            'status'    =>  1,
            'message'   =>  'Xóa sản phẩm thành công',
        ]);
    }

    public function actionOrderSuccess(){
        $request = Yii::$app->request;
        $id = (int)$request->get('id');
        $order_key = $request->get('k');
        $model = ProductOrders::find()->where(['id'=>$id])->andWhere(['order_key'=>$order_key])->one();
        if ($model) {
            return $this->render('order_success', [
                'order_key' => $order_key,
                'model'=>$model,
            ]);
        }else{
            throw new NotFoundHttpException("Đơn hàng không tồn tại");
        }
    }


    /**
     * @param $id
     * @return $this
     * @throws NotFoundHttpException
     * @throws \yii\web\HttpException
     */
    public function actionAttachmentDownload($id)
    {
        $model = ArticleAttachment::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return Yii::$app->response->sendStreamAsFile(
            Yii::$app->fileStorage->getFilesystem()->readStream($model->path),
            $model->name
        );
    }
}
