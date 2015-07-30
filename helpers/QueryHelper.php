<?php
namespace app\helpers;

use Yii;
use \yii\helpers\Json;

class QueryHelper {

    public static function doQuery($url)
    {
        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

        $jsonResponse = curl_exec($curl_handle);
        $response = Json::decode($jsonResponse);
        curl_close($curl_handle);

        return $response;
    }

    public static function createQuery($method, $params = null)
    {
        if ($method == 'authorize')
        {
            $query = Yii::$app->params['auth_url'].
                '/'.
                $method.
                '?'.
                rawurldecode(http_build_query(Yii::$app->params['code_request']));
        }
        elseif ($method == 'access_token')
        {
            $query = Yii::$app->params['auth_url'].
                '/'.
                $method.
                '?'.
                rawurldecode(http_build_query(Yii::$app->params['token_request'])).
                "&code=".
                $params['code'];
        }
        else
        {
            $query = Yii::$app->params['api_url'].
                '/'.
                $method.
                '?'.
                rawurldecode(http_build_query($params));
        }
        return $query;
    }

}