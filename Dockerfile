FROM phpmentors/symfony-app:php55
MAINTAINER Fabian Sabau <fabian.sabau@socialbit.de>
EXPOSE 80

WORKDIR /var/app
ADD . /var/app

ENV APP_INIT_SCRIPT .docker/init.sh

#added configuration file to pass environment variables
ADD .docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get install -y php5-mongo

