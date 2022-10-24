<?php
namespace common\components;

use Yii;
use yii\helpers\VarDumper;
use common\components\MobileDetect;

class CFunction
{
    public static function unsign_string($str, $separator = '-', $keep_special_chars = false)
    {
        $str = str_replace(array("à", "á", "ạ", "ả", "ã", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ"), "a", $str);
        $str = str_replace(array("À", "Á", "Ạ", "Ả", "Ã", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ"), "A", $str);
        $str = str_replace(array("è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ"), "e", $str);
        $str = str_replace(array("È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ"), "E", $str);
        $str = str_replace("đ", "d", $str);
        $str = str_replace("Đ", "D", $str);
        $str = str_replace(array("ỳ", "ý", "ỵ", "ỷ", "ỹ", "ỹ"), "y", $str);
        $str = str_replace(array("Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ"), "Y", $str);
        $str = str_replace(array("ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ"), "u", $str);
        $str = str_replace(array("Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ"), "U", $str);
        $str = str_replace(array("ì", "í", "ị", "ỉ", "ĩ"), "i", $str);
        $str = str_replace(array("Ì", "Í", "Ị", "Ỉ", "Ĩ"), "I", $str);
        $str = str_replace(array("ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ"), "o", $str);
        $str = str_replace(array("Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ"), "O", $str);
        if ($keep_special_chars == false) {
            $str = str_replace(array('–', '…', '“', '”', "~", "!", "@", "#", "$", "%", "^", "&", "*", "/", "\\", "?", "<", ">", "'", "\"", ":", ";", "{", "}", "[", "]", "|", "(", ")", ",", ".", "`", "+", "=", "-"), $separator, $str);
            $str = preg_replace("/[^_A-Za-z0-9- ]/i", '', $str);
        }

        $str = str_replace(' ', $separator, $str);

        return trim(strtolower($str), "-");
    }

    public static function createUniqueId()
    {
        $str = sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',     //8 4 4 4 12
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
        /*$random_str = self::createRandomString(16);
        $mili_second = microtime(true);
        $mili_second = str_replace(array(",", "."), "", $mili_second);*/
        return $str;
    }

    public static function createRandomString($lengthChars = 32)
    {
        if ($lengthChars <= 0) {
            return FALSE;
        } else {
            $alphaString = 'abcdefghijklmnopqrstuvwxyz';
            $numberString = '1234567890';

            $shuffleString = $alphaString . $numberString;
            $randomString = substr(str_shuffle($shuffleString), 0, $lengthChars);

            return $randomString;
        }
    }

    public static function generateRandomString($lengthChars = 32)
    {
        if ($lengthChars <= 0) {
            return FALSE;
        } else {
            $alphaString = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $numberString = '1234567890';

            $shuffleString = $alphaString . $numberString;
            $randomString = substr(str_shuffle($shuffleString), 0, $lengthChars);

            return $randomString;
        }
    }


    public static function createRandomNumber($length = 6)
    {
        if ($length <= 0) {
            return FALSE;
        } else {
            $alphaString = '';
            $numberString = '123456789078935412609632104785';

            $shuffleString = $alphaString . $numberString;
            $randomString = substr(str_shuffle($shuffleString), 0, $length);

            return $randomString;
        }
    }


    public static function getYoutubeId($url){
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return $match[1];
        /*preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        return $matches[0];*/
    }

    public static function printDateTime($timestamp)
    {
        if ($timestamp > 0) {
            return date('d-m-Y H:i:s', $timestamp);
        } else {
            return '';
        }
    }

    public static function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }

    public static function truncate($string, $length = 80, $etc = '...', $break_words = FALSE, $middle = FALSE)
    {
        if ($length == 0)
            return '';

        if (strlen($string) > $length) {
            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
            }
            if (!$middle) {
                return substr($string, 0, $length) . $etc;
            } else {
                return substr($string, 0, $length / 2) . $etc . substr($string, -$length / 2);
            }
        } else {
            return $string;
        }
    }

    // Function to get the client ip address
    public static function get_client_ip_server()
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public static function get_ip_server()
    {
        $ipaddress = '';
        if (isset($_SERVER['SERVER_ADDR'])) {
            $ipaddress = $_SERVER['SERVER_ADDR'];
        } else if (isset($_SERVER['LOCAL_ADDR'])) {
            $ipaddress = $_SERVER['LOCAL_ADDR'];
        } else {
            $ipaddress = 'Unknown';
        }

        return $ipaddress;
    }

    public static function getBrowser()
    {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $browser = "Unknown Browser";

        $browser_array = array(
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser'
        );

        foreach ($browser_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }

        }

        return $browser;

    }

    public static function getOS()
    {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform = "Unknown OS Platform";

        $os_array = array(
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }

        }

        return $os_platform;

    }

