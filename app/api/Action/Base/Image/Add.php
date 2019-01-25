<?php

namespace Api\Action\Base\Image;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * 保存图片
 *
 * @see ActionAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Add extends ActionAbstract
{
    protected $validateRulesFile = [
        'file' => [
            'desc'=>'common文件',
            'message' => '图片不能为空且不能大于5兆',
            'type' => 'file',
            'rules' => ['required', 'size:5242880'],
        ]
    ];

    /**
     * 保存图片
     *
     * @return json
     */
    protected function handlePost()
    {
        $img = ($this->validatedFiles['file'])->getUploadInfo();
        if ($img['type'] == 'image/gif') {
            $this->fault(403, '暂不支持gif图片上传');
        } elseif ($img['type'] == 'image/jpeg') {
            $data = $this->doAddImg($img);
        } elseif ($img['type'] == 'image/png') {
            $data = $this->doAddImg($img);
        }
        $this->response($data);
    }

    /*
     * 保存图片
     *
     * @return array
     */
    protected function doAddImg($img)
    {
        $result = array(
            'id' => '',
            'url' => '',
            'width' => '',
            'height' => '',
            'mime' => '',
        );
        $config = $this->config('mxss.common')[0];
        $info = getimagesize($img['tmp_name']);
        $imgId = $this->callService(
            'Base\\Image\\Add',
            ['file' => $img['tmp_name'],
            'type' => 'common']
        );
        if ($imgId) {
            $result = array(
                'id' => $imgId,
                'url' => $config . $imgId,
                'width' => $info[0],
                'height' => $info[1],
                'mime' => $info['mime'],
            );
        }
        return $result;
    }
}
