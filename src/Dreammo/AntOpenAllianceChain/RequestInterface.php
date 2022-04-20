<?php


namespace Dreammo\AntOpenAllianceChain;

/**
 * Interface RequestInterface
 * @package Dreammo\AntOpenAllianceChain
 *
 * Request请求接口规范
 *
 */
interface RequestInterface
{
    /**
     * @param $accessId
     * @param $accessKey
     * @return mixed
     *
     * 获取实例对象
     */
    public static function getInstance($accessId, $accessKey);

    /**
     * @return mixed
     *
     * 握手获取token
     *
     */
    public function shakeHand();

    /**
     * @return mixed
     *
     * 返回token值
     *
     */
    public function getShakeHandToken();

    /**
     * @link https://antchain.antgroup.com/docs/11/146925#h3-u4EA4u6613u6D88u606Fu7C7B5
     * @param $data
     * @return mixed
     *
     * 请求【交易消息类】接口
     *
     */
    public function chainCallForBiz($data);

    /**
     * @link https://antchain.antgroup.com/docs/11/146925#h3-u67E5u8BE2u6D88u606Fu7C7B6
     * @param $data
     * @return mixed
     *
     */
    public function chainCall($data);

    /**
     * @param $txHash
     * @return mixed
     *
     * 返回交易区块二维码URL链接
     *
     */
    public static function getTransactionQR($txHash);
}