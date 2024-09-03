# Task Manager

A simple task management application built with Laravel 9.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Features](#features)
- [Usage](#usage)
- [License](#license)

## Requirements

- PHP >= 8.0
- Composer
- MySQL or MariaDB
- Node.js & npm (for Laravel Mix)
- MAMP or XAMPP (optional for local development)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/sachinkt1/to-do.git
   cd to-do
   ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    ```

## Configuration

- Create a .env file
    - Copy the example environment configuration:
    ```bash
    cp .env.example .env
    ```

- Update the .env file

- **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

## Database Setup

- Run the database migrations:
    ```bash
    php artisan migrate
    ```

## Running the Application

- Compile the assets:
    ```bash
    npm run dev
    ```

- Start the local development server:
    ```bash
    php artisan serve
    ```

*Open your web browser and navigate to http://127.0.0.1:8000.*