    public static function makePhoneNumberBasic($phonenumber, $zero = '0')
    {
        $newnumber = $phonenumber;

        if ($phonenumber != '') {
            if (substr($phonenumber, 0, 2) == '84') {
                $newnumber = substr($phonenumber, 2, strlen($phonenumber));
            } else if (substr($phonenumber, 0, 3) == '+84') {
                $newnumber = substr($phonenumber, 3, strlen($phonenumber));
            } else if (substr($phonenumber, 0, 4) == '0084') {
                $newnumber = substr($phonenumber, 4, strlen($phonenumber));
            } else if (substr($phonenumber, 0, 1) == '0') {
                $newnumber = substr($phonenumber, 1, strlen($phonenumber));
            }

            $newnumber = $zero . $newnumber;
        }

        return $newnumber;
    }

    public static function makePhoneNumberStandard($phonenumber)
    {
        $newnumber = $phonenumber;

        if ($phonenumber != '') {
            if (substr($phonenumber, 0, 2) == '84') {
                $newnumber = substr($phonenumber, 2, strlen($phonenumber));
            } else if (substr($phonenumber, 0, 3) == '+84') {
                $newnumber = substr($phonenumber, 3, strlen($phonenumber));
            } else if (substr($phonenumber, 0, 4) == '0084') {
                $newnumber = substr($phonenumber, 4, strlen($phonenumber));
            } else if (substr($phonenumber, 0, 1) == '0') {
                $newnumber = substr($phonenumber, 1, strlen($phonenumber));
            }

            $newnumber = "84" . $newnumber;
        }

        return $newnumber;
    }

    public static function valid_phone($input)
    {
        if (preg_match("/0[0-9]{9,10}$/i", $input) == TRUE || preg_match("/84[0-9]{9,10}$/i", $input) == TRUE) {
            return TRUE;
        } else return FALSE;
    }

