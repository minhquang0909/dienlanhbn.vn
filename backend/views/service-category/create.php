<?php
/* @var $this yii\web\View */
/* @var $model common\models\ServiceCategory */
/* @var $categories common\models\ServiceCategory[] */

$this->title = Yii::t('backend', 'Tạo mới danh mục dịch vụ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Danh mục dịch vụ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
