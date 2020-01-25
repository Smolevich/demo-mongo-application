# demo-mongo-application

This repository was created for testing library https://github.com/jenssegers/laravel-mongodb
If you have to test something with library laravel-mongodb you can fork this repo (or mention me and i create branch)


- [Installing](#installing)
  - [Traefik](#traefik)

## Installing

Run `docker-compose up -d`

## Traefik

[Docs](https://docs.traefik.io/)

You can install traefik in separate docker container and add containers in docker-compose.yml to network which traefil uses(for example traefik_proxy)

Example of `docker-compose.yml` for traefik

```yml
version: '3.7'

services:
  traefik:
    container_name: traefik
    image: traefik:v2.0
    restart: always
    networks:
     - default
     - traefik_proxy
    command:
      - "--log.level=DEBUG"
      - "--providers.docker=true"
    volumes:
      - ./traefik.yml:/etc/traefik/traefik.yml
      - /var/run/docker.sock:/var/run/docker.sock
    ports:
      - "80:80"
      - "8080:8080"

networks:
  traefik_proxy:
    driver: bridge
    name: traefik_proxy

```
