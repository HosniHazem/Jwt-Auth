# Laravel JWT Authentication API

A Laravel API handling authentication and user management with JSON Web
Tokens, alongside a role and permission layer.

## What it does

- Register, login, logout and token refresh via JWT
- Password reset and email verification flows
- Roles and permissions, with per-role middleware (`AdminMiddleware`,
  `AgentMiddleware`, `ClientMiddleware`)
- Profile management
- Sanctum available in parallel as a second auth path
- Broadcast events over Pusher

## Stack

Laravel · PHP · `tymon/jwt-auth` · Laravel Sanctum · Pusher · MySQL

## Running locally

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan serve
```

Database credentials, and Pusher keys if you want broadcasting, go in `.env`.
Never commit that file — `.env.example` holds the blank template.
