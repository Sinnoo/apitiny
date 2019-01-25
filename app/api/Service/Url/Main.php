<?php

namespace Api\Service\Url;

use Mx\Service\ServiceAbstract;

/**
 * Class: Main
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Main extends ServiceAbstract
{
    protected $deParams = [];

    protected function execute()
    {
        $data = $this->getData();
        return $this->formatData($data);
    }

    protected function formatData($data)
    {
        $result['meta'] = $data->meta;
        $result['list'] = [];
        if ($data->list) {
            foreach ($data->list as $value) {
                $result['list'][$value->a]['type'] = 'a';
                $result['list'][$value->a]['value'] = $value->a;
                if ($value->b) {
                    $result['list'][$value->a]['type'] = 'b';
                    $bArr[$value->b]['type'] = 'b';
                    $bArr[$value->b]['value'] = $value->b;
                    $bArr[$value->b]['lists'][] = array(
                        'id' => $value->id,
                        'app' => $value->app,
                        'desc' => $value->desc,
                        'title' => $value->title,
                        'mark' => $value->mark,
                        'type' => $value->type,
                        'value' => $value->value,
                        'path' => $value->a . '/' . $value->b,
                    );
                    $result['list'][$value->a]['lists'][$value->b] = $bArr[$value->b];
                } elseif (!$value->b) {
                    $result['list'][$value->a]['lists'][] = array(
                        'id' => $value->id,
                        'app' => $value->app,
                        'desc' => $value->desc,
                        'title' => $value->title,
                        'mark' => $value->mark,
                        'type' => $value->type,
                        'value' => $value->value,
                        'path' => $value->a,
                    );
                }
            }
        }
        return $result;
    }

    protected function getData()
    {
        $biz = new \Api\Biz\Url();
        try {
            return $biz->dao()
                ->page(1, 200)
                ->find($this->query);
        } catch (\Exception $e) {
            throw new \Exception('新增失败');
        }
    }
}
