<?php
/* @var $this yii\web\View */
/* @var $model common\models\S */
/* @var $categories common\models\ServiceCategory */

$this->title = 'Tạo mới dịch vụ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Dịch vụ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
