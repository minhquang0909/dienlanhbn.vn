<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Partners */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="partners-form">
    <?php echo Html::errorSummary($model); ?>
    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    

    <?php echo $form->field($model, 'thumbnail')->widget(
        Upload::class,
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => env('IMAGE_MAX_UPLOAD_FILE_SIZE',5000000), // 5 MiB
            'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),

        ]);
    ?>    
    <?php echo $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
    <?php /*echo $form->field($model, 'view')->textInput(['maxlength' => true]) */?>

    <?php 
        echo $form->field($model, 'status')->checkbox() 
    ?>   

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
