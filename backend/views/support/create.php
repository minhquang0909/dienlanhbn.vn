<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Support */

$this->title = Yii::t('backend', 'Tạo mới hỗ trợ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hỗ trợ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
