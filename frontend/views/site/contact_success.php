<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Pricing;
use trntv\yii\datetime\DateTimeWidget;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Liên hệ thành công';
?>
<div class="container">
    <div class="bg-color site-contact lxb-contact-success">
        <div class="lxb-contact-form">
            <div class="form-header">
                <div class="htitle">Thông tin của bạn</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="lxb-user-contact-info">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="30%" class="note">Tên của bạn</td>
                                        <td><?=Html::encode($model->name)?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="note">Email</td>
                                        <td><?=Html::encode($model->email)?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="note">Số điện thoại</td>
                                        <td><?=Html::encode($model->phone)?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="note">Địa điểm chụp</td>
                                        <td><?=Html::encode($model->place)?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="note">Ngày chụp</td>
                                        <td><?=Html::encode($model->photo_date)?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="note">Gói chụp</td>
                                        <td><?=Html::encode($model->pricing->title)?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="note">Nội dung</td>
                                        <td><?=Html::encode(($model->content))?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="lxb-contact-banking-info">
                        <?php
                        if(isset(Yii::$app->controller->config['banking_info']) && Yii::$app->controller->config['banking_info']!=''){
                            echo Yii::$app->controller->config['banking_info'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        <?php
        $qid = (int)Yii::$app->request->get('qid',0);
        if($qid > 0){?>
            var email_queue_id = <?=$qid?> ;
            $('body').append('<img width="0" height="0" style="display: hidden;" src="<?=\yii\helpers\Url::to(['site/send-email','qid'=>$qid])?>"/>');
        <?php }
        ?>
    });
</script>

