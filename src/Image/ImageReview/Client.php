<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Image\ImageReview;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 调用内容审核平台-图像接口
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function userDefined(array $params) {
        return $this->httpPostJson('rest/2.0/solution/v1/img_censor/v2/user_defined', $params);
    }

    /**
     * 组合服务接口(不推荐使用)
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function imgCensor(array $params) {
        return $this->httpPostJson('api/v1/solution/direct/img_censor', $params);
    }

    /**
     * 短视频审核接口
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function videoCensor(array $params) {
        return $this->httpPostJson('rest/2.0/solution/v1/video_censor/user_defined', $params);
    }

}