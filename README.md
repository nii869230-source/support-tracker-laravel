# Applications Support Activity Tracker (Laravel)

A daily activity tracking and shift handover monitoring tool built for Npontu Technologies.

## Features Implemented
- User Authentication & Password Recovery
- Daily Support Task Logging (SMS counts, logs, etc.)
- Shift Handover View (Pending/Done tasks & remarks)
- Agent Bio Details & Automated Timestamps
- Reporting View with Custom Date Filtering & CSV Export

## Setup Instructions for Reviewers
1. Install dependencies: `composer install` & `npm install`
2. Setup environment: `cp .env.example .env`
3. Generate key: `php artisan key:generate`
4. Link storage: `php artisan storage:link`
5. Run migrations & seeds: `php artisan migrate`
6. Start server: `php artisan serve`
7. Run application: `composer run dev` (or `php artisan serve`)
