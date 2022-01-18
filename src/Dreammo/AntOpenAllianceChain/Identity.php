<?php


namespace Dreammo\AntOpenAllianceChain;


/**
 * Class Identity
 *
 * 地址类
 *
 */
class Identity
{
    /**
     * @var string
     *
     * 地址字符串
     *
     */
    private $rawAddress = '';

    /**
     * Identity constructor.
     * @param $address
     *
     *
     */
    public function __construct($address)
    {
        $this->rawAddress = $address;
    }

    /**
     * @param $identityArr
     * @return Identity
     *
     */
    public static function parseIdentityArray($identityArr)
    {
        $address = $identityArr['data'];
        $address = bin2hex(base64_decode($address));
        return new self($address);
    }

    /**
     * @return string
     *
     */
    public function getRawAddress()
    {
        return $this->rawAddress;
    }

    /**
     * @return array
     *
     * 获取Identity的Array形式
     *
     */
    public function toArray()
    {
        return [
            'data' => $this->getEncodeIdentityString($this->rawAddress),
            'empty' => false,
            'value' => $this->getEncodeIdentityString($this->rawAddress)
        ];
    }

    /**
     * @return false|string
     *
     * 获取json字符串
     *
     */
    public function toJsonString()
    {
        return json_encode($this->toArray());
    }

    /**
     * @param $address
     * @return string
     *
     * 获取账号地址编码以后的字符串
     *
     */
    private function getEncodeIdentityString($address)
    {
        return base64_encode(hex2bin($address));
    }
}