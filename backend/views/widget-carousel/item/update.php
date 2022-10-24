<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarouselItem */

$this->title = Yii::t('backend', 'Cập nhật ảnh');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Banner'), 'url' => ['widget-carousel/index']];
$this->params['breadcrumbs'][] = ['label' => $model->carousel->title, 'url' => ['widget-carousel/update', 'id' => $model->carousel->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="widget-carousel-item-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
