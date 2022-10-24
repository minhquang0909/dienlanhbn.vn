<?php
/**
 * Created by nguyenpv.
 * Date: 3/10/2020
 * Time: 10:38 PM
 */
namespace frontend\widgets;

use common\models\WidgetCarousel;
use common\models\WidgetCarouselItem;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;

class LxbBanner extends Widget{
    /**
     * @var
     */
    public $key;

    public $options = [];

    public $controls = false;

    public $showIndicators = true;

    public $items = [];
    public $view = 'one_column';    //one_column, two_column, image_list, blank

    public function init() {
        if (!$this->key) {
            throw new InvalidConfigException;
        }
        if(isset($this->options['limit']) && $this->options['limit'] > 0){
            $limit = $this->options['limit'];
        }else{
            $limit = 5;
        }
        //get items
        $items = WidgetCarouselItem::getDb()->cache(function () use ($limit) {
            return WidgetCarouselItem::find()
            ->joinWith('carousel')
            ->where([
                '{{%widget_carousel_item}}.status' => 1,
                '{{%widget_carousel}}.status' => WidgetCarousel::STATUS_ACTIVE,
                '{{%widget_carousel}}.key' => $this->key,
            ])->limit($limit)
            ->orderBy(['order' => SORT_ASC, 'id' => SORT_DESC])->all();
        }, Yii::$app->params['cache_time']);    
        $this->items = $items;
        parent::init();

    }

    public function run(){
        if($this->view=='two_column'){
            $view = 'banner_two_column';
        }else if($this->view=='image_list'){
            $view = 'banner_image_list';
        }else if($this->view=='blank'){
            $view = 'blank';
        }else{
            $view = 'banner';
        }
        return $this->render($view,[
            'key'     =>  $this->key,
            'showIndicators'     =>  $this->showIndicators,
            'options'   =>  $this->options,
            'controls'     =>  $this->controls,
            'items'     =>  $this->items,
        ]);
    }
}