# Sistem Pengaduan Masyarakat

Platform digital untuk menyampaikan aspirasi masyarakat dengan pemerintah demi pembangunan yang lebih baik.

## 🚀 Tech Stack

- **Backend:** Laravel 10
- **Frontend:** Vue 3 + Vite
- **Database:** MySQL
- **Styling:** Tailwind CSS
- **Notifications:** Vue Toastification

## 📦 Features

- ✅ Submit complaint dengan foto
- ✅ Track complaint by ticket number
- ✅ Admin dashboard & management
- ✅ Status updates (pending, in_progress, resolved, rejected)
- ✅ Real-time resolved complaints page
- ✅ Search & filter functionality
- ✅ Responsive design

## 🛠️ Installation

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

### Setup Steps

1. Clone repository
git clone https://github.com/pahleviii/layanan-pengaduan-masyarakat.git
cd layanan-pengaduan-masyarakat
2. Install dependencies
composer install
npm install
3. Copy .env file
cp .env.example .en
4. Generate app key
php artisan key:generate
5. Configure database di `.env`
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
6. Run migration & seeder
php artisan migrate:fresh --seed
7. Create storage link
php artisan storage:link
8. Run development servers
Terminal 1 - Laravel
php artisan serve
Terminal 2 - Vite
npm run dev
9. Access application
- Frontend: http://127.0.0.1:8000
- Admin Login: http://127.0.0.1:8000/admin/login
  - Email: admin@example.com
  - Password: password

## 👨‍💻 Developer

Developed by Reza Pahlevi

## 📝 License

This project is open-sourced software.
