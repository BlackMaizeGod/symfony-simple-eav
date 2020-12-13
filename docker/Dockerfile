ARG EXECUTION_ENVIRONMENT
FROM defaultvalue/php:7.3-${EXECUTION_ENVIRONMENT}

#Installing Symfony
USER docker
RUN curl -sS https://get.symfony.com/cli/installer | bash ;

USER root
RUN mv /home/docker/.symfony/bin/symfony /usr/local/bin/symfony ;
