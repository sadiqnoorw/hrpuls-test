## Backend Laravel Developer And News Aggregator API


### Scenario/Features:

- An HR software based on Laravel manages employee data such as name, telephone, email,
address and title (for some customers up to over 100,000 employees in some cases).

- At the customer's request, a new function is now to be implemented that allows changes to
be made on a specific date in the future
e.g. if it is clear that an employee will move to a new address on 1 March 2025, the new
address should be active in the system from that date.

- The software should be built as close as possible to the Laravel default, but still scalable and
with the most intuitive UX possible.


## Setup and Installation

### Installation Steps:
#### Docker Setup:

For a seamless local environment, a Docker configuration is provided. 

If you don't have Docker, you can set up the project manually using the following prerequisites.

#### Prerequisites:

 - PHP: >=8.2 - 8.4
 - Laravel Framework: >=11.31
 - Database: MySQL 8.0 (preferred) or SQLite

## Manual Setup Instructions

1. **Clone the Repository**

   Clone the repository to your local machine:

   ```bash
        git clone https://github.com/sadiqnoorw/hrpuls-test.git

        cd hrpuls-test
    ```

2. **Install Dependencies:**

```bash
    composer install
```
This will install the required dependencies.

3. **Set Up Environment Variables:**

- Copy the .env.example file and update the database configurations:

```bash
    cp .env.example .env
```

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
```

### Build and Run Docker Containers:

```bash
    ./vendor/bin/sail up
```


### Run Migrations and Seed:

```bash
    ./vendor/bin/sail php artisan migrate:refresh
```

```bash
    ./vendor/bin/sail php artisan db:seed --class=EmployeeSeeder
```
***New you can access by*** http://localhost

### Cronjob Task - Future Changes
    - Running the Cronjob Manually Through the Command Line
    Open your terminal and change to your project directory where your Laravel application is located like

```bash
cd /path/to/your/hrpuls-test
```

### Running a Specific Command:
If you want to run a specific scheduled command (such as the apply-future-changes command) manually, you can run it like this:

```bash
./vendor/bin/sail php artisan employee:apply-future-changes
```
