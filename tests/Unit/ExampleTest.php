<?php
namespace Tests\Unit;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Fnf\Fnf;
use phpDocumentor\Reflection\Types\True_;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testDemo()
    {
        AlibabaCloud::accessKeyClient('LTAI4G6ohAdb3LiM7dqAWvTp','')
            ->regionId('')
            ->asDefaultClient();
        try {
            // 访问产品 APIs
            $request1 = Fnf::v20190315()->createFlow();

            // 设置选项/参数并执行请求
            // 创建一个 Flow
            $result1 = $request1->withDefinition('xxx') // API 的参数
            ->withName('xxx')
                ->withRoleArn('xxx')
                ->withDescription('xxx')
                ->withType('FDL')
                //->scheme("https")
                //->client('client1') // 指定发送客户端，否则使用全局客户端
                ->debug(true) // 开启调试会输出详细信息
                ->connectTimeout(10) // 连接超时会抛出异常
                ->timeout(10) // 超时会抛出异常
                ->request(); // 执行请求

            // 开始一个执行
            // 下面示例展示了如何直接使用 options 传入 SDK 调用的相关参数，
            // 也可以参照 $request1 使用 withxxx 方式调用
            $options = [
                'debug'=>true,
                'connect_timeout'=>10,
                'timeout'=>10,
                'form_params'=>[
                    'FlowName'=>'xxx',
                    'Input'=>'{"execID": "exe1"}',
                ],
            ];

            $result2 = Fnf::v20190315()
                ->startExecution($options)
                ->options([
                    'form_params'=>[
                        'Input'=>'我会覆盖 options 中 Input 的这个参数值，格式需要为 json',
                    ],
                ])
                ->debug(false) // 最后调用的会覆盖前者
                ->request();

            // 查询执行结果
            $request3 = Fnf::v20190315()->getExecutionHistory();

            // 设置选项/参数并执行请求
            // 创建一个Flow
            $result3 = $request3->withFlowName('xxx') // API 的参数
            ->withExecutionName('xxx')
                ->debug(true) // 开启调试会输出详细信息
                ->connectTimeout(10) // 连接超时会抛出异常
                ->timeout(10) // 超时会抛出异常
                ->request(); // 执行请求

        } catch (ClientException $exception) {
            echo $exception->getMessage().PHP_EOL;
        } catch (ServerException $exception) {
            echo $exception->getMessage().PHP_EOL;
            echo $exception->getErrorCode().PHP_EOL;
            echo $exception->getRequestId().PHP_EOL;
            echo $exception->getErrorMessage().PHP_EOL;
        }
        $this->assertTrue(true);
    }
}