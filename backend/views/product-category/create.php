<?php
/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */
/* @var $categories common\models\ProductCategory[] */

$this->title = Yii::t('backend', 'Tạo mới danh mục sản phẩm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Danh mục sản phẩm'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
