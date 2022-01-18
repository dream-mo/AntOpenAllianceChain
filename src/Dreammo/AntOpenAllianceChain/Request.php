<?php


namespace Dreammo\AntOpenAllianceChain;

use WpOrg\Requests\Requests;

/**
 * Class Request
 * @package Dreammo\AntOpenAllianceChain
 *
 * 蚂蚁链开发联盟链-底层HTTP接口请求类
 *
 */
class Request
{
    private static $instance = null;

    private $accessId = '';
    private $accessKey = '';
    const BIZID = 'a00e36c5';// 固定值

    private $shakeHandToken = '';
    private $antBaseUrl = 'https://rest.baas.alipay.com';

    private function __construct($accessId, $accessKey)
    {
        $this->accessId = $accessId;
        $this->accessKey = $accessKey;
    }

    public static function getInstance($accessId, $accessKey)
    {
        if (!self::$instance) {
            self::$instance = new self($accessId, $accessKey);
        }
        return self::$instance;
    }

    /**
     * @param string $uri
     * @param array $data
     * @param string $method
     * @param array $headers
     * @return mixed
     * @throws \Exception
     *
     * 统一请求入口
     *
     */
    private function requests($uri, $data = [], $method = Requests::POST, $headers = [])
    {
        $url = $this->antBaseUrl . $uri;
        $commonHeaders = [
            'Content-Type' => 'application/json;charset=utf-8'
        ];
        if (!is_string($data)) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        $headers = array_merge($headers, $commonHeaders);
        try {
            $response = Requests::request($url, $headers, $data, $method);
            if ($response->body) {
                $result_data = json_decode($response->body, true);
                if (json_last_error()) {
                    throw new \Exception('Requests error:  response text is ' . $response->body);
                }
                return $result_data;
            } else {
                throw new \Exception('Requests error:  response text is ' . $response->body);
            }
        } catch (\Throwable $t) {
            throw new \Exception($t->getMessage());
        }
    }

    /**
     * @return bool
     * @throws \Exception
     *
     * 握手获取token
     *
     */
    public function shakeHand()
    {
        $uri = '/api/contract/shakeHand';
        $data = array(
            'accessId' => $this->accessId,
            'time' => $this->getSpecificMilliseconds(),
            'secret' => $this->genSign()
        );
        $body = $this->requests($uri, $data);
        if ($body['success'] === true && $body['code'] == 200) {
            $this->shakeHandToken = $body['data'];
            return true;
        }
        return false;
    }

    /**
     * @return string
     *
     * 返回token值
     *
     */
    public function getShakeHandToken()
    {
        return $this->shakeHandToken;
    }

    /**
     * 请求【交易消息类】接口
     *
     * @link https://antchain.antgroup.com/docs/11/146925#h3-u4EA4u6613u6D88u606Fu7C7B5
     * @param $data
     * @return array|mixed|string
     * @throws \Exception
     */
    public function chainCallForBiz($data)
    {
        $uri = '/api/contract/chainCallForBiz';
        $this->assemblyRequestData($data);
        $body = $this->requests($uri, $data);
        return $body;
    }

    /**
     *
     * @link https://antchain.antgroup.com/docs/11/146925#h3-u67E5u8BE2u6D88u606Fu7C7B6
     * @param $data
     * @return array|mixed
     * @throws \Exception
     *
     */
    public function chainCall($data)
    {
        $uri = '/api/contract/chainCall';
        $this->assemblyRequestData($data);
        $body = $this->requests($uri, $data);
        return $body;
    }

    /**
     * @param $txHash
     * @return string
     *
     * 返回交易区块二维码URL链接
     *
     */
    public static function getTransactionQR($txHash)
    {
        $bizid = self::BIZID;
        $url = "https://render.antfin.com/p/s/miniapp-web/?type=trans&from=antcloud&bizid={$bizid}&hash=" . $txHash;
        return $url;
    }

    /**
     * @param $rawData
     *
     * 统一组装请求数据
     *
     */
    private function assemblyRequestData(&$rawData)
    {
        $commonBody = array(
            'bizid' => self::BIZID,
            'accessId' => $this->accessId,
            'token' => $this->shakeHandToken
        );
        $rawData = array_merge($rawData, $commonBody);
    }

    /**
     * @return string
     *
     * 构造获取签名字符串
     *
     */
    private function genSign()
    {
        $data = $this->accessId . $this->getSpecificMilliseconds();
        $sign = '';
        openssl_sign($data, $sign, $this->accessKey, OPENSSL_ALGO_SHA256);
        $sign = bin2hex($sign);
        return $sign;
    }

    /**
     * @return string
     *
     * 获取特定毫秒数
     *
     */
    private function getSpecificMilliseconds()
    {
        $mill_time = microtime();
        $timeInfo = explode(' ', $mill_time);
        return sprintf('%d%03d', $timeInfo[1], $timeInfo[0] * 1000);
    }
}