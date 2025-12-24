# Feeds and Speeds Calculator

This is a web-based application designed to help machinists and CNC programmers determine the optimal spindle speed (RPM) and feed rate for their cutting operations. The application supports both Imperial and Metric units.

## Features

-   Calculate Spindle Speed (RPM)
-   Calculate Feed Rate (IPM or mm/min)

## Installation

1. **Clone the repository:**
    ```bash
    git clone <repository-url>
    ```
2. **Navigate to the project directory:**
    ```bash
    cd feeds-and-speeds-calculator
    ```
3. **Install dependencies:**
    ```bash
    composer install
    ```
4. **Create a copy of the `.env.example` file:**
    ```bash
    cp .env.example .env
    ```
5. **Generate an application key:**
    ```bash
    php artisan key:generate
    ```
6. **Run the database migrations:**
    ```bash
    php artisan migrate
    ```
7. **Start the development server:**
    ```bash
    php artisan serve
    ```
8. Open your browser and navigate to `http://127.0.0.1:8000/calculator`.

## Deployment with Ansible

This project can be deployed using Ansible. A playbook `deploy-laravel.yml` and an Nginx configuration template `nginx.conf.j2` are provided to automate the deployment process.

### Prerequisites

*   Ansible installed on your control machine.
*   SSH access to your target server(s) with `sudo` privileges.

### Setup

1.  **Review and Update Placeholders**:
    *   Open `deploy-laravel.yml` and update the following variables:
        *   `hosts`: Replace `your_target_servers` with your target host group or server IP.
        *   `repo_url`: Replace with your actual Git repository URL.
        *   `repo_branch`: Set to your desired branch (e.g., `main`, `master`, `develop`).
        *   `php_version`: Adjust if your PHP version is different (e.g., `8.1`, `8.3`).
        *   Database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`): **Replace `your_actual_value` with your actual database credentials.** For production environments, it is highly recommended to use [Ansible Vault](https://docs.ansible.com/ansible/latest/user_guide/vault.html) for sensitive information.
    *   Open `nginx.conf.j2` and replace `your_domain.com` with your actual domain name or server IP.

2.  **Create an Inventory File** (e.g., `inventory.ini`):
    Create an inventory file to define your target servers.

    ```ini
    [your_target_servers]
    your_server_ip_or_hostname ansible_user=your_ssh_user ansible_ssh_private_key_file=/path/to/your/ssh/key
    ```
    Replace `your_server_ip_or_hostname`, `your_ssh_user`, and `/path/to/your/ssh/key` with your actual details.

### Running the Playbook

Execute the playbook from your terminal:

```bash
ansible-playbook -i inventory.ini deploy-laravel.yml
```

This playbook will perform the following actions on your target server(s):
*   Update apt cache and install necessary system packages (git, nginx, php-fpm, and common PHP extensions).
*   Install Composer and Node.js/npm.
*   Clone the application repository into `/var/www/feeds-and-speeds-calculator`.
*   Configure the Laravel environment (`.env` file and application key generation).
*   Set appropriate permissions for Laravel's `storage` and `bootstrap/cache` directories.
*   Install PHP dependencies using Composer.
*   Run database migrations.
*   Install Node.js dependencies and build front-end assets using npm.
*   Configure Nginx with a site-specific configuration for your Laravel application.
*   Enable the Nginx site and remove the default Nginx site.
*   Reload Nginx and restart PHP-FPM services.

## Technical Details

The application is built using Laravel, a PHP web application framework that emphasizes simplicity, elegance, and clean coding. The front-end is implemented using plain HTML, CSS, and JavaScript, with some additional libraries such as jQuery for enhanced functionality.

For the development environment, the project uses PHP 8.x as the server-side language, MySQL as the database management system, and Nginx as the web server. The application also utilizes a build tool called Laravel Mix for asset compilation during development and production.

In terms of routing, the application follows standard RESTful conventions. For example, to access the calculator, navigate to `http://127.0.0.1:8000/calculator`.

## Contribution

Contributions are always welcome! If you'd like to contribute, please fork the repository and submit a pull request with your changes. Before submitting, please ensure that your code adheres to the PSR-2 coding standards and follows Laravel's conventions.

## License

This project is open-source and released under the MIT License. For more information, see the `LICENSE` file in this repository.

## Contact

If you encounter any issues or have questions, feel free to reach out via email at [your.email@example.com](mailto:your.email@example.com). I'll do my best to help!