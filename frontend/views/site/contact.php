<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */
use common\components\CFunction;
use yii\helpers\Url;
use common\models\Product;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$domain = Url::base(true);
$config = Yii::$app->controller->config;
Yii::$app->controller->pageTitle = Yii::t('frontend','Contact');
?>
<section class="dt-content-header">
    <div class="container">
        <h1 class="float-left"><?=Yii::t('frontend','Contact')?></h1>
        <ol class="float-right dt-breadcrumb">
            <li><a href="<?=Url::to(['site/index'])?>"><?=Yii::t('frontend','Home')?></a></li>
            <li class="active"><?=Yii::t('frontend','Contact')?></li>
        </ol>
        <div class="clearfix"></div>
    </div>
</section>
<div class="container">
    <div class="dt-site-contact">
        <div class="dt-contact-info">
            <div class="htitle text-center"><?=Yii::t('frontend','Contact')?></div>
            <div class="dt-contact-info-list">
                <div class="item-wrapper">
                    <div class="item">
                        <img src="<?=$domain?>/img/icon-address.png" alt="address"/>
                        <div class="title"><?=Yii::t('frontend','Address')?></div>
                        <div class="desc"><?=($config['contact_address']??'')?></div>
                    </div>
                </div>
                <div class="item-wrapper">
                    <div class="item">
                        <img src="<?=$domain?>/img/icon-hotline.png" alt="address"/>
                        <div class="title"><?=Yii::t('frontend','Hotline')?></div>
                        <div class="desc"><?=($config['contact_phone']??'')?></div>
                        <div class="desc"><?=($config['contact_phone2']??'')?></div>
                    </div>
                </div>
                <div class="item-wrapper">
                    <div class="item">
                        <img src="<?=$domain?>/img/icon-dateime.png" alt="address"/>
                        <div class="title"><?=Yii::t('frontend','Working time')?></div>
                        <div class="desc"><?=Yii::t('frontend','Monday – Friday 7:30 – 18:00')?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $form = ActiveForm::begin(
             ['id' => 'contact_form',]
        );
        ?>
        <div class="dt-contact-form">
            <div class="btitle text-center"><?=Yii::t('frontend','Send information')?></div>
            <div class="dt-contact-form-inner">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'name', [
                            'inputOptions' => ['class' => 'form-control']
                        ])->textInput()->input('name', ['placeholder' => Yii::t('frontend','Fullname')])->label(false); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'phone', [
                            'inputOptions' => ['class' => 'form-control']
                        ])->textInput()->input('phone', ['placeholder' => Yii::t('frontend','Phone')])->label(false); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'email', [
                            'inputOptions' => ['class' => 'form-control']
                        ])->textInput()->input('email', ['placeholder' => "Email"])->label(false); ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $options = [];
                        if(isset($id) && $id > 0){
                            $options = [
                                'options'   =>  [
                                    $id   =>  ['selected' =>  true]
                                ]
                            ];
                        }
                        echo $form->field($model, 'product_id')->dropDownList(
                            ArrayHelper::map($products, 'id', 'title'),
                            $options
                        )->label(false);
                        ?>
                    </div>
                    <div class="col-md-12">
                        <?php echo $form->field($model, 'content')->textArea(['rows' => 6,'placeholder' => Yii::t('frontend','Content')])->label(false); ?>
                        <div class="form-group">
                            <div class="btn-submmit-wrapper">
                                <?php echo Html::submitButton(Yii::t('frontend','Send contact'), ['class' => 'btn btn-warning', 'name' => 'contact-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$contact_google_map = $config['contact_google_map']??'';
if($contact_google_map!=''){ ?>
    <div class="dt-google-map">
        <?=$contact_google_map?>
    </div>
<?php }
?>


