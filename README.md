# Symfony ListingSite
Assignment for job interview:
Create a simple CRUD listing site using Symfony framework.
Dockerized.

Registered and signed in user can create and edit listing posts. Simple user is allowed to edit only his own listings. Admin can edit anything.

# Installation
1. composer install
2. php bin/console doctrine:migrations:diff
3. php bin/console doctrine:migrations:migrate

Run docker-compose build and docker-compose up -d if running on Docker.

symfony_dev.sql file added if needed.
