<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Text\Other;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 网络图片文字识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function webImage(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/webimage', $params);
    }

    /**
     * 表格文字识别(异步接口)
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function tableText(array $params = []) {
        return $this->httpPostJson('rest/2.0/solution/v1/form_ocr/request', $params);
    }

    /**
     * 表格文字识别(同步接口)
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function form(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/form', $params);
    }

    /**
     * 数字识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function numbers(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/numbers', $params);
    }

    /**
     * 二维码识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function qrCode(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/qrcode', $params);
    }

    /**
     * 印章检测
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function seal(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/seal', $params);
    }

}