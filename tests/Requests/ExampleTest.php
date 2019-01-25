<?php

namespace Tests\Requests;

use Mx\Testing\TestCase;

/**
 * **后端模块 **接口请求的测试 (示例)
 *
 * @see TestCase
 * @author renzhenguo <renzhenguo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class ExampleTest extends TestCase
{
    /**
     * 当前项目接口访问地址
     *
     * @var string
     */
    protected $baseUrl = 'http://router.dev.imoxiu.cn/~renzhenguo/demo/public/index.php';

    /**
     * test case 1
     *
     * @return void
     */
    public function testExample()
    {
        # 调用get请求 获取结果的测试对象
        $test = $this->getRequest('/main', ['test' => 'a', 'page' => 1]);

        # 断言
        $test->assertStatus(200)               // 断言 http状态为200
            ->assertTime(0.1)                  // 断言 http响应时间在0.1秒内
            ->assertJson()                     // 断言 响应内容为json格式
            ->assertJsonCode(200)              // 断言 响应json数据 code为200
            ->assertJsonData('dbconf', null);  // 断言 响应json数据 data包含dbconf 并且值为null


        # 断言响应header包含name
        #$test->assertHeader('name');

        # 断言请求被重定向
        #$test->assertRedirect();

        # 获取到响应内容 来做其他断言
        $result = $test->getResponse();

        # 可用断言方法参考phpunit, 根据需要调用$this->assert***, 如:
        #$this->assertTrue(is_array($result));
    }
}
