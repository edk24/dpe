<?php

namespace Yuxiaobo\DockerPhpEnvironment\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

class WelcomeCommand extends Command
{


    public function configure()
    {
        $this->setName('welcome');
        $this->setDescription('欢迎输出');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        $io->title('docker-php-environment');
        $io->text([
            '欢迎使用 docker-php-environment，一个快速为您现有项目添加 docker 环境的工具',
        ]);

        $io->section('为项目添加 Docker 环境');
        $io->listing([
            '1. 执行 php vendor/bin/dpe:init 开始引导',
        ]);

        
        // $io->choice('Select the queue to analyze', ['queue1', 'queue2', 'queue3'], multiSelect: true);
        return Command::SUCCESS;
    }
}
