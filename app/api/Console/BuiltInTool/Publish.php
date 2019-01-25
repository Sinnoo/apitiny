<?php

namespace Api\Console\BuiltInTool;

use Mx\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * 内建命令 Publish
 *
 * 将项目打包为一个zip包 用以进行远程部署
 * 可以扩展来适应项目特殊性需要
 *
 * @see CommandAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Publish extends CommandAbstract
{
    protected function configure()
    {
        $this->setName('publish')
            ->setDescription('发布准备')
            ->addOption(
                'target',
                'O',
                InputOption::VALUE_OPTIONAL,
                '输出的文件路径',
                'build/publish.zip'
            )->addOption(
                'env',
                'E',
                InputOption::VALUE_OPTIONAL,
                '切换发布运行环境  dev | test | prod'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $params = [];
        $params['env'] = $input->getOption('env');
        $params['target'] = $input->getOption('target');
        $this->callService('BuiltInTool\Publish', $params);

        $msg = "out " . $params['target'];
        $output->writeln("<info>$msg</info>");
    }
}
