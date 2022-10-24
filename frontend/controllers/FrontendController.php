<?php
namespace frontend\controllers;

use common\components\CFunction;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use common\models\WidgetText;

class FrontendController extends Controller{

    public $pageTitle = '';
    public $pageDecription = '';
    public $pageKeywords = '';
    public $fb_app_id = '';
    public $fb_content_type = '';
    public $pageImage = '';
    public $pageUrl = '';

    public $config = array();
    public function init(){
        parent::init();
        //lang
        Yii::$app->language = 'vi';
        //config    
        $config = WidgetText::getDb()->cache(function () {
            return WidgetText::find()->where([
                'status'    =>  1
            ])->all();
        }, Yii::$app->params['cache_time']);            
        if(is_array($config) && count($config) > 0){
            foreach ($config as $it){
                $this->config[$it->key] = $it->body;
            }
        }
        //
        $this->pageTitle = isset($this->config['site_name'])?$this->config['site_name']:Yii::$app->name;
        $this->pageKeywords = isset($this->config['site_keyword'])?$this->config['site_keyword']:'';
        $this->pageDecription  = isset($this->config['site_decription'])?$this->config['site_decription']:'';
        $this->fb_app_id  = isset($this->config['fb_app_id'])?$this->config['fb_app_id']:'';
        $this->fb_content_type  = 'website';
        $this->pageImage = isset($this->config['site_image'])?$this->config['site_image']:'';
        $this->pageUrl = CFunction::getCurrentAddress();
    }
}