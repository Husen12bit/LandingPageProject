FROM php:8.5-fpm

# ── System dependencies ──────────────────────────────────────────
RUN apt-get update && apt-get install -y \
    git curl unzip zip wget \
    libzip-dev libpng-dev libonig-dev libxml2-dev \
    libaio1t64 \
    && if [ -e /usr/lib/aarch64-linux-gnu/libaio.so.1t64 ] && [ ! -e /usr/lib/aarch64-linux-gnu/libaio.so.1 ]; then ln -s /usr/lib/aarch64-linux-gnu/libaio.so.1t64 /usr/lib/aarch64-linux-gnu/libaio.so.1; fi \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ── Oracle Instant Client ARM64 ──────────────────────────────────
ENV ORACLE_HOME=/opt/oracle/instantclient_19_22
ENV LD_LIBRARY_PATH=/opt/oracle/instantclient_19_22

RUN mkdir -p /opt/oracle && \
    wget -q https://github.com/yalelibrary/instantclient-binaries/raw/main/instantclient-basiclite-linux.arm64-19.22.0.0.0dbru.zip -O /tmp/ic-basic.zip && \
    wget -q https://github.com/yalelibrary/instantclient-binaries/raw/main/instantclient-sdk-linux.arm64-19.22.0.0.0dbru.zip -O /tmp/ic-sdk.zip && \
    unzip -oq /tmp/ic-basic.zip -d /opt/oracle && \
    unzip -oq /tmp/ic-sdk.zip -d /opt/oracle && \
    rm /tmp/ic-basic.zip /tmp/ic-sdk.zip && \
    echo /opt/oracle/instantclient_19_22 > /etc/ld.so.conf.d/oracle.conf && \
    ldconfig

# ── PHP Extensions ────────────────────────────────────────────────
RUN echo "instantclient,/opt/oracle/instantclient_19_22" | pecl install oci8-3.4.0 && \
    docker-php-ext-enable oci8 && \
    docker-php-ext-install mbstring bcmath exif pcntl gd zip

# ── Composer ─────────────────────────────────────────────────────
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/php/conf.d/performance.ini /usr/local/etc/php/conf.d/99-performance.ini
COPY docker/php-fpm/zz-www.conf /usr/local/etc/php-fpm.d/zz-www.conf

WORKDIR /var/www/html