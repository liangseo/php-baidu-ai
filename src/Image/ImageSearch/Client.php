<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Image\ImageSearch;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 相同图片搜索—入库
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sameHqAdd(array $params) {
        return $this->httpPostJson('rest/2.0/realtime_search/same_hq/add', $params);
    }

    /**
     * 相同图片搜索—检索
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sameHqSearch(array $params) {
        return $this->httpPostJson('rest/2.0/realtime_search/same_hq/search', $params);
    }

    /**
     * 相同图片搜索—删除
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sameHqDelete(array $params) {
        return $this->httpPostJson('rest/2.0/realtime_search/same_hq/delete', $params);
    }

    /**
     * 相同图片搜索—更新
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sameHqUpdate(array $params) {
        return $this->httpPostJson('rest/2.0/realtime_search/same_hq/update', $params);
    }

    /**
     * 相似图片搜索—入库
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function similarAdd(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/similar/add', $params);
    }

    /**
     * 相似图片搜索—检索
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function similarSearch(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/similar/search', $params);
    }

    /**
     * 相似图片搜索—删除
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function similarDelete(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/similar/delete', $params);
    }

    /**
     * 相似图片搜索—更新
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function similarUpdate(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/similar/update', $params);
    }

    /**
     * 商品图片搜索—入库
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function productAdd(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/product/add', $params);
    }

    /**
     * 商品图片搜索—入库
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function productSearch(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/product/search', $params);
    }

    /**
     * 商品图片搜索—删除
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function productDelete(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/product/delete', $params);
    }

    /**
     * 商品图片搜索—更新
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function productUpdate(array $params) {
        return $this->httpPostJson('rest/2.0/image-classify/v1/realtime_search/product/update', $params);
    }

}