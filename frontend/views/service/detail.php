<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
$this->title = $model->title.'-'.Yii::t('frontend', 'Promotion');
use yii\helpers\Html;
use common\components\CFunction;
use yii\helpers\Url;
?>
<div class="row row-large ">
            <div class="large-9 col">
                <article id="post-<?php echo $model['id']?>" class="post-<?php echo $model['id']?> post type-post status-publish format-standard has-post-thumbnail hentry">
                    <div class="article-inner ">
                        <header class="entry-header">
                            <div class="entry-header-text entry-header-text-top text-left">
                                <h6 class="entry-category is-xsmall">
                                    <a href="<?php echo Url::to(['service/index']);?>" rel="category tag">Dịch vụ</a>
                                    , <a href="<?php echo Url::to(['service/index', 'category_slug' => $category['slug']]) ;?>" rel="category tag"><?php echo $category['title'];?></a>
                                </h6>
                                <h1 class="entry-title"><?php echo $model['title']?></h1>
                                <div class="author-time" title="Cập nhật"><i class="fa fa-clock"></i>&nbsp;<?php echo date('Y-m-d H:i:s', $model['created_at']??time());?></div>
                                <div class="entry-divider is-divider small"></div>
                            </div>
                        </header>
                        <div class="entry-content single-page">
                            <?php echo $model->body; ?>
                        </div>
                    </div>
                </article>
            </div>
            <div class="post-sidebar large-3 col">
                <?php
                echo Yii::$app->controller->renderPartial('/product/_cat_menu',[

                ]);
                ?>
            </div>
        </div>