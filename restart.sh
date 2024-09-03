#!/bin/bash

# Stop and remove containers
docker-compose down

# Remove the database volume
docker volume rm $(docker volume ls -qf dangling=true)

# Rebuild the containers
docker-compose up -d --build

sleep 7

php artisan migrate:fresh --seed

php artisan serve
