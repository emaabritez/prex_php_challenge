# GIF Search API Challenge

## Overview

This project is a REST API built with Laravel 12 and PHP 8.4 that
integrates with the Giphy API to search GIFs and manage user favorites.

The API implements OAuth2 authentication using Laravel Passport and runs
in a Dockerized environment.

Main features: - OAuth2 authentication - GIF search using the Giphy
API - Save and manage favorite GIFs - API request logging middleware -
Response transformation - Caching layer for external API calls -
Dockerized development environment

------------------------------------------------------------------------

# Tech Stack

-   PHP 8.4
-   Laravel 12
-   MySQL
-   Docker
-   Laravel Passport (OAuth2)
-   Giphy API

------------------------------------------------------------------------

# Project Setup

Clone the repository:

git clone https://github.com/emaabritez/prex_php_challenge.git 

cd prex_php_challenge

cd prex_php_challenge

Start Docker containers:

docker compose up -d

Install dependencies:

docker exec -it laravel_app composer install

Run database migrations:

docker exec -it laravel_app php artisan migrate

Create the Passport personal access client:

docker exec -it laravel_app php artisan passport:client --personal

Seed the database:

docker exec -it laravel_app php artisan db:seed

The API will be available at:

http://localhost:8000

------------------------------------------------------------------------

# Environment Variables

Example `.env` configuration:

APP_NAME=GifApi
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=db DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

GIPHY_API_KEY=your_giphy_api_key
GIPHY_URL=https://api.giphy.com/v1

------------------------------------------------------------------------

# Test User

A test user is automatically created with the database seed:

email: test@test.com password: password

------------------------------------------------------------------------

# Authentication

Login endpoint:

POST /api/login

Example request:

{ "email": "test@test.com", "password": "password" }

Example response:

{ "token": "ACCESS_TOKEN", "expires_in": 1800 }

Use the token in authenticated requests:

Authorization: Bearer ACCESS_TOKEN

------------------------------------------------------------------------

# API Endpoints

## Public

### Health Check

GET /api/health

Response:

{ "status": "ok" }

------------------------------------------------------------------------

## Authenticated Endpoints

### Get authenticated user

GET /api/me

------------------------------------------------------------------------

### Search GIFs

GET /api/gifs/search?query=cat

------------------------------------------------------------------------

### Get GIF by ID

GET /api/gifs/{id}

------------------------------------------------------------------------

### Favorites

Save favorite:

POST /api/favorites

Example body:

{ "gif_id": "abc123", "title": "Funny Cat", "url":
"https://giphy.com/gifs/abc123" }

List favorites:

GET /api/favorites

Delete favorite:

DELETE /api/favorites/{id}

------------------------------------------------------------------------

# Architecture

The application follows a layered architecture:

Controllers ↓ Services ↓ Models ↓ Database

Key components:

-   GiphyService → Handles communication with the Giphy API
-   FavoriteService → Business logic for managing favorites
-   LogApiRequests Middleware → Logs API requests
-   StoreFavoriteRequest → Request validation

------------------------------------------------------------------------

# Caching

Search requests to the Giphy API are cached for 5 minutes to reduce
external API calls and improve performance.

------------------------------------------------------------------------

# Logging

All authenticated API requests are logged with:

-   user_id
-   endpoint
-   HTTP method
-   request duration

Logs are stored at:

storage/logs/laravel.log

------------------------------------------------------------------------

# Docker

The project runs in Docker using: - PHP container - MySQL container -
Nginx container

Start services with:

docker compose up -d

------------------------------------------------------------------------

# Running Tests

Run the automated tests:

php artisan test

------------------------------------------------------------------------

# Diagrams

The repository includes UML diagrams: - Use Case Diagram - Sequence
Diagram - Entity Relationship Diagram

Located in:

/docs/diagrams

------------------------------------------------------------------------

# Health Check

GET /api/health

Response:

{ "status": "ok" }
