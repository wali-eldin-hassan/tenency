# Multi-Tenancy E-commerce Platform with Tenant-Specific Dashboards

> Project Overview:

This Laravel-based project is a robust multi-tenancy e-commerce platform designed to provide seamless management of products, users, and categories for individual tenants. Each tenant has its own dedicated dashboard and sub domain, offering complete control over their respective product catalog, user base, and category structures.

## Key Features

1. **Multi-Tenancy:** Utilizes the Tenancy for Laravel package to ensure data isolation with single database .

2. **Authentication:** Users log in with their credentials, and upon successful authentication, they are directed to their personalized dashboard with subdomain.

3. **Dashboard Functionality:** Tenants can seamlessly manage their product listings, user accounts, and category structures through an intuitive dashboard.

4. **Website for Tenants:** Tenants have website template to showcase their products. Users can access the website, view products, and place orders directly.
   
5. **Model Relationships:** Establishes relationships and scopes within models to facilitate efficient data retrieval and management for each tenant.
   
6. **Controllers:** Implements controllers for products, users, and categories, ensuring data retrieval and manipulation are specific to the authenticated tenant.

7. **Important Notes:**
  - If using Valet or Herd, update the `APP_DOMAIN` in the `.env` file to `windstore.test`.
  - If You Use Another Url Name (localhost..etc), make sure to  update the `APP_DOMAIN` in env to `localhost`.
  - And modify the central domain in the tenancy config file to `localhost` .

## Usage

1. **Authentication:** Users log in with their credentials, and upon successful authentication, they are directed to their personalized dashboard.

2. **Dashboard Functionality:** Tenants can seamlessly manage their product listings, user accounts, and category structures through an intuitive dashboard.

3. **Website for Tenants:** Tenants have a website template to showcase their products. Users can access the website, view products, and place orders directly.


## Setup and Configuration

Assuming you've already installed on your machine: PHP (>= 7.0.0), [Laravel](https://laravel.com), [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org).

``` bash
# install dependencies
composer install
npm install

# create .env file and generate the application key
cp .env.example .env
php artisan key:generate

# build CSS and JS assets
 npm run dev 

```

Then launch the server:

``` bash
php artisan serve
```

