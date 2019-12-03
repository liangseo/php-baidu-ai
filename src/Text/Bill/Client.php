<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Text\Bill;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 增值税发票识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vatInvoice(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/vat_invoice', $params);
    }

    /**
     * 定额发票识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function quotaInvoice(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/quota_invoice', $params);
    }

    /**
     * 通用机打发票识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function invoice(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/invoice', $params);
    }

    /**
     * 火车票识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function trainTicket(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/train_ticket', $params);
    }

    /**
     * 出租车票识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function taxiReceipt(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/taxi_receipt', $params);
    }

    /**
     * 行程单识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function airTicket(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/air_ticket', $params);
    }

    /**
     * 通用票据识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function receipt(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/receipt', $params);
    }

    /**
     * 保险单识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function insuranceDocuments(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/insurance_documents', $params);
    }

    /**
     * 彩票识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function lottery(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/lottery', $params);
    }


}