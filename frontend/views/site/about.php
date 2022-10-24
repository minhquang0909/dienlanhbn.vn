<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
use common\components\CFunction;
use yii\helpers\Url;
Yii::$app->controller->pageTitle = Yii::t('frontend','About');
?>
<section class="dt-content-header">
    <div class="container">
        <h1 class="float-left"><?=Yii::t('frontend','About')?></h1>
        <ol class="float-right dt-breadcrumb">
            <li><a href="<?=Url::to(['site/index'])?>"><?=Yii::t('frontend','Home')?></a></li>
            <li class="active"><?=Yii::t('frontend','About')?></li>
        </ol>
        <div class="clearfix"></div>
    </div>
</section>
<div class="container">
  <div class="mt-about-page">
     <div class="mt-about-sum">
         <div class="row">
             <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row">
                    <div class="col-md-6"><img class="img" src="/img/about-1.png"/></div>
                    <div class="col-md-6">
                        <div class="btitle"><?=Yii::t('frontend','Welcome to Duc Thanh.,JSC')?></div>
                        <p>Aliquam faucibus sem. Cras in semper ex. Mauris tincidunt purus blandit arcu ullamcorper finibus. Maecenas enim justo, gittis dui. Sed id purus sem. Aliquam hendrerit vitae urna ornare semper. Ut congue condimentum nisl. Nam eu nulla libero. Curabitur pharetra massa ut vehicula euismod. Vestibulum ante ipsum primis in  Etiam nec sagittis dui. Sed id purus sem. Aliquam hendrerit vitae urna ornare semper. </p>
                        <p>Ut congue condimentum nisl. Nam eu nulla libero. Curabitur pharetra massa ut vehicula euismod. Vestibulum ante ipsum primis in  Cras in semper ex. Mauris tincidunt purus blandit arcu ullamcorper finibus. Maecenas enim justo, gittis dui. Sed id purus sem. Aliquam hendrerit vitae urna ornare semperCras in semper ex. Mauris tincidunt purusid</p>
                        <div class="text-bold">Duc Thanh - CEO </div>
                    </div>
                </div>
             </div>
         </div>
     </div>
      <div class="mt-stats">
          <div class="row">
              <div class="col-md-3">
                  <div class="item">
                      <div class="number">100</div>
                      <div class="text"><?=Yii::t('frontend','Partners')?></div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="item">
                      <div class="number">10000</div>
                      <div class="text"><?=Yii::t('frontend','Tons of goods')?></div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="item">
                      <div class="number">500</div>
                      <div class="text"><?=Yii::t('frontend','Employee')?></div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="item last">
                      <div class="number">10</div>
                      <div class="text"><?=Yii::t('frontend','Nation')?></div>
                  </div>
              </div>
          </div>
      </div>
      <div class="mt-misstion">
          <div class="row">
              <div class="col-md-6">
                  <div class="htitle"><?=Yii::t('frontend','Vision')?></div>
                  <p><?=Yii::t('frontend','Denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual se teachings off the great explorere of the truth, the master-builder of human happiness no sed one rejects, dislikes.')?></p>
              </div>
              <div class="col-md-6">
                  <div class="htitle"><?=Yii::t('frontend','Mission')?></div>
                  <p><?=Yii::t('frontend','Again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which is a toil and pain can him some great pleasure. To take a trivial undertakes laboexercise.')?></p>
              </div>
          </div>
      </div>
      <!--thành viên-->
      <div class="dt-support dt-members">
          <div class="container">
              <div class="text-center htitle"><span><?=Yii::t('frontend','Member')?></span></div>
              <div class="btitle text-center "><?=Yii::t('frontend','Welcome to Duc Thanh.,JSC')?></div>
              <div class="dt-support-list">
                  <div class="row">
                      <div class="col-md-10 offset-1">
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="item">
                                      <img class="rounded-circle" src="/img/member.png">
                                      <div class="name">Cristiano Ronaldo</div>
                                      <div class="title"><?=Yii::t('frontend','Title')?></div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="item">
                                      <img class="rounded-circle" src="/img/member.png">
                                      <div class="name">Lionel Messi</div>
                                      <div class="title"><?=Yii::t('frontend','Title')?></div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="item">
                                      <img class="rounded-circle" src="/img/member.png">
                                      <div class="name">Sandra Bullock</div>
                                      <div class="title"><?=Yii::t('frontend','Title')?></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!--comment-->
<div class="dt-comment">
    <div class="container">
       <div class="dt-comment-inner">
           <div class="row">
               <div class="col-md-6">
                   <p>“ Vestibulum varius, velit sit amet tempor efficitur, ligula mi lvacinia libero, et vehicula dui nisi eget purus. posuere id lorem ac, interdum egestas neque. Morbi pharetra felis mauri”</p>
                   <div class="btitle">Nguyen Quang Hai</div>
                   <div class="mtitle">CEO công ty AAA</div>
                   <ul>
                       <li><img class="img" src="/img/demo/person-1.png"/></li>
                       <li><img class="img" src="/img/demo/person-2.png"/></li>
                       <li><img class="img" src="/img/demo/person-3.png"/></li>
                   </ul>
               </div>
               <div class="col-md-6 img-list">
                   <div class="row">
                     <div class="col-md-4">
                         <div class="item"><img class="img" src="/img/demo/logo-icon-1.png"/></div>
                     </div>
                       <div class="col-md-4">
                           <div class="item"><img class="img" src="/img/demo/logo-icon-2.png"/></div>
                       </div>
                       <div class="col-md-4">
                           <div class="item"><img class="img" src="/img/demo/logo-icon-3.png"/></div>
                       </div>
                       <div class="col-md-4">
                           <div class="item"><img class="img" src="/img/demo/logo-icon-4.png"/></div>
                       </div>
                       <div class="col-md-4">
                           <div class="item"><img class="img" src="/img/demo/logo-icon-5.png"/></div>
                       </div>
                       <div class="col-md-4">
                           <div class="item"><img class="img" src="/img/demo/logo-icon-6.png"/></div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
<!--support-->
<?php
echo Yii::$app->controller->renderPartial('_support',[]);
?>
<!--end support-->
