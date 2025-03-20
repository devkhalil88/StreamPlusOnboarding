# StreamPlus Onboarding System

This project is a **multi-step user onboarding form** built with **Symfony** for a subscription-based streaming service called **StreamPlus**. 
Users can sign up for a **Free** or **Premium** subscription, entering **personal details, address information, and payment details** if applicable.

## Features
✅ Multi-step form navigation (User Info → Address → Payment → Confirmation)  
✅ Dynamic step flow (Skip payment if "Free" subscription selected)  
✅ Form validation with Symfony Validator  
✅ Bootstrap 5 for UI styling  
✅ Data persistence using MySQL with Doctrine ORM  
✅ Session-based form data storage  
✅ Secure data handling (e.g., obfuscating credit card numbers)  

## Installation

### 2️⃣ Install Dependencies
```sh
composer install
```

### 3️⃣ Configure Environment Variables
Copy `.env.example` to `.env` and update the database credentials:
```sh
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/streamplus_onboarding?serverVersion=8.0"
```

### 4️⃣ Create Database & Run Migrations
```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5️⃣ Run Symfony Server
```sh
symfony server:start
```
or
```sh
php -S 127.0.0.1:8000 -t public
```

## Usage

### 📝 Step 1: User Information
- Name, Email, Phone Number, Subscription Type (Free/Premium)
- If "Free" is selected, skips payment step.

### 📍 Step 2: Address Information
- Address, City, State, Postal Code, Country

### 💳 Step 3: Payment (Only for Premium)
- Credit Card Number, Expiration Date, CVV

### ✅ Step 4: Confirmation
- Summary of user details (hides part of CC number for security)
- "Submit" button to finalize registration

## Database Schema
The `users` table structure:
```sql
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL,
    subscription_type ENUM('free', 'premium') NOT NULL DEFAULT 'free',
    address_line1 VARCHAR(255),
    address_line2 VARCHAR(255),
    city VARCHAR(100),
    postal_code VARCHAR(20),
    state VARCHAR(100),
    country VARCHAR(100),
    credit_card_number VARCHAR(16),
    expiration_date VARCHAR(7),
    cvv VARCHAR(3),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

  ```

## Technologies Used
- **Symfony 6** (Form handling, Doctrine ORM, Validation)
- **MySQL** (Data storage)
- **Bootstrap 5** (UI Styling)
- **Twig** (Templating)
- **PHP 8.2+**

## Author
📧 Email: eng.mo7ammad88@gmail.com
