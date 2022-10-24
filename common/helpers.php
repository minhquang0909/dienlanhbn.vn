<?php
/**
 * Yii2 Shortcuts
 * @author Eugene Terentev <eugene@terentev.net>
 * -----
 * This file is just an example and a place where you can add your own shortcuts,
 * it doesn't pretend to be a full list of available possibilities
 * -----
 */

/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url, $statusCode = 302)
{
    return Yii::$app->controller->redirect($url, $statusCode);
}

/**
 * @param $form \yii\widgets\ActiveForm
 * @param $model
 * @param $attribute
 * @param array $inputOptions
 * @param array $fieldOptions
 * @return string
 */
function activeTextinput($form, $model, $attribute, $inputOptions = [], $fieldOptions = [])
{
    return $form->field($model, $attribute, $fieldOptions)->textInput($inputOptions);
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env($key, $default = false) {

    $value = getenv($key);

    if ($value === false) {
        return $default;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;
    }

    return $value;
}

if(!function_exists('get_list_category_sorted')){

    $sort_category_result = array();
    /**
     * @param $start_level
     * @param $parent_id
     * @param $categories
     * @param int $reject_id
     * @return array
     */
    function get_list_category_sorted($start_level, $parent_id, $categories, $reject_id = 0){
        global $sort_category_result;
        if(is_array($categories) && count($categories) > 0){
            foreach($categories as $item){
                if($item['parent_id'] == $parent_id && $item['id'] != $reject_id){
                    $item['level'] = $start_level;
                    $sort_category_result[] = $item;
                    $child = sc_has_child($item['id'], $categories);
                    if($child === true){
                        get_list_category_sorted($start_level+1, $item['id'], $categories, $reject_id);
                    }
                }
            }
            return $sort_category_result;
        }else{
            return array();
        }
    }

    function sc_has_child($parent_id, $categories){
        foreach($categories as $item){
            if($item['parent_id'] == $parent_id){
                return true;
            }
        }
        return false;
    }
}

if(!function_exists('text_loop')){
    /**
     * @param $text
     * @param $times
     * @return string
     */
    function text_loop($text, $times){
        $result = "";
        for($i=0;$i<$times;$i++){
            $result .= $text;
        }
        return $result;
    }
}