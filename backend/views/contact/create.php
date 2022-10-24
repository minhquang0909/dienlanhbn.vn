<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = 'Tạo mới liên hệ';
$this->params['breadcrumbs'][] = ['label' => 'Liên hệ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
