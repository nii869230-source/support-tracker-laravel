# Applications Support Activity Tracker (Laravel)

A daily activity tracking and shift handover monitoring tool built for Npontu Technologies.

## Features Implemented
- User Authentication & Password Recovery
- Daily Support Task Logging (SMS counts, logs, etc.)
- Shift Handover View (Pending/Done tasks & remarks)
- Agent Bio Details & Automated Timestamps
- Reporting View with Custom Date Filtering & CSV Export

## Setup Instructions for Reviewers
1. Clone repository: `git clone <YOUR-GITHUB-REPO-LINK>`
2. Install dependencies: `composer install` & `npm install`
3. Setup environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Link storage: `php artisan storage:link`
6. Run migrations & seeds: `php artisan migrate`
7. Start server: `php artisan serve`
8. Run application: `composer run dev` (or `php artisan serve`)