<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Image\ImageEnhancement;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 图像去雾
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dehaze(array $params){
        return $this->httpPostJson('rest/2.0/image-process/v1/dehaze', $params);
    }

    /**
     * 图像对比度增强
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function contrastEnhance(array $params) {
        return $this->httpPostJson('rest/2.0/image-process/v1/contrast_enhance', $params);
    }

    /**
     * 图像无损放大
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function imageQualityEnhance(array $params) {
        return $this->httpPostJson('rest/2.0/image-process/v1/image_quality_enhance', $params);
    }

    /**
     * 黑白图像上色
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function colourize(array $params){
        return $this->httpPostJson('rest/2.0/image-process/v1/colourize', $params);
    }

    /**
     * 拉伸图像恢复
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function stretchRestore(array $params){
        return $this->httpPostJson('rest/2.0/image-process/v1/stretch_restore', $params);
    }

    /**
     * 图像风格转换
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function styleTrans(array $params){
        return $this->httpPostJson('rest/2.0/image-process/v1/style_trans', $params);
    }

    /**
     * 图像修复
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function inpainting(array $params){
        return $this->httpPostJson('rest/2.0/image-process/v1/inpainting', $params);
    }


}