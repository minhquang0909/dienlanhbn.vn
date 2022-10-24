<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Support */

$this->title = Yii::t('backend', 'Cập nhật hỗ trợ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hỗ trợ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="support-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
