# Applications Support Activity Tracker (Laravel)

A daily activity tracking and shift handover monitoring tool built for Npontu Technologies.

## Features Implemented
- User Authentication & Password Recovery
- Daily Support Task Logging (SMS counts, logs, etc.)
- Shift Handover View (Pending/Done tasks & remarks)
- Agent Bio Details & Automated Timestamps
- Reporting View with Custom Date Filtering & CSV Export

## Setup Instructions for Reviewers
1. **Clone repository:** `git clone https://github.com/nii869230-source/support-tracker-laravel.git`
2. **Navigate into project:** `cd support-tracker-laravel`
3. **Install dependencies:** `composer install` and `npm install`
4. **Setup environment:** `cp .env.example .env` (or `copy .env.example .env` on Windows CMD)
5. **Generate key:** `php artisan key:generate`
6. **Link storage:** `php artisan storage:link`
7. **Run migrations & seeds:** `php artisan migrate --seed`
8. **Start application:** Run `php artisan serve` and `npm run dev`
