<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Face\FaceAnalysis;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 人脸检测与属性分析
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function detect(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/detect',$params);
    }

    /**
     * 人脸对比
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function match(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/match', $params);
    }

    /**
     * 人脸搜索
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function search(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/search', $params);
    }


    /**
     * 身份验证(公安验证)
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function verify(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/person/verify', $params);
    }

    /**
     * 在线活体检测
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function faceVerify(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceverify', $params);
    }

    /**
     * 语音校验码接口
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sessionCode(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v1/faceliveness/sessioncode', $params);
    }

    /**
     * 视频活体检测接口
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function videoVerify(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v1/faceliveness/verify', $params);
    }

    /**
     * 人脸融合
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function faceMerge(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v1/merge', $params);
    }

}