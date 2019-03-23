FROM futuretraveler/dockerhub-laravel-demo:latest

# Set the parameters of the database.
ARG DB_HOST
ARG MYSQL_DBUSER
ARG MYSQL_DATABASE
ARG MYSQL_ROOT_PASSWORD
ARG APP_PATH
ARG APP_ENV
ARG APP_DEBUG
ARG APP_KEY
ARG APP_URL

ENV DB_HOST ${DB_HOST}
ENV MYSQL_DBUSER ${MYSQL_DBUSER}
ENV MYSQL_DATABASE ${MYSQL_DATABASE}
ENV MYSQL_ROOT_PASSWORD ${MYSQL_ROOT_PASSWORD}
ENV APP_PATH=${APP_PATH}
ENV APP_ENV=${APP_ENV}
ENV APP_DEBUG=${APP_DEBUG}
ENV APP_KEY=${APP_KEY}
ENV APP_URL=${APP_URL}

# Set working directory
WORKDIR ${APP_PATH}

# Copy existing application directory contents
COPY application/. ${APP_PATH}
# Copy init shell script into container.
COPY init.sh /init.sh

# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm"]
