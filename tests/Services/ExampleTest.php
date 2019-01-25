<?php

namespace Tests\Services;

use Mx\Testing\TestCase;

/**
 * **后端模块 **Service调用的测试 (示例)
 *
 * @see TestCase
 * @author renzhenguo <renzhenguo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class ExampleTest extends TestCase
{
    /**
     * test case 1
     *
     * @return void
     */
    public function testExample()
    {
        # 调用service 获取结果的测试对象
        $test = $this->callService('\\App\\Service\\Example', [
            'param1' => 'aa',
            'param2' => 2333,
        ]);

        # 断言
        $test->assertSuccess()                    // 断言 调用成功(未抛出异常, 正常情况) 
            ->assertResultType('array')           // 断言 返回数据类型为 array
            ->assertResultArray('param1', 'aa');  // 断言 返回结果中 包含param1 并且值为aa
            //->assertResultValue('aaa');         // 断言 返回结果值为aaa


        # 断言 调用失败(service抛出异常, 传错参数等 异常情况下)
        #$test->assertFailure();

        # 获取到service调用返回结果 来做其他断言
        $result = $test->getResult();

        # 可用断言方法参考phpunit, 根据需要调用$this->assert***, 如:
        #$this->assertTrue(is_array($result));
    }
}
