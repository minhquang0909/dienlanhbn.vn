<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $categories common\models\ServiceCategory[] */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <div class="form-group field-servicecategory-parent_id required">
                <label class="control-label" for="service-category-id">Danh mục dịch vụ</label>
                <select id="service-category-id" class="form-control" name="Service[category_id]">
                    <?php
                    if(isset($categories) && is_array($categories) && count($categories) > 0){
                        foreach($categories as $item){
                            echo '<option value="'. (int)$item['id'] .'"'. ($item['id']==$model['id']?' selected':'') .'>'. text_loop("----", $item['level']) . Html::encode($item['title']) .'</option>';
                        }
                    }
                    ?>
                </select>
                <p class="help-block help-block-error"></p>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>
            <?php
            if($model->isNewRecord) {
                echo $form->field($model, 'status')->checkbox(['checked'=>true]);
            }else{
                echo $form->field($model, 'status')->checkbox();
            }
            ?>
        </div>
    </div>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?php echo $form->field($model, 'body')->widget(
        \yii\imperavi\Widget::class,
        [
            'plugins' => ['fullscreen', 'fontcolor', 'video','fontsize','fontfamily','textdirection','table','widget'],
            'options' => [
                'minHeight' => 500,
                'maxHeight' => 500,
                'buttonSource' => true,
                'convertDivs' => false,
                'removeEmptyTags' => false,
                'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
            ]
        ]
    ) ?>

    <?php echo $form->field($model, 'thumbnail')->widget(
        Upload::class,
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => env('IMAGE_MAX_UPLOAD_FILE_SIZE',3000000), // 3 MiB
            'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),

        ]);
    ?>


    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
