FROM php:8.2-apache

# ติดตั้ง extensions ที่จำเป็น
RUN docker-php-ext-install pdo pdo_mysql

# เปิดใช้งาน mod_rewrite สำหรับ URL Routing
RUN a2enmod rewrite

# คัดลอกไฟล์คอนฟิก Apache ก่อน
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# เปิดใช้งานคอนฟิกและรีสตาร์ท Apache
RUN a2ensite 000-default \
    && service apache2 restart

# ตั้งค่าตำแหน่งเริ่มต้นของเว็บแอป
WORKDIR /var/www/html

# คัดลอกไฟล์ทั้งหมดจากโปรเจกต์ไปยัง Container
COPY . /var/www/html

# ตั้งค่าสิทธิ์ให้ Apache อ่าน/เขียนไฟล์
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# เปิดพอร์ต 80
EXPOSE 80

RUN docker-php-ext-install mysqli pdo pdo_mysql
