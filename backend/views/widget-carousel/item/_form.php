<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarouselItem */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="widget-carousel-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model) ?>

    <?php echo $form->field($model, 'image')->widget(
        \trntv\filekit\widget\Upload::className(),
        [
            'url'=>['/file-storage/upload'],
        ]
    ) ?>

    <?php echo $form->field($model, 'order')->textInput() ?>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => 1024]) ?>

    <?php /*echo $form->field($model, 'title')->textInput(['maxlength' => 255]) */?><!--
    --><?php /*echo $form->field($model, 'caption')->textarea(['maxlength' => 1024]) */?>
    <?php
    if($model->isNewRecord){
        echo $form->field($model, 'status')->checkbox(['checked' => true]);
    }else{
        echo $form->field($model, 'status')->checkbox();
    }
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(document).ready(function () {
        $( "glyphicon-remove-circle" ).bind( "click", function() {
            alert( "User clicked on 'foo.'" );
        });
    });
</script>
