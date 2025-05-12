Event Booking API
A RESTful API for managing events, attendees, and bookings, built with Laravel for a technical assessment.
Overview
This project is an Event Booking API that allows users to manage events, register attendees, and book events while ensuring capacity limits and preventing duplicate bookings. It follows RESTful principles, includes request validation, error handling, and adheres to best practices such as separation of concerns and design patterns.
Features

Event Management:
Create, update, delete, and list events.
Pagination and filtering for event listing (e.g., filter by country or event date).


Attendee Management:
Register attendees without authentication.
Retrieve attendee details.


Booking System:
Book an event with capacity checks and duplicate booking prevention.
Retrieve booking details.


Authentication & Authorization (Structured, not implemented):
Event management routes require JWT authentication.
Attendee registration and booking routes are unauthenticated.


Bonus Features:
Pagination and filtering for event listing.
API documentation via Swagger (swagger.yaml).
Docker support for easy deployment.



Technologies Used

Framework: Laravel 11
Database: MySQL 8.0
PHP: 8.1
Containerization: Docker (with docker-compose.yml for local development)
Testing: PHPUnit for unit and integration tests
API Documentation: Swagger (OpenAPI 3.0)

Prerequisites

PHP 8.1+
Composer
MySQL 8.0+ (if running locally without Docker)
Docker and Docker Compose (recommended for setup)
Git

Setup Instructions
Option 1: Using Docker (Recommended)
Docker is the recommended setup method as it avoids local MySQL configuration issues (see "Challenges Faced" section).

Clone the Repository:
git clone https://github.com/adiityapratap/event-booking-api.git
cd event-booking-api


Install PHP Dependencies:
composer install


Set Up Environment:

Copy the .env.example to .env:cp .env.example .env


Ensure the database settings are configured for Docker:DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=event_booking
DB_USERNAME=root
DB_PASSWORD=root




Start Docker Containers:
docker-compose up -d


This starts the app (PHP), db (MySQL), and nginx services.
Verify containers are running:docker ps




Run Database Migrations:
docker-compose exec app php artisan migrate


Access the API:

The API is available at http://localhost.
Test endpoints using Postman or Swagger (see "API Documentation" section).



Option 2: Local Setup (Without Docker)
If you prefer to run the project locally, ensure MySQL is installed and running.

Clone the Repository:
git clone https://github.com/adiityapratap/event-booking-api.git
cd event-booking-api


Install PHP Dependencies:
composer install


Set Up Environment:

Copy the .env.example to .env:cp .env.example .env


Update the database settings for your local MySQL setup:DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_booking
DB_USERNAME=root
DB_PASSWORD=your_mysql_root_password


Create the database in MySQL:mysql -u root -p
CREATE DATABASE event_booking;




Run Database Migrations:
php artisan migrate


Start the Laravel Development Server:
php artisan serve


The API is available at http://localhost:8000.



API Documentation

The API is documented using Swagger (OpenAPI 3.0).
The Swagger definition is available in swagger.yaml.
To explore the API:
Import swagger.yaml into Swagger UI (e.g., via https://editor.swagger.io/).
Or import it into Postman as an OpenAPI collection.


Example Endpoints:
GET /api/events: List all events (with pagination and filtering).
POST /api/attendees: Register a new attendee.
POST /api/bookings: Book an event.



Authentication Structure

Event Management Routes (POST, PUT, DELETE on /api/events):
Structured to require JWT authentication.
Implementation stubbed; can be implemented using tymon/jwt-auth.


Attendee and Booking Routes:
Unauthenticated, as per requirements.



Running Tests
The project includes unit and integration tests for event management and booking functionalities.

With Docker:docker-compose exec app php artisan test


Locally:php artisan test



Challenges Faced
During development, I encountered the following issue while running php artisan migrate locally:

Error: SQLSTATE[HY000] [2002] Connection refused.
Cause: The local MySQL server (installed via Homebrew on macOS) was not running. Attempts to start it with brew services start mysql failed due to an Input/output error (error code 5), likely caused by permission issues or a corrupted data directory.
Resolution:
After multiple attempts to fix the local MySQL setup (e.g., reinitializing the data directory, fixing permissions, checking port conflicts), I switched to using Docker, as provided in the project setup.
Docker resolved the issue by running MySQL in a container, ensuring a clean and isolated database environment.
Migrations were successfully executed using:docker-compose exec app php artisan migrate




Learning: This experience highlighted the importance of containerization for consistent development environments, especially when local setup issues arise.

Bonus Features Implemented

Pagination and Filtering:
Event listing supports pagination (GET /api/events?page=2) and filtering by country or event date (e.g., GET /api/events?country=USA&event_date=2025-05-13).


API Documentation:
Swagger documentation in swagger.yaml.


Docker Support:
Dockerfile and docker-compose.yml for easy setup and deployment.



Future Improvements

Implement JWT authentication using tymon/jwt-auth.
Add more advanced filtering options (e.g., by event capacity or availability).
Integrate a notification system (as outlined in the bonus task architecture).

Contact
For any questions or issues, please contact:

GitHub: adiityapratap


