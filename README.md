# Comtelindo Project - Customer Area & Location System

A customer address registration and Wi-Fi service coverage mapping system for PT. Comtelindo. This application allows prospective customers to enter their address details and check—via digital map integration—whether their residential area is within the coverage of PT. Comtelindo's Wi-Fi network.

---

## 🚀 Key Features

* **Customer Address Registration:** A detailed form for entering the data and address of a prospective customer.
* **Interactive Map Integration:** Mapping of locations using map coordinates (Maps API).
* **Coverage Check:** Automatically verifies whether a prospective customer's location falls within Comtelindo's Wi-Fi service radius or coverage area.
* **Admin Dashboard:** A management panel for prospective customer data, coordinates, and service coverage zones.

---

## 🛠️ Tech Stack

* **Framework:** Laravel
* **Database:** MySQL
* **Frontend:** Blade Templating / Bootstrap / Tailwind CSS / Flowbite
* **Map Service:** Leaflet.js 
* **Auto mail Service:** Mailer

---

## 📋 Prerequisites

Before run this project, you need to makesure that you have installed:
* PHP >= 8.1
* Composer
* MySQL Database
* Node.js & NPM

---

## ⚙️ Installation & Setup

1. **Cloning Repo**
   ```bash
   git clone [https://github.com/username/comtelindo-project.git](https://github.com/username/comtelindo-project.git)
   cd comtelindo-project
   Instal Depedencies PHP & JavaScript
   ```
2. **Install composer and npm**
    ```bash
    composer install
    npm install
    ```
3. **Environtment Configuration**
Copy .env.example to .env:

    ```Bash
    cp .env.example .env
    Setting the configuration in .env, some feature need api and database setup
    ```

3. **Database configuration**
     ```
    Bash
    php artisan key:generate
    Jalankan Migrasi & Database Seeder
    php artisan migrate --seed
4. **Run the App**

    ```Bash
    php artisan serve
    npm run dev

## notes
I forgot how to setup some feature like email automatic sender & map configuration. if you want to try this feature, you can explore the project by your selff. sorry🚩🙇
