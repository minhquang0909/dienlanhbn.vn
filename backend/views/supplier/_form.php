<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'country_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        Country::find()->active()->all(),
        'id',
        'name'
    ), [])->label('Quốc gia') ?>

    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php
        if($model->isNewRecord){
            echo $form->field($model, 'status')->checkbox(['checked' => true]);
        }else{
            echo $form->field($model, 'status')->checkbox();
        }
    ?>

    <?php echo $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
