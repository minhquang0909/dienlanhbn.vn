<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = Yii::t('backend', 'Cập nhật sản phẩm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="article-update">
    <?php echo $this->render('_form_update', [
        'model' => $model,
        'categories' => $categories,
        'image_list_arr' => $image_list_arr,
    ]) ?>

</div>
