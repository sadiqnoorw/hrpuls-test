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
        git clone https://github.com/sadiqnoorw/innoscripta_aggregator_apis.git

        cd innoscripta_aggregator_apis
    ```

2. **Install Dependencies:**

```bash
    composer install
```
This will install the required dependencies.

3. **Set Up Environment Variables:**

- Copy .env.example to .env:

```bash
    cp .env.example .env
```

### Build and Run Docker Containers:

```bash
    ./vendor/bin/sail up
```


### Run Migrations:

```bash
    ./vendor/bin/sail php artisan migrate
```
***New you can access by*** http://localhost
