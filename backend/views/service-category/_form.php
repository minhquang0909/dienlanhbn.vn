<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceCategory */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $categories array */
?>

<div class="gallery-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

    <?php echo $form->field($model, 'slug')
        ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
        ->textInput(['maxlength' => 1024]) ?>
    <div class="form-group field-productcategory-parent_id">
        <label class="control-label" for="productcategory-parent_id">Danh mục cha</label>
        <select id="servicecategory-parent_id" class="form-control" name="ServiceCategory[parent_id]">
            <option value="0">- Danh mục cha -</option>
            <?php
            if(isset($categories) && is_array($categories) && count($categories) > 0){
                foreach($categories as $item){
                    echo '<option value="'. (int)$item['id'] .'"'. ($item['id']==$model['parent_id']?' selected':'') .'>'. text_loop("----", $item['level']) . Html::encode($item['title']) .'</option>';
                }
            }
            ?>
        </select>
        <p class="help-block help-block-error"></p>
    </div>
    <?php echo $form->field($model, 'sort_order')->textInput(['type'=>'number']) ?>
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
