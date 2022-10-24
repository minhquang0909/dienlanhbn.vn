<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use common\components\CFunction;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/nav.php');
?>
    <div class="">
        <?php echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php if(Yii::$app->session->hasFlash('success')):?>
            <?php echo \yii\bootstrap\Alert::widget([
                'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('success'), 'body'),
                'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('success'), 'options'),
            ])?>
        <?php endif; ?>
        <?php if(Yii::$app->session->hasFlash('error')):?>
            <?php echo \yii\bootstrap\Alert::widget([
                'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('error'), 'body'),
                'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('error'), 'options'),
            ])?>
        <?php endif; ?>
        <?php if(Yii::$app->session->hasFlash('alert')):?>
            <?php echo \yii\bootstrap\Alert::widget([
                'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
            ])?>
        <?php endif; ?>
        <?= \yii\helpers\Html::script(isset($this->params['schema'])
            ? $this->params['schema']
            : \yii\helpers\Json::encode([
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => Yii::$app->name,
                'image' => Yii::$app->controller->pageImage,
                'url' => Yii::$app->controller->pageUrl,
                'descriptions' => Yii::$app->controller->pageDecription,
                'author' => [
                    '@type' => 'Organization',
                    'name' => Yii::$app->name,
                    'url' => Yii::$app->controller->pageUrl,
                    'telephone' => CFunction::getConfig('contact_phone'),
                ]
            ]), [
            'type' => 'application/ld+json',
        ]) ?>
        <?php echo $content ?>

    </div>
<?php $this->endContent() ?>
<?php $this->beginContent('@frontend/views/layouts/_footer.php') ?>
<?php $this->endContent() ?>