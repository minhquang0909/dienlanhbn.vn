<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\AirConditionerTypes;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $categories common\models\ProductCategory[] */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-form">
    <?php echo Html::errorSummary($model); ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'price_discount')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <div class="form-group field-productcategory-parent_id required">
                <label class="control-label" for="product-category-id">Danh mục sản phẩm</label>
                <select id="product-category-id" class="form-control" name="Product[category_id]">
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
            <?php echo $form->field($model, 'air_conditioner_types')->dropDownList(\yii\helpers\ArrayHelper::map(
                AirConditionerTypes::getAllTypes(),
                'id',
                'title'
            ), ['prompt'=>''])?>

            <?php echo $form->field($model, 'status')->checkbox(['checked'=>true]) ?>
        </div>
    </div>


    <?php echo $form->field($model, 'features')->widget(
        \yii\imperavi\Widget::class,
        [
            'plugins' => ['fullscreen', 'fontcolor', 'video'],
            'options' => [
                'minHeight' => 200,
                'maxHeight' => 200,
                'buttonSource' => true,
                'convertDivs' => false,
                'removeEmptyTags' => true,
                'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
            ],
        ]
    ) ?>
    <?php echo $form->field($model, 'body')->widget(
        \yii\imperavi\Widget::class,
        [
            'plugins' => ['fullscreen', 'fontcolor', 'video','fontsize','fontfamily','textdirection','table','widget'],
            'options' => [
                'minHeight' => 400,
                'maxHeight' => 400,
                'buttonSource' => true,
                'convertDivs' => false,
                'removeEmptyTags' => true,
                'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
            ],
        ]
    ) ?>
    <?php
    echo $form->field($model, 'thumbnail')->widget(
        Upload::class,
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => env('IMAGE_MAX_UPLOAD_FILE_SIZE',3000000), // 3 MiB
            'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),

        ]);
    ?>


    <?php
    if($model->isNewRecord){
        echo $form->field($model, 'image_list')->widget(
            Upload::class,
            [
                'url' => ['/file-storage/upload'],
                'maxFileSize' => env('PRODUCT_IMAGES_MAX_UPLOAD_FILE_SIZE',15000000), // 15 MiB
                'maxNumberOfFiles' => 5,
                'sortable' => true,
                'multiple'  => true,
                'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),

            ]);
    }else{
        if(isset($image_list_arr) && is_array($image_list_arr) && count($image_list_arr) > 0){
            echo '<h3>Danh sách ảnh sản phẩm: </h3>';
            echo '<div class="upload-kit">';
            echo '<ul class="files">';
            $d=0;
            foreach ($image_list_arr as $im){
                echo '<li class="upload-kit-item done image"><img src="'.$im['base_url'].'/'.$im['path'].'">
                            <input name="Product[olg_image_list]['.$d.'][path]" value="'.$im['path'].'" type="hidden">
                            <input name="Product[olg_image_list]['.$d.'][name]" type="hidden" value="'.$im['name'].'">
                            <input name="Product[olg_image_list]['.$d.'][size]" value="'.$im['size'].'" type="hidden">
                            <input name="Product[olg_image_list]['.$d.'][type]" value="'.$im['type'].'" type="hidden">
                            <input name="Product[olg_image_list]['.$d.'][order]" type="hidden" data-role="order" value="'.$im['order'].'">
                            <input name="Product[olg_image_list]['.$d.'][base_url]" value="'.$im['base_url'].'" type="hidden">
                            <span class="name"></span><span path="'.$im['path'].'" base_url="'.$im['base_url'].'" class="glyphicon glyphicon-remove-circle remove remove-old-image"></span>
                        </li>';
                $d++;
            }
            echo '</ul>';
            echo '</div>';
        }
        //Thêm image mới
        echo $form->field($model, 'new_image_list')->widget(
            Upload::class,
            [
                'url' => ['/file-storage/upload'],
                'maxFileSize' => env('IMAGE_MAX_UPLOAD_FILE_SIZE',3000000), // 3 MiB
                'maxNumberOfFiles' => 5,
                'sortable' => true,
                'multiple'  => true,
                'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),


            ]);
    }

    ?>

    <?php echo Html::submitButton(
        $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>


    <script>
        jQuery(document).ready(function(){
            jQuery('.remove-old-image').click(function(){
                var url_delete = '<?=Url::to(['product/delete-image'])?>';
                jQuery.post(url_delete,{
                    base_url: $(this).attr('base_url'),
                    path: $(this).attr('path'),
                <?=Yii::$app->request->csrfParam?>: '<?=Yii::$app->request->csrfToken?>',
            },
                function (res) {
                    console.log(res);
                },
                'json'
            );
                //alert(url_delete);
                $(this).parent('li').remove();
            });
        });
    </script>
