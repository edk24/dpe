FROM edk24/docker-php:{%PHP_VERSION%}

# 配置文件
COPY docker/nginx/conf/ /etc/nginx/
COPY docker/php/conf/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY docker/php/conf/php.ini /usr/local/etc/php/php.ini

# 安装扩展
RUN docker-php-ext-install sockets && docker-php-ext-enable sockets

# 代码
COPY ./ /app

# 权限设置
RUN composer install && chown -R www-data:www-data /app && chmod -R 777 /app && chmod -R 775 /var/lib/nginx

# php think min -m all -r all