<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Text\Card;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 身份证识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function idCard(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/idcard', $params);
    }

    /**
     * 银行卡识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bankcard(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/bankcard', $params);
    }

    /**
     * 营业执照识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function businessLicense(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/business_license', $params);
    }

    /**
     * 名片识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function businessCard(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/business_card', $params);
    }

    /**
     * 护照识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function passport(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/passport', $params);
    }

    /**
     * 港澳通行证识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function hkMacaoPass(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/HK_Macau_exitentrypermit', $params);
    }

    /**
     * 台湾通行证识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function taiwanPass(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/taiwan_exitentrypermit', $params);
    }

    /**
     * 户口本识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function householdRegister(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/household_register', $params);
    }

    /**
     * 出生医学证明识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function birthCertificate(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/birth_certificate', $params);
    }


}