FROM php:7.4-apache

# ติดตั้ง dependency
RUN apt-get update && apt-get install -y \
    unzip \
    wget \
    git \
    zip \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libssl-dev \
    libaio1 \
    libaio-dev \
    libnsl-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    ca-certificates \                
    $PHPIZE_DEPS \
    && update-ca-certificates \      
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql zip intl gd \
    && docker-php-ext-enable mysqli intl gd

# Copy instantclient zips (อยู่โฟลเดอร์เดียวกับ Dockerfile)
COPY instantclient-basic-linux.x64-21.1.0.0.0.zip /opt/oracle/
COPY instantclient-sdk-linux.x64-21.1.0.0.0.zip /opt/oracle/

# แตกไฟล์ Instant Client
RUN cd /opt/oracle \
    && unzip instantclient-basic-linux.x64-21.1.0.0.0.zip \
    && unzip instantclient-sdk-linux.x64-21.1.0.0.0.zip \
    && rm *.zip \
    && ln -s /opt/oracle/instantclient_21_1 /opt/oracle/instantclient \
    && echo /opt/oracle/instantclient > /etc/ld.so.conf.d/oracle-instantclient.conf \
    && ldconfig

# (เพิ่ม) ตรวจสอบไฟล์ที่ต้องมีหลัง unzip — ถ้าไม่มีจะหยุดด้วยข้อความชัดเจน
RUN ls -lah /opt/oracle && ls -lah /opt/oracle/instantclient_21_1 || true \
    && test -f /opt/oracle/instantclient_21_1/sdk/include/oci.h || (echo "ERROR: missing oci.h (instantclient-sdk ไม่ถูก COPY/แตกไฟล์)"; exit 1)

# (เพิ่ม) ทำ symlink ให้ชื่อไฟล์ .so แบบไม่ติดเวอร์ชัน เผื่อขั้นตอนลิงก์ต้องการ
RUN ln -sf /opt/oracle/instantclient/libclntsh.so.21.1 /opt/oracle/instantclient/libclntsh.so \
    && ln -sf /opt/oracle/instantclient/libocci.so.21.1   /opt/oracle/instantclient/libocci.so

# ตั้งค่า env
ENV LD_LIBRARY_PATH=/opt/oracle/instantclient \
    OCI_LIB_DIR=/opt/oracle/instantclient \
    OCI_INC_DIR=/opt/oracle/instantclient/sdk/include \
    PHP_OCI8_IC_PREFIX=/opt/oracle/instantclient \
    OCI_HOME=/opt/oracle/instantclient \
    MAKEFLAGS="-j$(nproc)"          

# [ADD] ปรับ shell ให้ pipefail (ถ้า pecl fail จะล้มเลเยอร์ทันที ไม่กลบ error)
SHELL ["/bin/bash", "-o", "pipefail", "-c"]

# [ADD] เครื่องมือเสริมที่บางครั้ง pecl ใช้ตรวจ config
RUN apt-get update && apt-get install -y pkg-config

# ติดตั้ง oci8 โดย export ENV ให้เห็นในสเต็ปเดียว + มี fallback เวอร์ชัน
RUN export LD_LIBRARY_PATH=/opt/oracle/instantclient \
    && export OCI_LIB_DIR=/opt/oracle/instantclient \
    && export OCI_INC_DIR=/opt/oracle/instantclient/sdk/include \
    && export PHP_OCI8_IC_PREFIX=/opt/oracle/instantclient \
    && pecl channel-update pecl.php.net \
    && ( printf "instantclient,/opt/oracle/instantclient\n" | pecl install -n oci8-3.2.1 \
    || printf "instantclient,/opt/oracle/instantclient\n" | pecl install -n oci8-2.2.0 ) \
    && docker-php-ext-enable oci8 \
    && php -m | grep -i oci8           # [ADD] smoke test แสดงว่า enable แล้ว

# [ADD] แสดงไฟล์ .ini ที่ enable ไว้ (ช่วยดีบักเวลา container รันจริง)
RUN ls -lah /usr/local/etc/php/conf.d

# เปิด mod_rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html
