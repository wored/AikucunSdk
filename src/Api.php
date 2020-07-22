<?php

namespace Wored\AikucunSdk;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    public $config;
    public $timestamp;
    public $loginData;

    /**
     * Api constructor.
     * @param $appkey
     * @param $appsecret
     * @param $sid
     * @param $baseUrl
     */
    public function __construct(AikucunSdk $aikucunSdk)
    {
        $this->config = $aikucunSdk->getConfig();
    }

    /**
     * api请求方法
     * @param $method域名后链接
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    public function request(string $interfaceName, array $params = [])
    {
        $request = [
            'appid'         => $this->config['appid'],
            'appsecret'     => $this->config['appsecret'],
            'version'       => $this->config['version'],
            'format'        => $this->config['format'],
            'interfaceName' => $interfaceName,
            'noncestr'      => uniqid(),
            'timestamp'     => time(),
            'body'          => json_encode($params),
        ];
        $request['sign'] = $this->sign($request);
        unset($request['appsecret'], $request['body']);
        $url = $this->config['rootUrl'] . '/api/v3?' . http_build_query($request);
        $http = $this->getHttp();
        $response = call_user_func_array([$http, 'json'], [$url, $params]);
        return json_decode(strval($response->getBody()), true);
    }

    /**
     * 生成签名
     * @param array $params请求的所有参数
     * @return string
     */
    public function sign(array $params)
    {
        unset($params['sign']);
        ksort($params);
        foreach ($params as $k => $v) {
            $string[] = $k . '=' . $v;
        }
        return sha1(implode('&', $string));
    }
}