<?php
/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $categories common\models\GalleryCategory[] */

$this->title = 'Tạo mới sản phẩm';
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <?php echo $this->render('_form_create', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
