<?php

namespace backend\controllers;

use common\components\CFunction;
use common\models\Service;
use Yii;
use common\models\Product;
use backend\models\search\ServiceSearch;
use \common\models\ServiceCategory;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use common\models\FileStorageItem;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ServiceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    /**
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder'=>['id'=>SORT_DESC]
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();
        $categories = ServiceCategory::getAllCategory();
        if ($model->load(Yii::$app->request->post())) {
            //save post
            if($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = ServiceCategory::getAllCategory();
        //post
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'categories'   =>  $categories
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model){
            $rs = $model->delete();
            if($rs){
                self::deleteProductImages($model);
            }
        }

        return $this->redirect(['index']);
    }

    public function actionDeleteImage(){
        self::deleteImage([
            'base_url'  =>  Yii::$app->request->post('base_url'),
            'path'  =>  Yii::$app->request->post('path'),
        ]);
        echo Json::encode([
            'status'    =>  1,
            'message'   =>  'Delete image success'
        ]);
    }

    public function actionDeleteProducts(){
        $status = -1; $message = 'Lỗi không xác định';
        $prod_id_string = Yii::$app->request->post('prod_id_string','');
        $prod_id_arr = explode(",", $prod_id_string);
        if(is_array($prod_id_arr) && count($prod_id_arr) > 0){
            foreach ($prod_id_arr as $id){
                $model = Product::findOne($id);
                if($model){
                    if($model->delete()){
                        self::deleteProductImages($model);
                    }
                }
            }
            $status = 1; $message = 'Xóa sản phẩm thành công';
        }else{
            $message = "Vui lòng chọn ít nhất 1 sản phẩm để xóa";
        }
        echo Json::encode([
            'status'    =>  $status,
            'message'   =>  $message
        ]);
    }

    public static function deleteImage($img){
        $img_url = Yii::getAlias('@base').$img['base_url'].'/'.$img['path'];
        //xóa file trên server
        @unlink($img_url);
        // xóa fileStorage
        $fileStorage = FileStorageItem::find()->andWhere(
            [
                'base_url'  =>  $img['base_url'],
                'path'  =>  $img['path'],
            ]
        )->one();
        if($fileStorage){
            $fileStorage->delete();
        }
    }

    public static function deleteMultiImages($arr_img){
        if(is_array($arr_img) && count($arr_img) > 0){
            foreach ($arr_img as $img){
                self::deleteImage($img);
            }
        }
    }

    /**
     *   //delete product image list
     * @param $product
     */
    public static function deleteProductImages($product){
        //get image list in product
        $image_list_arr = array();
        $image_list = $product->image_list;
        if($image_list!=""){
            $image_list = Json::decode($image_list);
            $image_list_arr = $image_list;
        }
        self::deleteMultiImages($image_list_arr);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
