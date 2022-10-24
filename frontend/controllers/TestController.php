<?php
namespace frontend\controllers;

use common\components\SystemLog;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use Yii;

class TestController extends \yii\web\Controller{
    private $_authenUsername = 'nguyenpv';
    private $_authenPassword = 'Nguyen_Pham';

    public function init()
    {
        parent::init();
        self::_authentication($this->_authenUsername, $this->_authenPassword);
    }


    public function actionIndex()
    {
    }

    public function actionTestLog(){
        //LOG for debug
        $logMsg = array();
        $logMsg[] = array('-----------------#START----------------');
        $logMsg[] = array('params get: ' . Json::encode($_GET));
        $logFolder = "Test/" . date("Y") . "/" . date("m");
        $logRequest = new SystemLog($logFolder);
        $logRequest->setLogFile('receiver_data' . date("Ymd") . '.log');
        @$logRequest->processWriteLogs($logMsg);
        //END LOG
    }

    public function actionServer(){
        VarDumper::dump($_SERVER,10,true);
    }

    public function actionPhpinfo(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        phpinfo();
    }

    private static function _authentication($authenUsername, $authenPassword)
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || ($_SERVER['PHP_AUTH_USER'] != $authenUsername) || ($_SERVER['PHP_AUTH_PW'] != $authenPassword)) {
            header('WWW-Authenticate: Basic realm="Authentication System"');
            header('HTTP/1.0 401 Unauthorized');
            echo "You must enter a valid login ID and password to access this page\n";
            exit;
        }
    }
} 