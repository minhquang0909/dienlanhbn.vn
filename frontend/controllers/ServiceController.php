<?php

namespace frontend\controllers;

use common\components\CFunction;
use common\models\Service;
use common\models\ArticleAttachment;
use common\models\ServiceCategory;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ServiceController extends FrontendController
{
    /**
     * @return string
     */
    /**
     * @sitemap priority=0.5 changefreq=monthly route=['/service/detail','slug'=>$model->slug] model=common\models\Service condition=['status'=>1]
     */
    public function actionIndex($category_slug='')
    {
        $ServiceCategoryModel = new ServiceCategory();
        $category = array();
        if($category_slug == "" || !$category = $ServiceCategoryModel->getCatBySlug($category_slug)){
            $category_ids = null;
            $categoryTree = null;
        }else{
            $category = array(
                'id' => $category['id'],
                'parent_id' => $category['parent_id'],
                'slug' => $category['slug'],
                'sort_order' => $category['sort_order'],
                'title' => $category['title']
            );
            $category_ids = $ServiceCategoryModel->getCategoryTree($category['id']);
        }

        $request = Yii::$app->request;
        $page = max(1,$request->get('page'));
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $total_service = Service::countServices($category_ids);        
        $total_page = ceil($total_service / $limit);
        $services = [];
        if($total_service > 0){
            if($page > $total_page){
                return $this->redirect(Url::to(['service/index']));
            }
            $services = Service::getServices($offset, $limit,$category_ids);
        }
        if($category_ids){
            $pagination = CFunction::buildPagination(Url::to(['service/index', 'category_slug' => $category_slug]), $total_page, $page, 3);
        }else{
            $pagination = CFunction::buildPagination(Url::toRoute(['service/index']), $total_page, $page, 3);
        }
        $this->pageTitle = "Dịch vụ";
        
        return $this->render('index', [
            'page' =>  $page,
            'limit' =>  $limit,
            'offset' =>  $offset,
            'total_page' =>  $total_page,
            'services' =>  $services,
            'pagination' =>  $pagination,
            'category_ids'  =>  $category_ids
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetail($slug)
    {
        $model = Service::find()->active()->andWhere(['slug'=>$slug])->one();
        if ($model) {
            //
            $ServiceCategoryModel = new ServiceCategory();
            $category = $ServiceCategoryModel->getCatByID($model['category_id']??0);

            $this->pageTitle = $model->title;
            $this->pageDecription = $model->description;
            $this->pageImage = CFunction::image_url_absolute($model->thumbnail['path']);
            $this->fb_content_type = 'article';

            return $this->render('detail', [
                'model'=>$model,
                'category' =>  $category
            ]);
        }else{
            throw new NotFoundHttpException("Dịch vụ không tồn tại");
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
