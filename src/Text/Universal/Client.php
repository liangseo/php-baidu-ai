<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Text\Universal;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 识别所有的文字
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function generalBasic(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/general_basic',$params);
    }

    /**
     * 识别所有文字（含文字位置信息）
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function general(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/general', $params);
    }

    /**
     * 识别所有文字（高精度版）
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function accurateBasic(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/accurate_basic', $params);
    }

    /**
     * 识别所有文字（高精度版 含位置）
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function accurate(array $params = []) {
        return $this->httpPostJson('https://aip.baidubce.com/rest/2.0/ocr/v1/accurate', $params);
    }


}