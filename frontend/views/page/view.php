<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
use common\components\CFunction;
?>
<div class="container">
    <div class="bg-color static-page">
        <?php echo  CFunction::getAttributeByLanguage($model, "body")?>
    </div>
</div>