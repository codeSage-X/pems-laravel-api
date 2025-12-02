PEMS API - Personal Equipment Management System
Backend API for GeoPlex Oil & Gas Operations

A comprehensive REST API for managing personnel, equipment, jobs, vehicles, and logistics operations in the oil and gas industry. Built with Laravel 11, PostgreSQL, and Laravel Sanctum for secure API authentication.

🎯 Overview
PEMS (Personal Equipment Management System) streamlines operations management by tracking:

Personnel - Employee management with roles and status tracking
Jobs - Task assignments with priority levels and status updates
Equipment/Inventory - Asset tracking with maintenance schedules
Vehicles/Logistics - Fleet management with fuel and mileage monitoring
Clients - Customer relationship management

Perfect for oil & gas companies managing field operations, equipment maintenance, and workforce logistics.

🚀 Tech Stack
Core Framework

Laravel 11.x - Modern PHP framework with elegant syntax
PHP 8.2+ - Latest PHP version with performance improvements
Composer - Dependency management

Database

PostgreSQL 15 - Robust relational database
Eloquent ORM - Laravel's powerful database abstraction layer
Database Migrations - Version control for database schema

Authentication & Security

Laravel Sanctum - Simple token-based API authentication
JWT Tokens - Secure stateless authentication
CORS Middleware - Cross-origin resource sharing configuration
Password Hashing - Bcrypt password encryption
Role-Based Access Control - BD_USER, OPS_MANAGER, ADMIN roles

API Features

RESTful Architecture - Clean, predictable API endpoints
JSON Responses - Standardized response format
Request Validation - Built-in validation rules
Error Handling - Comprehensive error messages
Pagination - Efficient data loading
Filtering & Search - Advanced query capabilities

Development Tools

Laravel Artisan - Command-line interface
Database Seeders - Sample data generation
Factory Pattern - Test data creation
API Route Caching - Performance optimization


📦 Key Features
✅ Authentication System

User registration with role assignment
Secure login/logout
Token-based session management
Password hashing and validation

✅ User Management

Create, read, update, delete users
Filter by role (BD_USER, OPS_MANAGER, ADMIN)
Filter by status (ACTIVE, ON_LEAVE, SICK)
Search by name or email
View user job history

✅ Job Management

Create and assign jobs to employees
Track job status (PENDING, IN_PROGRESS, COMPLETED, CANCELLED)
Set priority levels (LOW, MEDIUM, HIGH, CRITICAL)
Assign equipment and vehicles to jobs
Filter by status, priority, employee, client, date range
Update job status independently
Link jobs to clients

✅ Equipment/Inventory Tracking

Comprehensive equipment catalog
Track maintenance schedules
Monitor equipment status (OPERATIONAL, MAINTENANCE, OUT_OF_SERVICE, RETIRED)
Serial number tracking
Location management
Maintenance history
Filter by type, status, location
Maintenance due alerts

✅ Vehicle/Logistics Management

Fleet tracking
Fuel level monitoring
Mileage tracking
Vehicle status (AVAILABLE, IN_TRANSIT, MAINTENANCE)
Inspection scheduling
License plate management
Low fuel alerts

✅ Client Management

Client directory
Industry classification
Contact information management
View client job history
Status tracking (ACTIVE, INACTIVE)


🗄️ Database Schema
Tables

users - Personnel with roles and authentication
clients - Customer companies
jobs - Task assignments and tracking
equipment - Inventory and asset management
vehicles - Fleet and logistics
personal_access_tokens - Sanctum authentication tokens

Key Relationships

Users → Jobs (One-to-Many)
Clients → Jobs (One-to-Many)
Jobs → Equipment (Many-to-Many via text field)
Jobs → Vehicles (Many-to-Many via text field)