    public static function callCURL($url, &$http_code, $time_out = 20)
    {
        $parsed = parse_url($url);
        if (isset($parsed['scheme']) && $parsed['scheme'] = 'https') {
            $is_https = true;
        } else {
            $is_https = false;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($is_https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $data;
    }

    public static function curlGetWithAuthen($username, $password, $url, $time_out = 20)
    {
        $parsed = parse_url($url);
        if (isset($parsed['scheme']) && $parsed['scheme'] = 'https') {
            $is_https = true;
        } else {
            $is_https = false;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($is_https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, '' . $username . ':' . $password . '');

        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return array(
            'status' => $http_code,
            'data' => $data
        );
    }

    public static function curlGet($url, $getHeader = true, $time_out = 20)
    {
        $parsed = parse_url($url);
        if (isset($parsed['scheme']) && $parsed['scheme'] = 'https') {
            $is_https = true;
        } else {
            $is_https = false;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($is_https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
        $data = curl_exec($ch);
        if ($getHeader) {
            $header = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $rs = array(
                'header' => $header,
                'data' => $data,
            );
        } else {
            $rs = $data;
        }

        curl_close($ch);

        return $rs;
    }

    public static function curlPostJson($url, $json_data, $time_out = 20)
    {
        //check url http or https
        $parsed = parse_url($url);
        if (isset($parsed['scheme']) && $parsed['scheme'] = 'https') {
            $is_https = true;
        } else {
            $is_https = false;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($is_https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "content-type: application/json",
        ));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);
        return array(
            'header' => $http_code,     //200: OK
            'error' => $err,
            'data' => $data,
        );
    }

    public static function curlPostJsonReferer($url, $json_data, $time_out = 20)
    {
        $parsed = parse_url($url);
        if (isset($parsed['scheme']) && $parsed['scheme'] = 'https') {
            $is_https = true;
        } else {
            $is_https = false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($is_https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
        curl_setopt($ch, CURLOPT_REFERER, 'http://cfi.vn');
        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array(
            'header' => $http_code,     //200: OK
            'data' => $data,
        );
    }

    public static function web_pager($count, $cpage, $limit = 3, $current_uri)
    {
        $pagerinf = array();
        $pagerinf['next'] = "";
        $pagerinf['previous'] = "";
        $pagerinf['strPager'] = "";
        if (!isset($cpage) || !is_numeric($cpage)) $cpage = 1;
        $numofpages = ceil($count / $limit);
        $ext_char = (strpos($current_uri, "?")) ? '&' : '?';

        if ($cpage > $numofpages) $cpage = $numofpages;
        if ($numofpages > 1) {
            if (($cpage > 1) & ($cpage < $numofpages)) {
                $pagerinf['previous'] = $current_uri . "" . $ext_char . "page" . ($cpage - 1);
                $pagerinf['next'] = $current_uri . "" . $ext_char . "page" . ($cpage + 1);
            } elseif ($cpage == 1) {
                $pagerinf['next'] = $current_uri . "" . $ext_char . "page" . ($cpage + 1);
            } elseif ($cpage == $numofpages) {
                $pagerinf['previous'] = $current_uri . "" . $ext_char . "page" . ($cpage - 1);
            }
            $pagerinf['numofpages'] = $numofpages;
            $pagerinf['curpage'] = $cpage;
            if ($cpage > 1 && $cpage <= $numofpages) {
                $pagerinf['strPager'] .= '<span><a href="' . $pagerinf['previous'] . '"> Trước </a></span>&nbsp;';
                $pagerinf['strPager'] .= '<span><a href="' . $current_uri . "" . $ext_char . "page=" . ($cpage - 1) . '">' . ($cpage - 1) . '</a></span>&nbsp;';
            }
            $pagerinf['strPager'] .= '<span><a style="color: #000; font-size: 15px;" href="' . $current_uri . "" . $ext_char . "page" . ($cpage) . '">' . ($cpage) . '</a></span>&nbsp;';
            if ($cpage < $numofpages) {
                $pagerinf['strPager'] .= '<span><a href="' . $current_uri . "" . $ext_char . "page=" . ($cpage + 1) . '">' . ($cpage + 1) . '</a></span>&nbsp;';
            }

            if ($cpage < $numofpages && $numofpages > 2) {
                $pagerinf['strPager'] .= '<span>...</span>';
                $pagerinf['strPager'] .= '<span><a href="' . $current_uri . "" . $ext_char . "page=" . ($numofpages) . '">' . ($numofpages) . '</a></span>&nbsp;';
                $pagerinf['strPager'] .= '<span><a href="' . $pagerinf['next'] . '"> Tiếp </a></span>';
            }

            return $pagerinf;
        }
    }

    public static function buildPagination($baseUrl, $totalPage, $currentPage, $offsetPage = 5, $addClass = ''){
        if(strpos($baseUrl,'?') > 1){
            $indicate = '&';
        }else{
            $indicate = '?';
        }
        if($totalPage > 1){
            $output = "<div class='dt-panigation'><div class='dt-panigation-inner ". $addClass ."'>";
            $page = max($currentPage,1);
            $start = $page - $offsetPage;
            if($start < 1){
                $start = 1;
            }

            $end = $page + $offsetPage;
            if($end > $totalPage){
                $end = $totalPage;
            }

            if($page > 1){
                $output .= "<a href='". $baseUrl . $indicate .'page='. ($page-1) ."' class='prev'><span class='prev_page_icon'></span>&laquo;</a> ";
            }else{
                $output .= "<a href='javascript:void(0);' class='prev disabled'><span class='prev_page_icon'></span>&laquo;</a> ";
            }


            if($page-$offsetPage > 1){
                $output .= " <a href='". $baseUrl ."'>1</a> ";
            }

            if($page > ($offsetPage+2)){
                $output .= "<a href='javascript:void(0);' class='disabled' style='border: 0;background: none;'>...</a>";
            }

            for($i=$start;$i<= $end; $i++){
                if($i == $page){
                    $output .= " <a href='javascript:void(0);' class='selected'>". $i ."</a> ";
                }else{
                    $output .= " <a href='". $baseUrl . $indicate .'page='. $i ."'>". $i ."</a> ";
                }

            }

            if($page < ($totalPage-$offsetPage-1)){
                $output .= "<a href='javascript:void(0);' class='disabled' style='border: 0;background: none;'>...</a>";
            }


            if($page+$offsetPage < $totalPage){
                $output .= " <a href='". $baseUrl . $indicate .'page='. $totalPage ."'>". $totalPage ."</a> ";
            }

            if($page < $totalPage){
                $output .= "<a href='". $baseUrl . $indicate .'page='. ($page+1) ."' class='next'>&raquo;<span class='next_page_icon'></span></a> ";
            }else{
                $output .= "<a href='javascript:void(0);' class='next disabled'>&raquo;<span class='next_page_icon'></span></a> ";
            }

            $output .= '</div></div>';
            return $output;
        }else{
            return '';
        }
    }

    public static function formatDate($val)     //timestamp
    {
        $formatter = Yii::$app->formatter;
        $date = $formatter->asDate($val, 'php:Y-m-d');
        return $date;
    }

    public static function formatDateTime($val)     //date time
    {
        $formatter = Yii::$app->formatter;
        $date = $formatter->asDate($val, 'php:d-m-Y H:i:s');
        return $date;
    }

    public static function buildRangeDay($date_from, $date_to)
    {
        $arr = array();
        $date_from = strtotime($date_from); // Convert date to a UNIX timestamp
        // Specify the end date. This date can be any English textual format
        $date_to = strtotime($date_to); // Convert date to a UNIX timestamp
        // Loop from the start date to end date and output all dates inbetween
        for ($i = $date_from; $i <= $date_to; $i += 86400) {
            $arr[] = date("d-m-Y", $i);
        }
        return $arr;
    }

    public static function getCategories($rangeDay = array())
    {
        $tmp = "";
        if (is_array($rangeDay) && count($rangeDay) > 0) {
            foreach ($rangeDay as $d) {
                $tmp .= "," . " " . "'" . $d . "'";
            }
            $tmp = trim($tmp, ",");
        }
        $categories = '[' . $tmp . ']';
        return $categories;
    }

    public function pagination($total, $cpage, $limit = 10, $links = 5, $list_class = 'pagination pagination-md')
    {
        //get the last page number
        $last = ceil($total / $limit);

        //calculate start of range for link printing
        $start = (($cpage - $links) > 0) ? $cpage - $links : 1;

        //calculate end of range for link printing
        $end = (($cpage + $links) < $last) ? $cpage + $links : $last;

        //ul boot strap class - "pagination pagination-sm"
        $html = '<ul class="' . $list_class . '">';

        $class = ($cpage == 1) ? "disabled" : ""; //disable previous page link <<<

        //create the links and pass limit and page as $_GET parameters

        //$cpage - 1 = previous page (<<< link )
        $previous_page = ($cpage == 1) ?
            '<a href=""><li class="' . $class . '">&laquo;</a></li>' : //remove link from previous button
            '<li class="' . $class . '"><a page="' . ($cpage - 1) . '" href="?limit=' . $limit . '&page=' . ($cpage - 1) . '">&laquo;</a></li>';

        $html .= $previous_page;

        if ($start > 1) { //print ... before (previous <<< link)
            $html .= '<li><a page="1" href="?limit=' . $limit . '&page=1">1</a></li>'; //print first page link
            $html .= '<li class="disabled"><span>...</span></li>'; //print 3 dots if not on first page
        }

        //print all the numbered page links
        for ($i = $start; $i <= $end; $i++) {
            $class = ($cpage == $i) ? "active" : ""; //highlight current page
            $html .= '<li class="' . $class . '"><a page="' . $i . '" href="?limit=' . $limit . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) { //print ... before next page (>>> link)
            $html .= '<li class="disabled"><span>...</span></li>'; //print 3 dots if not on last page
            $html .= '<li><a page="' . $last . '" href="?limit=' . $limit . '&page=' . $last . '">' . $last . '</a></li>'; //print last page link
        }

        $class = ($cpage == $last) ? "disabled" : ""; //disable (>>> next page link)

        //$cpage + 1 = next page (>>> link)
        $next_page = ($cpage == $last) ?
            '<li class="' . $class . '"><a href="">&raquo;</a></li>' : //remove link from next button
            '<li class="' . $class . '"><a page="' . ($cpage + 1) . '" href="?limit=' . $limit . '&page=' . ($cpage + 1) . '">&raquo;</a></li>';

        $html .= $next_page;
        $html .= '</ul>';

        return $html;
    }

    public function pager($url, $total, $cpage, $limit = 10, $links = 5, $list_class = 'pagination pagination-md')
    {
        $ext_char = (strpos($url, "?")) ? '&' : '?';
        //get the last page number
        $last = ceil($total / $limit);

        //calculate start of range for link printing
        $start = (($cpage - $links) > 0) ? $cpage - $links : 1;

        //calculate end of range for link printing
        $end = (($cpage + $links) < $last) ? $cpage + $links : $last;

        //ul boot strap class - "pagination pagination-sm"
        $html = '<ul class="' . $list_class . '">';

        $class = ($cpage == 1) ? "disabled" : ""; //disable previous page link <<<

        //create the links and pass limit and page as $_GET parameters

        //$cpage - 1 = previous page (<<< link )
        $previous_page = ($cpage == 1) ?
            '<a href=""><li class="' . $class . '">&laquo;</a></li>' : //remove link from previous button
            '<li class="' . $class . '"><a href="' . $url . $ext_char . 'limit=' . $limit . '&page=' . ($cpage - 1) . '">&laquo;</a></li>';

        $html .= $previous_page;

        if ($start > 1) { //print ... before (previous <<< link)
            $html .= '<li><a href="' . $url . $ext_char . 'limit=' . $limit . '&page=1">1</a></li>'; //print first page link
            $html .= '<li class="disabled"><span>...</span></li>'; //print 3 dots if not on first page
        }

        //print all the numbered page links
        for ($i = $start; $i <= $end; $i++) {
            $class = ($cpage == $i) ? "active" : ""; //highlight current page
            $html .= '<li class="' . $class . '"><a href="' . $url . $ext_char . 'limit=' . $limit . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) { //print ... before next page (>>> link)
            $html .= '<li class="disabled"><span>...</span></li>'; //print 3 dots if not on last page
            $html .= '<li><a href="' . $url . $ext_char . 'limit=' . $limit . '&page=' . $last . '">' . $last . '</a></li>'; //print last page link
        }

        $class = ($cpage == $last) ? "disabled" : ""; //disable (>>> next page link)

        //$cpage + 1 = next page (>>> link)
        $next_page = ($cpage == $last) ?
            '<li class="' . $class . '"><a href="">&raquo;</a></li>' : //remove link from next button
            '<li class="' . $class . '"><a href="' . $url . $ext_char . 'limit=' . $limit . '&page=' . ($cpage + 1) . '">&raquo;</a></li>';

        $html .= $next_page;
        $html .= '</ul>';

        return $html;
    }

    public static function number_format($string, $decimals = "", $dec_sep = ",", $thous_sep = ".")
    {
        $ret = '0';
        if ($string != '')
            $ret = number_format($string, $decimals, $dec_sep, $thous_sep);

        return $ret;
    }

    public static function registerJs($file)
    {
        Yii::$app->view->registerJsFile(
            Yii::$app->request->hostInfo . '/js/' . $file
        );
    }

    public static function registerCss($file)
    {
        Yii::$app->view->registerCssFile(
            Yii::$app->request->hostInfo . '/css/' . $file
        );
    }

    public static function dowloadFileHtmlToWord($html_content = '', $file_name = 'document_name')
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=" . $file_name . ".doc");
        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        echo "<body>";
        echo $html_content;
        echo "</body>";
        echo "</html>";
    }


    public static function dowloadFileHtmlToExcel($html_content = '', $file_name = 'excel_name')
    {
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;Filename=" . $file_name . ".xls");

        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        echo "<body>";
        echo $html_content;
        echo "</body>";
        echo "</html>";
    }

    public static function valid_email($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $youtube_video_url
     * @return bool
     */
    public static function get_youtube_video_ID($youtube_video_url)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_video_url, $match)) {
            $id = $match[1];
            return $id;
        } else {
            return false;
        }
    }

    public static function generate_file_name($type = 'file')
    {
        $ds = DIRECTORY_SEPARATOR ;
        $file_info = array();
        $curr_info = date("Y,m,d,H,i,s");
        list($year, $month, $day, $hour, $minute, $second) = @explode(",", $curr_info);
        $filename                   = $year . $month . $day . $hour . $minute . $second . self::random_generator(6);
        $file_info['name']          = $filename;
        $file_info['host_path']     = "".$ds."storage".$ds."" . $type . "".$ds."$year".$ds."$month".$ds."$day".$ds."";
        $file_info['physical_path'] = $type . "".$ds."$year".$ds."$month".$ds."$day".$ds."";

        return $file_info;
    }

    public static function random_generator($digits)
    {
        srand((double)microtime() * 10000000);
        $input = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        $temp  = "";
        for ($i = 1; $i < $digits + 1; $i++) {
            if (rand(1, 2) == 1) {
                $rand_index = array_rand($input);
                $temp .= $input[$rand_index];
            } else {
                $temp .= rand(0, 9);
            }

        }

        return $temp;
    }

    public static function cut_string($string, $length = 100, $etc = '...', $break_words = FALSE, $middle = FALSE)
    {
        if ($length == 0)
            return '';

        if (strlen($string) > $length) {
            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
            }
            if (!$middle) {
                return substr($string, 0, $length) . $etc;
            } else {
                return substr($string, 0, $length / 2) . $etc . substr($string, -$length / 2);
            }
        } else {
            return $string;
        }
    }
    public static function is_mobile(){
        $mobile = new MobileDetect();
        return $mobile->isMobile();
    }

    public static function getCurrentAddress(){
        $address = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
        $address .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
        $address .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
        return $address;
    }
    //function base Yii

    public static function getDomain(){
        return Yii::$app->request->hostInfo;
    }

    public static function image_url($path){
        return "".Yii::getAlias('@web')."/storage/web/source/".$path."";
    }

    public static function image_url_absolute($path){
        return self::getDomain().self::image_url($path);
    }

    public static function getAttributeByLanguage($model, $attribute){
        $lang = Yii::$app->language;
        if($lang=='en'){
            $tmp = $attribute."_en";
            $rs = $model->{$tmp}??$model[$tmp]??"";
        }else{
            $rs = $model->$attribute??$model[$attribute]??"";
        }
        return $rs;
    }
    public static function doImplode($array){
        if(!empty($array)) {
            return "'".implode("','", is_array($array) ? $array : array($array))."'";
        } else {
            return 0;
        }
    }

    public static function buildThumbnail($model, $w=0, $h=0){
        if($model['thumbnail_path']!="" && Yii::$app->keyStorage->get('frontend.thumbnail')=='enabled') {
            $img_config = [
                'glide/index',
                'path' => $model['thumbnail_path'],
            ];
            if(isset($w) && $w > 0){
                $img_config['w'] = $w;
            }
            if(isset($h) && $h > 0){
                $img_config['h'] = $h;
            }
            $image = Yii::$app->glide->createSignedUrl($img_config, true);
        }else{
            $image = $model['thumbnail_base_url'].'/'.$model['thumbnail_path'];
        }
        return self::getDomain().$image;
    }

    public static function getConfig($key){
        return Yii::$app->controller->config[$key]??'';
    }

    public static function setCookie($key,$val) {

        $cookies = Yii::$app->response->cookies;

        $cookies->add(new \yii\web\Cookie([
            'name' => $key,
            'value' => $val,
            'expire' => time() + 86400 * 365,
        ]));

    }

    public static function getCookie($key) {
        $cookieValue = false;
        $cookies1 = Yii::$app->request->cookies;

        if ($cookies1->has($key)){
            $cookieValue = $cookies1->getValue($key);
        }


        return $cookieValue;
    }


    public static function deleteCookie($key){
        $cookies = Yii::$app->response->cookies;
        $cookies->remove($key);
        return true;
    }

}