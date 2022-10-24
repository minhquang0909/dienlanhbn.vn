<?php
/* @var $this yii\web\View */
/* @var $model common\models\Parters */

$this->title = 'Tạo mới đối tác';
$this->params['breadcrumbs'][] = ['label' => 'Khuyến mãi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
