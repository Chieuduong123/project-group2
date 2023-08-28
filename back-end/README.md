# PROJECT-JUONG-JOB

## Requirements

-   PHP 8.2.0
-   Laravel 10.0
-   Xampp v8
-   SQL phpMyAdmin

## Installation

### Clone

-   Clone this repo to your local machine using:

```bash
git clone git@github.com:
```

### Setup

-   Go into the directory you cloned about:

-   Start xampp

-   Open phpMyAdmin

```bash
create database project
```

-   Create .env file

```bash
cp .env.example .env
file .env database_name = project
```

-   Update composer

```bash
composer update
```

-   Generate key

```bash
php artisan key:generate
```

-   Install passport

```bash
composer require laravel/passport
```

-   Migrate

```bash
php artisan migrate:refresh --seed
```

-   Setting personal passport

```bash
php artisan passport:client --personal
```

-   Run serve

```bash
php artisan serve
```

## Usage

-   Run api is test

```bash
https://127.0.0.1:8000/api/
```

## ADMIN

-   login

```
https://127.0.0.1:8000/api/admin
```

-   email|password

```
admin@admin.com | password
```

## GET - POST API

## USER-NOT-LOGIN

-   searh/

```
get/ position|level|location  (-in-param-)
```

-   job/

```
get/
```

-   job/{id}

```
get/ -get-detail-job-
```

-   business/

```
get/
```

-   business/{id}

```
get/ -get-detail-job-
```

## SEEKER-AUTHENTICATION

-   seeker/register

```
post/ name|email|password|phone
```

-   seeker/login

```
post/ email|password
```

## BUSINESS-AUTHENTICATION

-   business/register

```
post/ name|email|password|phone
```

-   business/login

```
post/ email|password
```

## SEEKER-LOGINED (Seeker đã login)

-   seeker/logout

```
post/
```

-   seeker/profile

```
get/
```

```
post/ ... -edit-profile-
```

-   seeker/favorites

```
get/
```

-   seeker/favorites/{job}

```
put/  -add-favorite-
```

-   seeker/favorites/{job}

```
delete/  -remove-favorite-
```

-   seeker/job/{job}/apply

```
post/
```

## BUSINESS-LOGINED (Business đã login)

-   business/logout

```
post/
```

-   business/profile

```
get/
```

```
post/  -edit-profile-
```

-   business/job

```
get/
```

-   business/job/{job}

```
get/
```

-   business/job

```
post/ position|level[]|type[]|skill[]|salary|content|requirement|quantity|benefit|start_day|end_day
```

-   business/job/{job}

```
post/  -edit-job-post-
```

-   business/job/{job}

```
delete/  -delete-job-post-
```
