<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Supplier */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Supplier',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
