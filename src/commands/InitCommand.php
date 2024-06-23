<?php

namespace Yuxiaobo\DockerPhpEnvironment\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

class InitCommand extends Command
{

    public function configure()
    {
        $this->setName('init'); 
        $this->setDescription('初始化 Docker PHP 环境'); 
    }

    public function execute(InputInterface $input, OutputInterface $output):int
    {
        $io = new SymfonyStyle($input, $output);

        $php_version = $io->choice('请选择您使用的PHP版本', ['8.1', '7.4', '7.3', '7.1']);

        $nginx_rule = $io->choice('请选择您使用的Nginx规则', ['default', 'yii2', 'ci', 'laravel5']);
        




        return Command::SUCCESS;
    }

}