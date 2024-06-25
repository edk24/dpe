# DPE 工具

一个为您的 php 项目集成 docker 的工具，具有 `生产环境` 和 `开发环境（含 xdebug）`。

干净无污染，集成后可以安全卸载此包；

缩写：DPE（`D`ocker `P`hp `E`nvironment）

- ✅ docker-compose
- ✅ k8s 可用

## 安装/卸载

```bash
# 安装
$ composer require edk24/dpe

# 卸载 (集成 docker 后这个包就没有用途了， 可以删掉哦)
$ composer remove edk24/dpe
```

## 使用

```bash
# 进入你的项目根目录执行
$ php vendor/bin/dpe init
请选择您使用的PHP版本:
  [0] 8.1
  [1] 7.4
  [2] 7.3
  [3] 7.1
 > 

 运行环境:
  [0] production
  [1] development (use xdebug)
 > 

 请选择您使用的Nginx规则:
  [0] default
  [1] thinkphp
  [2] laravel5
 > 

                                                                                                                        
 [INFO] 已经为您初始化完成，请执行 docker-compose up -d 启动服务                                                        
```

## K8s

- 使用 Dockerfile 打包镜像推送到私有仓库后，在 k8s 中拉取使用

## FAQ

```bash
# 选成运行环境了，但是需要用到线上环境使用。
编辑 Dockerfile 将 `edk24/docker-php:8.1-dev` 中的 `-dev` 去掉重写运行即可。（-dev 是开发环境，携带 xdebug 不要用在生产环境）
```

## 注意事项

此工具会拷贝下列文件到你的项目目录， 如果有重名文件，还请提前备份

- `makefile`
- `Dockerfile`
- `docker-compose.yml`
- `docker/`
