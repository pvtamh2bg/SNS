##
FROM centos:7

##
MAINTAINER tampv@tmh-techlab.vn

## Centos base
RUN (cd /lib/systemd/system/sysinit.target.wants/; for i in *; do [ $i == \
systemd-tmpfiles-setup.service ] || rm -f $i; done); \
rm -f /lib/systemd/system/multi-user.target.wants/*;\
rm -f /etc/systemd/system/*.wants/*;\
rm -f /lib/systemd/system/local-fs.target.wants/*; \
rm -f /lib/systemd/system/sockets.target.wants/*udev*; \
rm -f /lib/systemd/system/sockets.target.wants/*initctl*; \
rm -f /lib/systemd/system/basic.target.wants/*;\
rm -f /lib/systemd/system/anaconda.target.wants/*;

# yum updates
RUN yum -y update &&  yum -y clean all

# timezone and locale
RUN yum -y reinstall glibc-common &&  yum -y clean all
RUN rm -f /etc/localtime
RUN ln -fs /usr/share/zoneinfo/UTC /etc/localtime

# basic utilities
RUN yum -y install git zip wget unzip vim sudo && yum -y clean all

# PHP 7.0 rpm
RUN yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

# HTTPD
RUN yum -y install httpd httpd-devel mod_ssl

## SSL Config
#RUN certbot --apache -d laravellocal.com -d www.example.com

# mysql client
RUN yum -y localinstall http://dev.mysql.com/get/mysql80-community-release-el7-3.noarch.rpm && \
    yum -y install mysql-community-client && \
    yum -y clean all && \
	mkdir /root/bin

# PHP
RUN yum -y --enablerepo=remi-php73,epel,remi install php php-zip php-xml php-mysql php-mbstring php-pear php-opcache php-cli php-mcrypt php-intl \
    php-mysqlnd php-pdo php-pecl-xdebug php-pecl-imagick php-fpm php-pecl-apcu php-pecl-redis php-gd \
    && yum -y clean all

# Composer
RUN wget https://getcomposer.org/composer.phar && \
    chmod +x composer.phar && \
    mv composer.phar /usr/bin/composer


# update glibc
RUN yum -y update glibc && yum -y clean all

## COMMON Configuration
RUN chmod ugo+w /var/lib
RUN mkdir /var/tmp/logs
RUN chmod -R 777 /var/tmp
COPY files/etc/httpd/conf/httpd.conf /etc/httpd/conf/

RUN systemctl enable httpd.service

EXPOSE 80

VOLUME [ "/sys/fs/cgroup", "/run", "/tmp" ]

CMD ["/usr/sbin/init"]
