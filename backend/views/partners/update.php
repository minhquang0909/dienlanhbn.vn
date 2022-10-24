<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Partners */

$this->title = 'Cập nhật đối tác: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Đối tác', 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="partners-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
