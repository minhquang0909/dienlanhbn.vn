<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = 'Cập nhật liên hệ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="contact-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
