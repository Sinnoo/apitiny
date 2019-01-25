<?php

namespace Api\Action\Spider;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * Class: Main
 *
 * @see ActionAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Main extends ActionAbstract
{
    protected $validateRulesPost    = [
        'params' => [
            'desc' => '参数',
            'message' => '参数不能为空',
            'rules' => ['required'],
        ],
        'env' => [
            'desc' => '环境',
            'message' => '环境不能为空',
            'rules' => ['required'],
        ],
        'app' => [
            'desc' => '应用',
            'message' => '应用不能为空',
            'rules' => ['required'],
        ],
        'urlId' => [
            'desc' => 'urlId',
            'message' => 'URL地址的ID不能为空',
            'rules' => ['required'],
        ],
        'url' => [
            'desc' => 'url',
            'message' => 'URL不能为空',
            'rules' => ['required'],
        ],
    ];

    /**
     * 请求接口数据
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->getData();
        $this->response($data);
    }

    /*
     * 获取接口的数据
     *
     * @return array
     */
    protected function getData()
    {
        $data = $this->getCurl();
        if ($data) {
            if ((int)$data['code'] !== 0) {
                if ($data['code'] != 200) {
                    return $this->fault(403, $data['message']);
                }
                $this->getResponse($data['data']);
                return $data['data'];
            }
        }
        #不是成功,不是失败,返回原内容;
        return $data;
    }

    /*
     * 获取接口的返回值
     *
     * @return array
     */
    protected function getResponse($data)
    {
        $one = $this->callService(
            'Response\\One',
            ['query' => ['urlId' => $this->validatedData['urlId']]]
        );
        if ($one->id) {
            return true;
        }
        $data = $this->getResponseArr($data);
        $update['responseData'] = $data;
        $update['urlId'] = $this->validatedData['urlId'];
        $update['utime'] = time();
        return $this->callService(
            'Response\\Add',
            ['query' => ['urlId' => $this->validatedData['urlId']],
            'update' => $update]
        );
    }

    /*
     * 获取回复的数组
     *
     * @return array
     */
    protected function getResponseArr($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = array(
                'name' => $key,
                'desc' => '',
                'case' => '',
                'type' => gettype($value),
            );
            if (is_array($value)) {
                foreach ($value as $key2 => $value2) {
                    if (is_int($key2)) {
                        if ($key2 === 0) {
                            #是一个数组,只要数组的第一个对象就好
                            foreach ($value2 as $key3 => $value3) {
                                $result[$key]['responseData'][] = array(
                                    'name' => $key3,
                                    'desc' => '',
                                    'case' => (string)$value3,
                                    'type' => gettype($value3),
                                );
                            }
                        }
                    } elseif (!is_int($key2)) {
                        $result[$key]['responseData'][] = array(
                            'name' => $key2,
                            'desc' => '',
                            'case' => (string)$value2,
                            'type' => gettype($value2),
                        );
                    }
                }
            }
        }
        return $result;
    }

    /*
     * 请求地址
     *
     * @return array
     */
    protected function getCurl()
    {
        $setopt = array(
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_TIMEOUT' => 5,
        );
        $params = $this->getParams();
        $url = $this->validatedData['url'];
        if ($this->validatedData['env'] == 'prod') {
            $params = $this->signParams($params);
        }
        $curl = new \Mx\Rest\Curl($url);
        $curl->setoptArray($setopt);
        $data = $curl->exec($params);
        if ($result = json_decode($data, true)) {
            return $result;
        }
        return $data;
    }

    /*
     * 签名参数
     *
     * @return array
     */
    protected function signParams($params)
    {
        $params['timestamp'] = time();
        $params['sign'] = $this->callService(
            'Common\\Sign',
            ['queryString' => $params,
            'appName' => $this->validatedData['app']]
        );
        return $params;
    }

    /*
     * 获取参数
     *
     * @return array
     */
    protected function getParams()
    {
        $params = [];
        foreach ($this->validatedData['params'] as $value) {
            #必填的参数
            if ($value['must'] === 'true') {
                $params[$value['name']] = $value['case'];
                #参数是个图片
                if ($value['type'] === 'file') {
                    $file = "/tmp/api_image.jpg";
                    $content = file_get_contents($value['case']);
                    file_put_contents($file, $content);
                    $params[$value['name']] = new \CURLFile($file);
                }
            }
        }
        return $params;
    }
}
