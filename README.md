# Cobra 

Cobra is a PHP-based debt collection and account management system. It provides tools for managing agents, clients, payments, reports, and more, with a focus on administrative workflows and productivity tracking.

## Features
- User authentication and session management
- Agent and client management
- Payment and account status tracking
- Bulk operations for payments and account activation
- Productivity and timesheet reporting
- Administrative dashboards and tools
- Responsive and accessible UI using Bootstrap

## Tech Stack
- **Backend:** PHP 8.x, PDO (MySQL)
- **Frontend:** Plain PHP views, Bootstrap 5 (served locally), Flatpickr (for date pickers)
- **Testing:** PHPUnit
- **Other:** Composer for dependency management

## Directory Structure
```
├── classes/         # PHP classes (business logic, models)
├── css/             # Local CSS assets (Bootstrap, custom styles)
├── js/              # Local JS assets (Bootstrap, Flatpickr, custom scripts)
├── tests/           # PHPUnit test cases
├── views/           # PHP view templates
├── vendor/          # Composer dependencies
├── index.php        # Main entry point
├── composer.json    # Composer configuration
├── phpunit.xml      # PHPUnit configuration
└── ...              # Other scripts and resources
```

## Setup
1. **Clone the repository:**
   ```bash
   git clone <repo-url>
   cd cobra_rbm
   ```
2. **Install dependencies:**
   ```bash
   php composer.phar install
   ```
3. **Configure the database:**
   - Create a MySQL database and user with appropriate privileges.
   - Update your environment variables or `ConfigObject.php` for DB credentials.
4. **Set up local assets:**
   - Download Bootstrap and Flatpickr and place them in `css/` and `js/` respectively.
5. **Configure web server:**
   - Point your web server's document root to this directory.

## Running Tests
Run all PHPUnit tests:
```bash
php composer.phar vendor/bin/phpunit tests
```

## Security Notes
- Do not expose sensitive files (e.g., `.env`, `composer.lock`) in production.
- Use secure passwords and HTTPS in production environments.

## License
© GMBS Consulting 2025. All rights reserved.

---
For questions or support, contact the project maintainer.
