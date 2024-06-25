<?php

namespace Edk24\DockerPhpEnvironment\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Edk24\DockerPhpEnvironment\helper\File;

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

        $env = $io->choice('运行环境', ['production','development (use xdebug)']);

        $nginx_rule = $io->choice('请选择您使用的Nginx规则', ['default', 'thinkphp', 'laravel5']);
        

        $nginx_confirguration_map = [
            'default' => [
                'root' => '/app',
                'rewrite' => 'rewrite/custom.conf'
            ],
            'thinkphp' => [
                'root' => '/app/public',
                'rewrite' => 'rewrite/thinkphp.conf'
            ],
            'laravel5' => [
                'root' => '/app/public',
                'rewrite' => 'rewrite/laravel5.conf'
            ],
        ];
        $nginx_confirguration = $nginx_confirguration_map[$nginx_rule];

        // 执行文件的目录
        File::dirCopy(ROOT_PATH . "/templates/{$php_version}/", APP_PATH);

        // 替换镜像版本
        $version = $php_version;
        if ($env == 'development (use xdebug)') {
            $version = $php_version . '-dev';
        }
        $dockerfile_content = file_get_contents(APP_PATH . '/Dockerfile');
        $dockerfile_content = str_replace('{%PHP_VERSION%}', $version, $dockerfile_content);
        file_put_contents(APP_PATH . '/Dockerfile', $dockerfile_content);

        // 替换 nginx 配置重要参数
        $nginx_content = file_get_contents(APP_PATH . '/docker/nginx/conf/nginx.conf');
        $nginx_content = str_replace('{%ROOT%}', $nginx_confirguration['root'], $nginx_content);
        $nginx_content = str_replace('{%REWRITE%}', $nginx_confirguration['rewrite'], $nginx_content);
        file_put_contents(APP_PATH . '/docker/nginx/conf/nginx.conf', $nginx_content);
       

        // 输出提示
        $io->info('已经为您初始化完成，请执行 docker-compose up -d 启动服务');
        $io->info('或者执行 make up 启动服务');
        $io->info('默认端口为 3000, 在 docker-compose.yml 中修改');


        return Command::SUCCESS;
    }

}