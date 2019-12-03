<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Text\Car;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 行驶证识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vehicleLicense(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/vehicle_license', $params);
    }

    /**
     * 驾驶证识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function drivingLicense(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/driving_license', $params);
    }

    /**
     * 车牌识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function licensePlate(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/license_plate', $params);
    }

    /**
     * VIN码识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vinCode(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/vin_code', $params);
    }

    /**
     * 机动车销售发票识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vehicleInvoice(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/vehicle_invoice', $params);
    }

    /**
     * 车辆合格证识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vehicleCertificate(array $params = []) {
        return $this->httpPostJson('rest/2.0/ocr/v1/vehicle_certificate', $params);
    }

}