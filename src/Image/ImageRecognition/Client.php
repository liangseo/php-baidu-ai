<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Image\ImageRecognition;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 通用物体和场景识别高级版
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function advancedGeneral(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v2/advanced_general', $params);
    }

    /**
     * 图像主体检测
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function objectDetect(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/object_detect', $params);
    }

    /**
     * 菜品识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dish(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v2/dish', $params);
    }

    /**
     * 自定义菜品-入库
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dishAdd(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/dish/add', $params);
    }

    /**
     * 自定义菜品-检索
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dishSearch(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/dish/search', $params);
    }

    /**
     * 自定义菜品-删除
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dishDelete(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/dish/delete', $params);
    }

    /**
     * logo商标识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function logo(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v2/logo', $params);
    }

    /**
     * logo商标识别-添加
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function logoAdd(array $params) {
        return $this->httpPostJson('rest/2.0/realtime_search/v1/logo/add', $params);
    }

    /**
     * logo商标识别—删除
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function logoDelete(array $params) {
        return $this->httpPostJson('rest/2.0/realtime_search/v1/logo/delete', $params);
    }

    /**
     * 动物识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function animal(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/animal', $params);
    }

    /**
     * 植物识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function plant(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/plant', $params);
    }

    /**
     * 果蔬类食材识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function ingredient(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/classify/ingredient', $params);
    }

    /**
     * 地标识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function landmark(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/landmark', $params);
    }

    /**
     * 红酒识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function redWine(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/redwine', $params);
    }

    /**
     * 货币识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function currency(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/currency', $params);
    }

    /**
     * 车型识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function car(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/car', $params);
    }

    /**
     * 车辆检测
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vehicleDetect(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/vehicle_detect', $params);
    }

    /**
     * 车流统计
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function trafficFlow(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/traffic_flow', $params);
    }

    /**
     * 车辆属性识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vehicleAttr(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/vehicle_attr', $params);
    }

    /**
     * 车辆外观损伤识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vehicleDamage(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/vehicle_damage', $params);
    }

    /**
     * 车辆分割
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function vehicleSeg(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/vehicle_seg', $params);
    }


}