## Installation
To run this application locally using Laravel Sail, follow these steps:

### Prerequisites
- **Docker:** Ensure Docker is installed and running on your machine.

### Steps
1. **Clone the Repository**
2. **Set up Environment Variables**
3. **Install Composer Dependencies:** ```composer install```
4. **Start Docker Containers:** ```./vendor/bin/sail up``` (Ensure Docker is Running)
5. **Generate Application Key:** ```./vendor/bin/sail artisan key:generate```
6. **Run Database Migration and Seeder:** ```./vendor/bin/sail artisan migrate:fresh --seed```
7. **Create Storage Symlink:** ```./vendor/bin/sail artisan storage:link```
8. **Install NPM Dependencies:** ```./vendor/bin/sail npm install```
9. **Built Frontend Assets:** ```./vendor/bin/sail npm run-script build```
10. **Access the Application:** The web application should now be accessible at 127.0.0.1
