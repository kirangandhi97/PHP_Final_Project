<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>




---

# 🍽️ Restaurant E-commerce System

The **Restaurant E-commerce System** is a web-based platform that streamlines online food ordering and management for restaurants. It enables customers to browse restaurant menus, place orders, and make payments, while restaurant owners can manage their menus and orders efficiently. Admins oversee the entire system, including user and restaurant management.

---

## 📌 Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [System Architecture](#system-architecture)
- [Technologies Used](#technologies-used)
- [Installation & Deployment](#installation--deployment)
- [User Roles & Manuals](#user-roles--manuals)
- [Screenshots](#screenshots)
- [License](#license)

---

## 📖 Project Overview

This platform provides a centralized system for customers, restaurant owners, and administrators to interact seamlessly through a responsive web application.

### 🎯 Objectives

- Enable online food ordering and secure payments
- Help restaurants manage their menus and orders
- Provide admins tools to monitor system activity and manage users

---

## 🚀 Features

### 🔐 Authentication & User Management
- Role-based access: **Admin**, **Restaurant Owner**, **Customer**
- Secure login & registration
- Password reset and profile management

### 🍽️ Restaurant Listing & Menu Management
- Create and manage restaurant profiles
- Add, edit, or remove food items from menus
- Upload item images, descriptions, and pricing

### 📦 Order Management
- Real-time order placement and tracking
- Delivery and pickup scheduling
- Order history for users and restaurants

### 🛒 Cart & Checkout System
- Add items to cart
- Apply promo codes or coupons
- Checkout with selected payment options

### 💳 Payment Integration
- Supports Stripe, PayPal, Razorpay (configurable)
- Secure and encrypted transaction processing

### 🌟 Reviews & Ratings
- Customers can review restaurants and menu items
- Star ratings and comments

### 📊 Admin Panel
- Manage users, restaurants, orders, and reviews
- Generate sales and performance reports
- View real-time analytics and dashboards

---

## 🏗️ System Architecture

- **MVC Pattern**: Clear separation of logic, UI, and data
- **Database**: Relational schema with normalized tables
- **Frontend**: Blade templating engine, responsive design
- **Backend**: Laravel (or your selected framework)

### 📌 Key Components
- `Models/`: Restaurant, Menu, Order, User, Review
- `Controllers/`: Handles business logic per module
- `Views/`: Blade templates for UI rendering
- `Routes/`: Defines web and API endpoints

---

## 🛠️ Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap, Blade
- **Backend**: PHP (Laravel Framework)
- **Database**: MySQL / PostgreSQL
- **Payments**: Stripe, PayPal, Razorpay
- **APIs**: RESTful services

---

## ⚙️ Installation & Deployment

### 🖥️ Local Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/restaurant-ecommerce.git
   cd restaurant-ecommerce
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Set environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure database and run migrations:
   ```bash
   php artisan migrate --seed
   ```
5. Serve the application:
   ```bash
   php artisan serve
   ```


## Project Structure

The application follows the standard Laravel directory structure with a few additional custom components:

- `app/Models`: Database models (User, About, Carts, Charges, Banners, etc.)
- `app/Http/Controllers`: Controllers organized by functionality
- `app/Http/Middleware`: Custom middleware including AuthLogging
- `app/Services`: Service classes including LoggingService
- `app/Mail`: Email classes for different notifications
- `database/migrations`: Database structure definitions
- `database/seeders`: Seed data for testing and development
- `resources/views`: Blade templates organized by feature
- `routes/web.php`: Web routes with role-based access control
- `tests/`: Unit and Feature tests


**Configure database in .env file**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=rms2
   DB_USERNAME=root
   DB_PASSWORD=
   ```


## Testing

The application includes comprehensive tests to ensure functionality and reliability:

- **Unit Tests**: Verify model relationships and core functionality
- **Feature Tests**: Test end-to-end workflows and user interactions

To run the tests:
```bash
php artisan test
```

### Test Coverage
- Authentication flows
- Event management
- Booking processes
- Payment handling
- Access control

## Deployment

### Server Requirements
- PHP = 7 | 8
- MySQL >= 5.7
- Composer
- Node.js & NPM
- Tailwindcss



## 👥 User Roles & Manuals

### Admin
- Manage users, restaurants, orders, reviews
- View reports and system analytics

### Restaurant Owner
- Update restaurant profile and menu
- Track and manage incoming orders

### Customer
- Browse menus, place orders, make payments
- Submit reviews and rate restaurants

> 📘 Refer to the full **User Manual** for step-by-step instructions.

---


## 🤝 Contributers

- Aleem Amirali Wadhwaniya
- Kiran Gandhi
- Jaspreet Sonia
- Kushal Chhetri 
