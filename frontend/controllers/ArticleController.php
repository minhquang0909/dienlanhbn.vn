<?php

namespace frontend\controllers;

use common\components\CFunction;
use common\models\Article;
use common\models\ArticleAttachment;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends FrontendController
{
    /**
     * @return string
     */
    /**
     * @sitemap priority=0.5 changefreq=monthly route=['/article/detail','slug'=>$model->slug] model=common\models\Article condition=['status'=>1]
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $page = max(1,$request->get('page'));
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $total_article = Article::countArticles();
        $total_page = ceil($total_article / $limit);
        $articles = [];
        if($total_article > 0){
            if($page > $total_page){
                return $this->redirect(Url::to(['article/index']));
            }
            $articles = Article::getArticles($offset, $limit);
        }
        $this->pageTitle = "Tin tức";
        return $this->render('index', [
            'page' =>  $page,
            'limit' =>  $limit,
            'offset' =>  $offset,
            'total_page' =>  $total_page,
            'articles' =>  $articles,
            'pagination' =>  CFunction::buildPagination(Url::to(['article/index']), $total_page, $page, 3),
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetail($slug)
    {
        $model = Article::find()->published()->andWhere(['slug'=>$slug])->one();
        if ($model) {
            $this->pageTitle = $model->title;
            $this->pageDecription = $model->description;
            $this->pageImage = CFunction::image_url_absolute($model->thumbnail['path']);
            $this->fb_content_type = 'article';
            return $this->render('detail', ['model'=>$model]);
        }else{
            throw new NotFoundHttpException("Tin tức không tồn tại");
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
