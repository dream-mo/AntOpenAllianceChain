<?php

namespace Dreammo\AntOpenAllianceChain;

/**
 * Class Client
 * @package Dreammo\AntOpenAllianceChain
 *
 * 蚂蚁链开放联盟链客户端类
 *
 */
class Client
{
    /**
     * @var Request|null
     *
     */
    private $requestInstance = null;

    /**
     * AntOpenAllianceChainApiClient constructor.
     * @param Request $requestInstance
     *
     */
    public function __construct(Request $requestInstance)
    {
        $this->requestInstance = $requestInstance;
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $content
     * @param $gas
     * @param $tenantid
     * @return array|mixed|string
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4-u5B58u8BC1
     *
     * 存证
     *
     */
    public function deposit($orderId, $account, $mykmsKeyId, $content, $gas, $tenantid)
    {
        $data = [
            'method' => 'DEPOSIT',
            'orderId' => $orderId,
            'account' => $account,
            'content' => $content,
            'mykmsKeyId' => $mykmsKeyId,
            'gas' => $gas,
            'tenantid' => $tenantid
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $contractName
     * @param $contractCode
     * @param $gas
     * @param $tenantid
     * @return array|mixed|string
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4--wasm-
     *
     * 部署 WASM 合约
     *
     */
    public function deployWasmContract($orderId, $account, $mykmsKeyId, $contractName, $contractCode, $gas, $tenantid)
    {
        $data = [
            'method' => 'DEPLOYWASMCONTRACT',
            'orderId' => $orderId,
            'account' => $account,
            'mykmsKeyId' => $mykmsKeyId,
            'contractName' => $contractName,
            'contractCode' => $contractCode,
            'gas' => $gas,
            'tenantid' => $tenantid
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $contractName
     * @param $methodSignature
     * @param $inputParamListStr
     * @param $outTypes
     * @param $gas
     * @param $tenantid
     * @return array|mixed|string
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4--wasm--1
     *
     * 调用 WASM 合约
     *
     */
    public function callWasmContract($orderId, $account, $mykmsKeyId, $contractName, $methodSignature,
                                     $inputParamListStr, $outTypes, $gas, $tenantid)
    {
        $data = [
            'method' => 'CALLWASMCONTRACT',
            'orderId' => $orderId,
            'account' => $account,
            'mykmsKeyId' => $mykmsKeyId,
            'contractName' => $contractName,
            'methodSignature' => $methodSignature,
            'inputParamListStr' => $inputParamListStr,
            'outTypes' => $outTypes,
            'gas' => $gas,
            'tenantid' => $tenantid
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $contractName
     * @param $contractCode
     * @param $vmTypeEnum
     * @param $withGasHold
     * @param $gasAccount
     * @param $gas
     * @return array|mixed|string
     * @throws \Exception
     *
     * 升级Wasm合约
     *
     */
    public function upgradeWasmContract($orderId, $account, $mykmsKeyId, $contractName,
                                        $contractCode, $vmTypeEnum, $withGasHold, $gasAccount, $gas)
    {
        $data = [
            'method' => 'CALLWASMCONTRACT',
            'orderId' => $orderId,
            'account' => $account,
            'mykmsKeyId' => $mykmsKeyId,
            'contractName' => $contractName,
            'contractCode' => $contractCode,
            'vmTypeEnum' => $vmTypeEnum,
            'withGasHold' => $withGasHold,
            'gasAccount' => $gasAccount,
            'gas' => $gas
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $contractName
     * @param $contractCode
     * @param $gas
     * @param $tenantid
     * @return array|mixed|string
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4--solidity-
     *
     * 部署Solidity合约
     *
     */
    public function deploySolidityContract($orderId, $account, $mykmsKeyId, $contractName, $contractCode, $gas, $tenantid)
    {
        $data = [
            'method' => 'DEPLOYCONTRACTFORBIZ',
            'orderId' => $orderId,
            'account' => $account,
            'mykmsKeyId' => $mykmsKeyId,
            'contractName' => $contractName,
            'contractCode' => $contractCode,
            'gas' => $gas,
            'tenantid' => $tenantid
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $contractName
     * @param $methodSignature
     * @param $inputParamListStr
     * @param $outTypes
     * @param $gas
     * @param $tenantid
     * @return array|mixed|string
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4--solidity--2
     *
     * 异步调用solidity合约
     *
     */
    public function callSolidityAsync($orderId, $account, $mykmsKeyId, $contractName, $methodSignature,
                                      $inputParamListStr, $outTypes, $gas, $tenantid)
    {
        $data = [
            'method' => 'CALLCONTRACTBIZASYNC',
            'orderId' => $orderId,
            'account' => $account,
            'mykmsKeyId' => $mykmsKeyId,
            'contractName' => $contractName,
            'methodSignature' => $methodSignature,
            'inputParamListStr' => $inputParamListStr,
            'outTypes' => $outTypes,
            'gas' => $gas,
            'tenantid' => $tenantid
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $contractName
     * @param $contractCode
     * @param $vmTypeEnum
     * @param $withGasHold
     * @param $gasAccount
     * @param $gas
     * @return array|mixed|string
     * @throws \Exception
     * @link
     *
     * 升级Solidity合约
     *
     */
    public function upgradeSolidityContract($orderId, $account, $mykmsKeyId, $contractName, $contractCode, $vmTypeEnum, $withGasHold, $gasAccount, $gas)
    {
        $data = [
            'method' => 'CALLWASMCONTRACT',
            'orderId' => $orderId,
            'account' => $account,
            'mykmsKeyId' => $mykmsKeyId,
            'contractName' => $contractName,
            'contractCode' => $contractCode,
            'vmTypeEnum' => $vmTypeEnum,
            'withGasHold' => $withGasHold,
            'gasAccount' => $gasAccount,
            'gas' => $gas
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $orderId
     * @param $account
     * @param $mykmsKeyId
     * @param $newAccountId
     * @param $newAccountKmsId
     * @param $gas
     * @param $tenantid
     * @return array|mixed|string
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4--
     *
     * 创建账户（密钥托管）
     *
     */
    public function tenantCreateAccount($orderId, $account, $mykmsKeyId, $newAccountId, $newAccountKmsId, $gas, $tenantid)
    {
        $data = [
            'method' => 'TENANTCREATEACCUNT',
            'orderId' => $orderId,
            'account' => $account,
            'mykmsKeyId' => $mykmsKeyId,
            'newAccountId' => $newAccountId,
            'newAccountKmsId' => $newAccountKmsId,
            'gas' => $gas,
            'tenantid' => $tenantid
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $vmTypeEnum
     * @param $content
     * @param $abi
     * @return array|mixed|string
     * @throws \Exception
     *
     * 解析合约返回值
     *
     */
    public function parseOutput($vmTypeEnum, $content, $abi)
    {
        $data = [
            'method' => 'PARSEOUTPUT',
            'vmTypeEnum' => $vmTypeEnum,
            'content' => $content,
            'abi' => $abi
        ];
        return $this->requestInstance->chainCallForBiz($data);
    }

    /**
     * @param $txHash
     * @return array|mixed
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4-u67E5u8BE2u4EA4u6613
     *
     * 查询交易
     *
     */
    public function queryTransaction($txHash)
    {
        $data = [
            'method' => 'QUERYTRANSACTION',
            'hash' => $txHash
        ];
        return $this->requestInstance->chainCall($data);
    }

    /**
     * @param $txHash
     * @return array|mixed
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4-u67E5u8BE2u4EA4u6613u56DEu6267
     *
     * 查询交易回执
     *
     */
    public function queryReceipt($txHash)
    {
        $data = [
            'method' => 'QUERYRECEIPT',
            'hash' => $txHash
        ];
        return $this->requestInstance->chainCall($data);
    }

    /**
     * @param $txHash
     * @param $abi
     * @param string $vmTypeEnum
     * @return array|bool|mixed|string
     * @throws \Exception 查询交易回执且解析output内容
     */
    public function queryReceiptParseOutput($txHash, $abi, $vmTypeEnum = 'EVM')
    {
        $body = $this->queryReceipt($txHash);
        if ($body['success'] === true && $body['code'] == 200) {
            $data = json_decode($body['data'], true);
            $output = $data['output'];
            $content = base64_encode(hex2bin($output));
            return $this->parseOutput($vmTypeEnum, $content, $abi);
        } else {
            return false;
        }
    }

    /**
     * @param $requestStr
     * @return array|mixed
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4--blockheader-
     *
     * 查询块头（BlockHeader）
     *
     */
    public function queryBlock($requestStr)
    {
        $data = [
            'method' => 'QUERYBLOCK',
            'requestStr' => $requestStr
        ];
        return $this->requestInstance->chainCall($data);
    }

    /**
     * @param $requestStr
     * @return array|mixed
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4--blockbody-
     *
     * 查询块体（BlockBody）
     *
     */
    public function queryBlockBody($requestStr)
    {
        $data = [
            'method' => 'QUERYBLOCKBODY',
            'requestStr' => $requestStr
        ];
        return $this->requestInstance->chainCall($data);
    }

    /**
     * @return array|mixed
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4-u67E5u8BE2u6700u65B0u5757u9AD8
     *
     * 查询最新块高
     *
     */
    public function queryLastBlock()
    {
        $data = [
            'method' => 'QUERYLASTBLOCK',
        ];
        return $this->requestInstance->chainCall($data);
    }

    /**
     * @param $requestStr
     * @return array|mixed
     * @throws \\Exception
     * @throws \Exception
     * @link https://antchain.antgroup.com/docs/11/146925#h4-u67E5u8BE2u8D26u6237
     *
     * 查询账户
     */
    public function queryAccount($requestStr)
    {
        $data = [
            'method' => 'QUERYACCOUNT',
            'requestStr' => $requestStr
        ];
        return $this->requestInstance->chainCall($data);
    }
}