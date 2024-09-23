# resturant-bontemps
Welcome to Bon Temps restaurant, where operational ease is key for both employees and managers. My commitment to a seamless experience extends to our customer-friendly reservation system, ensuring your dining journey is always a pleasure.

# Run site locally:
**Prerequisites:**
- Apache
- MySql && phpMyAdmin
- Composer ^2.0
- PHP ^8.2
- NodeJs ^20.0

**1- Clone project:**

You can clone the repository using the Git command: `git clone https://github.com/executioner90/bontemps-restaurant.git`. Alternatively, download it as a ZIP file and extract it.

**2- install Dependencies:**

Open the terminal where you cloned the project and use the following commands:
- `cd bontemps-restaurant`
- `composer install`
- `npm install`

**3- Configuring Environmnet:**

- Copy the ".env.example" file to ".env" and update it with the required configurations, such as database credentials and the app key. You can use the following command: `cp .env.example .env`.
- Generate the application key using the following command: `php artisan key:generate`

**4- Database Migration and Seeding:**

- Run the database migrations to set up the database schema `php artisan migrate`
- Run seeders for initial data: `php artisan db:seed`

**5- Run the Application:**

Finally, to launch the development server, execute the command `php artisan serve`. In a new terminal tab, compile assets by running `npm run dev`.

©️ Your Bon Temps Restaurant site should now be accessible locally at 'http://localhost:8000' or another specified port. Enjoy exploring! ©️

©️ Copyright saved 2024 ©️
