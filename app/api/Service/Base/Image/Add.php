<?php

namespace Api\Service\Base\Image;

use Mx\Service\ServiceAbstract;

/**
 * 保存图片
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Add extends ServiceAbstract
{
    protected $deParams = [];

    protected function execute()
    {
        if (!$this->type || !$this->file) {
            return false;
        }
        return $this->saveImg();
    }

    /*
     * 存储图片获取图片的ID
     *
     * @return string
     */
    protected function saveImg()
    {
        $url = $this->config('mxss.api').'?do=Put&type=' . $this->type;
        $info = getimagesize($this->file);
        $curl = new \Mx\Rest\Curl($url);
        $fields = [
            'file' => new \CURLFile($this->file),
            'filename' => 'ktime_api_image',
            'mime' => $info['mime'],
        ];
        return $curl->rest($fields);
    }
}
