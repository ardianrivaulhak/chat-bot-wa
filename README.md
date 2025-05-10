### 🐳 SETUP DOCKER (Laravel)

This project uses Docker to run Laravel in a consistent environment without needing to install PHP, Composer, or MySQL locally.

### 📁 Project Structure
Make sure your project is structured like this:

```
project-root/
├── src/               # Laravel application lives here
├── docker-compose.yml
├── Dockerfile
```

### ⚙️ 1. Build & Run the Containers
```
docker-compose up -d --build
```
This will:

- Build the Laravel and MySQL images

- Start the containers (app for Laravel, db for MySQL) in the background

### 🐚 2. Access the Laravel Container
```
docker exec -it laravel_app_dev bash
composer create-project laravel/laravel .
```

### 🔑 3. Generate Laravel APP_KEY

Inside the container, run:
```
php artisan key:generate
```

### 🛠 4. Run Migrations
```
php artisan migrate
```

### 🌐 5. Access the App in Browser

Open your browser and visit:
```
http://localhost:8000
```

### (icon) 6. Setup OpenAI GPT 

```
composer require openai-php/laravel
```