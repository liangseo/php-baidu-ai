<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Image\HumanAnalysis;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 人体关键点识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bodyAnalysis(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/body_analysis',$params);
    }

    /**
     * 人体检测和属性识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bodyAttr(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/body_attr', $params);
    }

    /**
     * 人流量统计
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bodyNum(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/body_num', $params);
    }

    /**
     * 手势识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function gesture(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/gesture', $params);
    }

    /**
     * 人像分割
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bodySeg(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/body_seg', $params);
    }

    /**
     * 驾驶行为分析
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function driverBehavior(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/driver_behavior', $params);
    }

    /**
     * 人流量统计（动态版）
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bodyTracking(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/body_tracking', $params);
    }

    /**
     * 手部关键点识别
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handAnalysis(array $params = []) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/hand_analysis', $params);
    }

    /**
     * 危险行为识别（邀测）
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bodyDanger(array $params = []) {
        return $this->httpPostJson('rest/2.0/video-classify/v1/body_danger', $params);
    }

}