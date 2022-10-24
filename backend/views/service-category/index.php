<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\components\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Danh mục dịch vụ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Danh mục dịch vụ'), 'url' => ['index']];
?>
<div class="product-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Tạo mới danh mục dịch vụ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Tiêu đề</th>
        <th>Thứ tự</th>
        <th colspan="3">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(isset($categories) && is_array($categories) && count($categories) > 0){
        $count = 0;
        foreach($categories as $item){
            $count++;
            $txt =  text_loop("---- ", $item['level']);
            if($item['level']==0){
                $txt.='<span style="color: green;" class="btitle">'.Html::encode($item['title']).'</span>';
            }else if($item['level']==1){
                $txt.='<span style="color: #000;" class="mtitle">'.Html::encode($item['title']).'</span>';
            }else{
                $txt.='<span style="color: blue;">'.Html::encode($item['title']).'</span>';
            }
            echo '<tr class="'. ($count%2==0?'odd ':'') .'">
            <td>'. $count .'</td>
            <td>'.$txt.'</td>
            <td>'. text_loop("---- ", $item['level']) .  ($item['level']==0?'<b>'.(int)$item['sort_order'].'</b>':(int)$item['sort_order']) .'</td>          
            <td>
            <a href="'.Url::to(['service-category/update','id'=>$item['id']]).'" title="Sửa" aria-label="Sửa" data-pjax="0"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path></svg></a>
             <a href="'.Url::to(['service-category/delete','id'=>$item['id']]).'" title="Xóa" aria-label="Xóa" data-pjax="0" data-confirm="Bạn có chắc là sẽ xóa mục này không?" data-method="post"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg></a>
             </td>
        </tr>';
        }
    }else{
        echo '<td colspan="3" class="text-danger text-center text-bold">Chưa có danh mục dịch vụ nào</td>';
    }
    ?>
    </tbody>
</table>
