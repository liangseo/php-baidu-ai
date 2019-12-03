<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Face\FaceLibrary;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 添加人脸
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/user/add', $params);
    }

    /**
     * 人脸更新
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/user/update', $params);
    }

    /**
     * 人脸删除
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/face/delete', $params);
    }

    /**
     * 用户信息查询
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/user/get', $params);
    }

    /**
     * 获取用户人脸列表
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getFaceList(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/face/getlist', $params);
    }

    /**
     * 获取用户列表
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserList(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/group/getusers', $params);
    }

    /**
     * 复制用户
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function copyUser(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/user/copy', $params);
    }

    /**
     * 删除用户
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteUser(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/user/delete', $params);
    }

    /**
     * 创建用户组
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addUserGroup(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/group/add', $params);
    }

    /**
     * 删除用户组
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteUserGroup(array $params = []) {
        return $this->httpPostJson('rest/2.0/face/v3/faceset/group/delete', $params);
    }

}