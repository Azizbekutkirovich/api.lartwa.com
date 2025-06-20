# LARTWA Backend - Login And Register With API

**LARTWA (Login And Register With API)** is a clean, lightweight, and secure RESTful API project created with **pure PHP** using **JWT (JSON Web Tokens)** for stateless authentication.

---

## 🔐 Features

- ✅ User registration with hashed passwords
- ✅ User login with JWT token generation
- ✅ Stateless REST API (no PHP sessions)
- ✅ JWT token validation for secure requests
- ✅ Modular and readable PHP code (no framework)
- ✅ PDO-based secure database interactions

---

## 📁 Project Structure

```
/api.lartwa.com
│
├── .htaccess              # htaccess settings
├── vendor/
│   ├── firebase/           
│   	 ├── php-jwt        # JWT library
│
├── composer.json          # composer file
├── composer.lock
├── db.php                 # PDO DB connection
├── functions.php          # All functions(Register, Login, Profile)
└── index.php              # Main API logic handling
```

---

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/Azizbekutkirovich/api.lartwa.com.git
```

### 2. Install dependencies

```bash
composer install
```

### 3. Configure environment

Create a `.env` file and fill in your credentials:

```bash
cp .env.example .env
```

Example `.env` file:

```env
DB_HOST=localhost
DB_NAME=lartwa.com
DB_USER=root
DB_PASS=your_password
JWT_SECRET=your_secret_key
```

### 4. Create the database

Run the following SQL in your MySQL database:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(100)
);
```

---

## 📡 API Endpoints

> All requests use `application/json` content type.

### 🔐 Register

**POST** `http://localhost/api.lartwa.com/register`

**Request body:**

```json
{
  "name": "your_name",
  "email": "your_email@example.com",
  "password": "your_password"
}
```

**Response:**

```json
{
  "status": true,
  "token": "your_token"
}
```

---

### 🔑 Login

**POST** `http://localhost/api.lartwa.com/login`

**Request body:**

```json
{
  "email": "your_email@example.com",
  "password": "your_password"
}
```

**Response:**

```json
{
  "status": true,
  "token": "your_token"
}
```

> Save the token and send it in the `Authorization` header for protected routes:
```
Authorization: Bearer <your_token>
```

---

## 🧰 Technologies Used

- PHP (Pure, no frameworks)
- MySQL (via PDO)
- Composer (dependency manager)
- JWT (firebase/php-jwt library)
- Dotenv for configuration

---

## 📦 Run Locally

You can run the server locally using PHP's built-in server:

```bash
php -S localhost:8000
```

Then visit: `http://localhost:8000/api.lartwa.com/index.php` or `funcions.php`

---

## 📝 License

This project is licensed under the MIT License.  
Feel free to use, modify, and share.

---

## 🙋‍♂️ Author

Created by [Azizbek](https://github.com/Azizbekutkirovich)  
Frontend repo: [LARTWA Frontend](https://github.com/Azizbekutkirovich/Lartwa.com)  
Backend repo: [api.lartwa.com](https://github.com/Azizbekutkirovich/api.lartwa.com)

---