FROM  php:7.0-fpm

#RUN apt-get update &&  apt-get install -y \
#    php-amqplib \

# install curl and php
RUN apt-get update -y
RUN apt-get install curl git zip -y

# call PHP images script `docker-php-ext-install` and install language extensions
RUN docker-php-ext-install pdo pdo_mysql

# install composer & app deps; then remove
#RUN curl -sS https://getcomposer.org/installer | php
#RUN mv composer.phar /usr/local/bin/composer

RUN echo 'deb http://www.rabbitmq.com/debian/ testing main' | tee /etc/apt/sources.list.d/rabbitmq.list

RUN curl https://www.rabbitmq.com/rabbitmq-release-signing-key.asc | apt-key add -

#RUN apt-get update &&  apt-get install -y \
#    rabbitmq-server \

RUN apt-get update && apt-get install -y \
    rabbitmq-server

RUN rabbitmq-plugins enable rabbitmq_management