🔌 API Endpoints
Authentication
POST   /api/register      - Register new user
POST   /api/login         - Login user
POST   /api/logout        - Logout user (protected)
GET    /api/me            - Get current user (protected)
Users
GET    /api/users         - List all users (filterable)
GET    /api/users/{id}    - Get single user
PUT    /api/users/{id}    - Update user
DELETE /api/users/{id}    - Delete user
Jobs
GET    /api/jobs          - List all jobs (filterable)
POST   /api/jobs          - Create new job
GET    /api/jobs/{id}     - Get single job
PUT    /api/jobs/{id}     - Update job
PATCH  /api/jobs/{id}/status - Update job status only
DELETE /api/jobs/{id}     - Delete job
Equipment
GET    /api/equipment     - List all equipment (filterable)
POST   /api/equipment     - Create new equipment
GET    /api/equipment/{id} - Get single equipment
PUT    /api/equipment/{id} - Update equipment
DELETE /api/equipment/{id} - Delete equipment
Vehicles
GET    /api/vehicles      - List all vehicles (filterable)
POST   /api/vehicles      - Create new vehicle
GET    /api/vehicles/{id} - Get single vehicle
PUT    /api/vehicles/{id} - Update vehicle
DELETE /api/vehicles/{id} - Delete vehicle
Clients
GET    /api/clients       - List all clients (filterable)
GET    /api/clients/{id}  - Get single client with jobs

🛠️ Installation & Setup
Prerequisites

PHP 8.2 or higher
Composer
PostgreSQL 15 or higher
Git

Local Development

Clone the repository

bashgit clone <repository-url>
cd pems-api

Install dependencies

bashcomposer install

Configure environment

bashcp .env.example .env
Edit .env with your database credentials:
envDB_CONNECTION=pgsql
DB_HOST=your-postgres-host
DB_PORT=5432
DB_DATABASE=pems_db
DB_USERNAME=postgres
DB_PASSWORD=your-password

Generate application key

bashphp artisan key:generate

Run migrations

bashphp artisan migrate

Seed database (optional)

bashphp artisan db:seed

Start development server

bashphp artisan serve
API available at: http://localhost:8000/api

🚢 Deployment
Railway (Recommended)

Connect GitHub repository
Add environment variables
Deploy automatically

Render.com

Connect repository
Set build command: composer install --no-dev
Set start command: php artisan serve --host=0.0.0.0 --port=$PORT

Environment Variables (Production)
envAPP_ENV=production
APP_DEBUG=false
APP_KEY=base64:...
DATABASE_URL=postgresql://...
FRONTEND_URL=https://your-frontend-url.com

📖 API Usage Examples
Register User
bashcurl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "BD_USER"
  }'
Login
bashcurl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
Get Jobs (Authenticated)
bashcurl -X GET http://localhost:8000/api/jobs \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
Filter Jobs
bashcurl -X GET "http://localhost:8000/api/jobs?status=IN_PROGRESS&priority=HIGH" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"

🧪 Testing
Postman Collection
Import the provided Postman collection for complete API testing.
Sample Test Users (After Seeding)
Email: chukwu@pems.com | Password: password | Role: BD_USER
Email: zainab@pems.com | Password: password | Role: OPS_MANAGER
Email: adebayo@pems.com | Password: password | Role: BD_USER

📊 Database Seeding
Includes sample data for:

3 Users (Nigerian names, different roles)
3 Clients (Shell, Chevron, TotalEnergies)
4 Equipment items (Compressor, Pumps, Gauges)
3 Vehicles (Trucks, Vans, Cars)
2 Jobs (Pipeline Inspection, Equipment Maintenance)


🔒 Security Features

Password hashing with Bcrypt
Token-based authentication (Sanctum)
CORS configuration for frontend integration
SQL injection prevention via Eloquent ORM
Input validation on all endpoints
Rate limiting on API routes
Environment-based configuration


🌍 Use Cases
Perfect for:

Oil & gas field operations management
Equipment rental companies
Logistics and fleet management
Field service operations
Maintenance scheduling systems
Asset tracking platforms


📝 License
MIT License - Free to use for commercial and personal projects

👥 Contributing

Fork the repository
Create feature branch (git checkout -b feature/AmazingFeature)
Commit changes (git commit -m 'Add AmazingFeature')
Push to branch (git push origin feature/AmazingFeature)
Open Pull Request


📞 Support
For issues, questions, or contributions:

Open an issue on GitHub
Email: support@pems-api.com


🎯 Roadmap

 Real-time notifications (WebSockets)
 File upload for equipment documentation
 Advanced reporting and analytics
 Mobile app integration
 WhatsApp notifications (Twilio)
 Export to PDF/Excel
 Multi-language support
 Equipment QR code generation


🏆 Built With

Laravel Framework - Backend logic
Eloquent ORM - Database operations
Laravel Sanctum - API authentication
PostgreSQL - Data persistence
Composer - Dependency management

