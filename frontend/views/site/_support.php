<?php
use common\models\Support;
use yii\helpers\Html;
?>
<div class="dt-support">
    <div class="<?=(isset($fullwith) && $fullwith)?"container-fluid":"container"?>">
        <div class="text-center title htitle"><?=Yii::t('frontend','Contact')?></div>
        <div class="text-center title btitle"><?=Yii::t('frontend','Please contact us immediately to provide the best products')?></div>
        <div class="dt-support-list">
            <?php
            $support_list = Support::getList(3);
            ?>
            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="row">
                        <?php
                        if(is_array($support_list) && count($support_list) > 0) {
                            foreach ($support_list as $item) { ?>
                                <div class="col-md-4">
                                    <div class="item">
                                        <img class="rounded-circle" src="<?= $item['thumbnail_base_url'] . '/' . $item['thumbnail_path']; ?>"/>
                                        <div class="phone"><?= Html::encode($item->phone) ?></div>
                                        <div class="name"><?= Html::encode($item->name) ?></div>
                                        <div class="email"><?= Html::encode($item->email) ?></div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>