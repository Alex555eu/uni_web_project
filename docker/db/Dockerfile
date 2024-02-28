FROM postgres

ENV POSTGRES_PASSWORD docker
ENV POSTGRES_DB db 
ENV POSTGRES_USER docker

COPY . /app/database
COPY ./docker/db/myPublic.sql /docker-entrypoint-initdb.d/