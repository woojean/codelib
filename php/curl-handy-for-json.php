<?php
/**
 */

class Curl
{
    const MODE_NORMAL = 1;
    const MODE_TEST = 2;

    public static $mode = Curl::MODE_NORMAL;

    protected static function curl($url, $protocol, $getParams = [], $postParams = [], $headerParams = [], $useSSL = FALSE)
    {
        $url = self::buildUrl($url, $getParams);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        if (self::$mode == Curl::MODE_TEST && PHP_OS != 'Linux') {
            curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        }

        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $useSSL);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $useSSL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3000);

        switch ($protocol) {
            case 'get':
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8'
                ));
                break;
            case 'put':
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($postParams)));
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postParams);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                break;
            case 'post':
                curl_setopt($curl, CURLOPT_POST, 1);
                if (is_array($headerParams) && count($headerParams)) {
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerParams);
                }
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postParams));
                break;
            case 'delete':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default :
                return "";
        }

        $data = curl_exec($curl);
        if (curl_errno($curl)) {
        }
        curl_close($curl);
        if (isset($put_data)) {
            fclose($put_data);
        }
        return $data;
    }

    protected static function buildUrl($base_url, $params, $encode_flag = TRUE)
    {
        if (is_array($params)) {
            $url = [];
            $url[] = $base_url;
            $url[] = '?';
            $url[] = http_build_query($params);
            $url = implode("", $url);
            return $encode_flag ? $url : urldecode($url);
        } else {
            return $base_url;
        }
    }

    // publics

    public static function postJSON($url, $getParams = [], $postParams = [], $headerParams = NULL)
    {
        try {
            $result = self::post($url, $getParams, $postParams, $headerParams);
            return json_decode($result, TRUE);
        } catch (Exception $e) {
            \Phalcon\DI::getDefault()->get('log')->error($e->getMessage());
            return NULL;
        }
    }

    public static function getJSON($url, array $getParams = [], $headerParams = NULL)
    {
        try {
            $result = self::get($url, $getParams, $headerParams);
            return json_decode($result, TRUE);
        } catch (Exception $e) {
            \Phalcon\DI::getDefault()->get('log')->error($e->getMessage());
            return NULL;
        }
    }

    public static function post($url, $getParams = [], $postParams = [], $headerParams = NULL)
    {
        return self::curl($url, 'post', $getParams, $postParams, $headerParams, FALSE);
    }

    public static function get($url, array $getParams = [], $headerParams = NULL)
    {
        return self::curl($url, 'get', $getParams, $headerParams, FALSE);
    }

    public static function delete($url, array $getParams = [], $headerParams = NULL)
    {
        return self::curl($url, 'delete', $getParams, $headerParams, FALSE);
    }

    public static function sslPost($url, $getParams = [], $postParams = [], $headerParams = NULL)
    {
        return self::curl($url, 'post', $getParams, $postParams, $headerParams, TRUE);
    }

    public static function sslGet($url, array $getParams = [], $headerParams = NULL)
    {
        return self::curl($url, 'get', $getParams, $headerParams, TRUE);
    }

    public static function sslDelete($url, array $getParams = [], $headerParams = NULL)
    {
        return self::curl($url, 'delete', $getParams, $headerParams, TRUE);
    }
}



//  ========================== demo ==================================

// 淘宝商品搜索建议（https、jsonp）
// https://suggest.taobao.com/sug?code=utf-8&q=商品关键字&callback=cb

$url = 'https://suggest.taobao.com/sug';

$params = [
    'code'=>'utf-8',
    'q'=>'iphone',
    'callback'=>'func'
];

$headerParams = [
    'Host'=>'suggest.taobao.com'
];

echo curl::sslGet($url,$params,$headerParams);







