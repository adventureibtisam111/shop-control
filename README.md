# 📦 Shop-Control – Point of Sale & Inventory Management System

Shop-Control is a robust, role-based Point of Sale (POS) and inventory management system built with Laravel that helps retail businesses efficiently manage their stock, sales, and customer relations.


## 📋 What Shop-Control Does

It helps retail shops manage:

- 👨‍💼 Cashiers & Staff
- 📦 Products & Inventory
- 🗂️ Categories
- 🛒 Active Cart & Checkout
- 💰 Sales History
- 👥 Customers
- 📊 Real-Time Business Analytics

---

🚀 Features

- ✅ **Secure Authentication System** – Login, register, and logout with password security
- ✅ **Role-Based Dashboards** – Admin-ready dashboard system for different user roles (e.g., Cashier, Manager)
- ✅ **Dynamic POS Checkout** – Seamless cart system to add products, calculate totals, and process sales
- ✅ **Full CRUD Operations** – Complete Create, Read, Update, Delete for all store modules
- ✅ **Search & Filter Functionality** – Quick search across products and categorization by type
- ✅ **Modern UI** – Responsive Tailwind CSS / Bootstrap interface for a smooth checkout experience
- ✅ **Real-Time Statistics** – Dashboard with live retail metrics, sales count, and active products

---

📊 Dashboard Overview

Real-time overview of business statistics including:
- Total Products
- Categories Count
- Active Cart Items
- Sales Revenue Metrics
- Customer Database
  
---

🛠 Tech Stack

| Technology | Purpose |
| :--- | :--- |
| **Laravel** | Backend framework & routing |
| **SQLite** | Lightweight, high-performance local database |
| **Tailwind CSS / Bootstrap** | Responsive UI framework for retail workflows |
| **Blade Templates** | Dynamic template rendering for views |

---

🚀 Quick Start

Get shop-control running on your local machine:

```bash
# Clone the repository
git clone [https://github.com/adventureibtisam111/shop-control.git](https://github.com/adventureibtisam111/shop-control.git)
cd shop-control

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database (creates the SQLite file and runs tables)
touch database/database.sqlite
php artisan migrate --seed

# Start the development server
php artisan serve
```
---

## 📁 Project Structure

```
Plaintext
shop-control/
├── app/              # Application logic, Models, & Controllers
├── database/         # SQLite database, Migrations & Seeders
├── resources/        # Blade templates (Products, Cart, Sales) & assets
├── routes/           # Web and API routing endpoints
├── public/           # Public assets (Vite compiled CSS, JS, images)
└── config/           # System configuration files
```

## 💡 Why Shop-Control?

This project demonstrates essential full-stack Laravel development concepts applied to commercial retail systems:

- Authentication & Authorization – Secure login systems with role management for store staff.
- Database Design – Clean, lightweight SQLite integration with transactional relationships between products and sales.
- Real-World POS Logic – State management for shopping carts and generating sales logs.
- Clean Code Practices – Maintainable, professional architecture decoupling business logic.

## 📷 Screenshots

### 1️⃣ Dashboard View
<img width="1343" height="634" alt="image" src="https://github.com/user-attachments/assets/23002a0e-7377-4167-a17b-3cab33d1e81b" />


### 2️⃣ Products & Inventory Management
<img width="1338" height="646" alt="image" src="https://github.com/user-attachments/assets/d25430a8-b758-41de-b407-c93b3c369aee" />


### 3️⃣ Active POS Cart / Checkout Screen
<img width="1341" height="624" alt="image" src="https://github.com/user-attachments/assets/23c33c86-f272-43ac-bd85-677e103bac68" />


### 4️⃣ Sales History & Analytics
<img width="1351" height="632" alt="image" src="https://github.com/user-attachments/assets/6a29f0b3-d92d-4980-a7ec-898262c5402c" />

---

## 📌 Future Improvements

- 📈 **Advanced Analytics** – Detailed daily, weekly, and monthly profit margins
- 🔐 **Enhanced Role-Based Access** – Granular permissions for Cashiers vs. Store Owners
- 🧾 **Digital Receipt Generation** – Automated downloadable PDF invoices
- 🔌 **REST API Version** – RESTful API endpoints for external integrations
- 📱 **Mobile Companion App** – Native Flutter mobile app for scanning barcodes and viewing store analytics

---

## 📄 License

This project is open source under the MIT License. See LICENSE file for details.

---


## 🤝 Contributing

Found a bug? Have an improvement idea? We'd love your help!
- 🐛 Report Issues – Open an issue with detailed information
- 💡 Suggest Features – Share your ideas for improvements
- 🔧 Submit Pull Requests – Help improve the codebase
  
---


## ❤️ Support This Project

If shop-control helped you learn, build something cool, or you find it useful, please consider supporting my work:

- **[💰 Sponsor on GitHub](https://github.com/sponsors/adventureibtisam111)** – Get updates on my latest projects and help fund future development
- **⭐ Star this Repository** – Shows the project is helpful to others in the community
- **💬 Share Feedback** – Issues, suggestions, and pull requests are always welcome!
-  **📢 Share with Others** – Spread the word to developers who might benefit

Your support helps me create more educational projects like this one and maintain existing ones! 

---

## 👤 About

**Author:** Ibtisam Ali Abdi
**GitHub:** [@adventureibtisam111](https://github.com/adventureibtisam111)  
Location: Hargeisa, Somalia
Project Type: Learning & Portfolio

---

## 📞 Get in Touch

Have questions or want to collaborate? Feel free to:
- Open an issue on this repository
- Check out my other projects on GitHub
- Sponsor my work to stay updated on new projects

---

**Happy coding! 💻**
