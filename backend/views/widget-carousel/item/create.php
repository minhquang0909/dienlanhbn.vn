<?php
/** @var $this yii\web\View
 * @var $model common\models\WidgetCarouselItem
 * @var $carousel common\models\WidgetCarousel
 */
use yii\helpers\Html;

$this->title = "Thêm ảnh cho banner: ".Html::encode($carousel->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Banner'), 'url' => ['widget-carousel/index']];
$this->params['breadcrumbs'][] = ['label' => $carousel->title, 'url' => ['widget-carousel/update', 'id' => $carousel->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Create');
?>
<div class="widget-carousel-item-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'carousel' => $carousel,
    ]) ?>

</div>
