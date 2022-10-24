<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'product_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        Product::find()->all(), 'id', 'title'
    ), ['prompt'=>'']) ?>

    <?php echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php /*echo $form->field($model, 'created_time')->textInput() */?><!--

    <?php /*echo $form->field($model, 'update_time')->textInput() */?>

    <?php /*echo $form->field($model, 'status')->textInput() */?>

    --><?php /*echo $form->field($model, 'access_token')->textInput(['maxlength' => true]) */?>

    <?php echo $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
