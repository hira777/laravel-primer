# 作成するDockerイメージのベースとなるイメージ
FROM php:7.3-fpm-alpine

# イメージに追加するメタデータ
LABEL maintainer "soarflart"

# `DockerFile`内で利用できる変数。
# `Dockerfile`の build 時に一時的に変数が定義され、コマンドの実行時に展開される。
ARG TZ

# コンテナ内の環境変数
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

# コンテナ内で実行されるコマンド
# set -eux: https://qiita.com/m-yamashita/items/889c116b92dc0bf4ea7d#bash-%E3%81%AE%E3%82%AA%E3%83%97%E3%82%B7%E3%83%A7%E3%83%B3%E3%82%92%E6%B4%BB%E7%94%A8%E3%81%97%E3%82%88%E3%81%86
RUN set -eux && \
  apk add --update-cache --no-cache --virtual=.build-dependencies tzdata && \
  cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
  apk del .build-dependencies && \
  apk --no-cache add bash postgresql-dev && \
  docker-php-ext-install pdo pdo_pgsql && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo
