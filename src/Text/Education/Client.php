<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Text\Education;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 手写文字识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handwriting(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/handwriting', $params);
    }

    /**
     * 公式识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function formula(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/formula', $params);
    }

}