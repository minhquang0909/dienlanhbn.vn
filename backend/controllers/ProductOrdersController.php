<?php

namespace backend\controllers;

use Yii;
use common\models\ProductOrders;
use backend\models\search\ProductOrdersSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductOrdersController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductOrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder'=>['id'=>SORT_DESC]
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionChangeStatus()
    {
        $status = -1;
        $message = 'Lỗi không xác định';
        $statuses = ProductOrders::statuses();

        $id = Yii::$app->request->post('id', '');
        $statusChange = (int)Yii::$app->request->post('status', '');
        $model = ProductOrders::findOne($id);
        $model->status = $statusChange;

        if ($model->save()) {
            $message = $statuses[$statusChange];
            $status = 1;
        }

        echo Json::encode([
            'status' => $status,
            'message' => $message
        ]);
    }

    /**
     * Displays a single ProductOrders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductOrders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductOrders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
