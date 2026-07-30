<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Carbon;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first registered user or create a default support agent
        $user = '\App\Models\User::first'() ?? '\App\Models\User::factory'()->create([
            'name' => 'Support Lead',
            'email' => 'support@npontu.com',
        ]);

        $sampleLogs = [
            // --- TODAY'S ACTIVITIES (Shows in Daily Handover View) ---
            [
                'activity_title' => 'Daily SMS count in comparison to SMS count from logs',
                'description' => 'Reconciled SMS gateway logs with database records. Total sent: 14,250. Log match rate: 99.8%.',
                'status' => 'Done',
                'remarks' => 'Minor mismatch of 28 SMS due to network timeout at 03:00 AM.',
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'activity_title' => 'Database Backup Verification',
                'description' => 'Verified automated daily backup dump for production database instance.',
                'status' => 'Done',
                'remarks' => 'Backup restored successfully on test environment.',
                'created_at' => Carbon::now()->subHours(4),
            ],
            [
                'activity_title' => 'Payment Gateway Webhook Failures',
                'description' => 'Investigating failed callback responses for transaction batch #8841.',
                'status' => 'In Progress',
                'remarks' => 'Pending response from third-party API vendor.',
                'created_at' => Carbon::now()->subMinutes(45),
            ],
            [
                'activity_title' => 'User Auth Service Latency Check',
                'description' => 'Monitored response times during peak hours for authentication endpoints.',
                'status' => 'Pending',
                'remarks' => 'Average response time spiked to 450ms. Handed over to night shift agent.',
                'created_at' => Carbon::now()->subMinutes(10),
            ],

            // --- HISTORICAL ACTIVITIES (Shows when testing Custom Date Range filters) ---
            [
                'activity_title' => 'EOD Reconciliation Report',
                'description' => 'Generated end-of-day financial transaction summaries for core application logs.',
                'status' => 'Done',
                'remarks' => 'All accounts balanced.',
                'created_at' => Carbon::now()->subDays(1)->setTime(17, 30),
            ],
            [
                'activity_title' => 'API Gateway Token Expiry Adjustment',
                'description' => 'Patched short JWT token expiration duration affecting partner integrations.',
                'status' => 'Done',
                'remarks' => 'Extended token TTL to 24 hours.',
                'created_at' => Carbon::now()->subDays(2)->setTime(11, 15),
            ],
            [
                'activity_title' => 'Disk Space Audit on Application Server',
                'description' => 'Cleared temporary log cache directory on production app node 02.',
                'status' => 'Done',
                'remarks' => 'Freed 18GB of disk space.',
                'created_at' => Carbon::now()->subDays(3)->setTime(9, 00),
            ],
            [
                'activity_title' => 'Failed Batch SMS Retry Execution',
                'description' => 'Re-triggered queue execution for failed transactional notification messages.',
                'status' => 'Done',
                'remarks' => 'All 1,200 pending SMS delivered successfully.',
                'created_at' => Carbon::now()->subDays(5)->setTime(14, 20),
            ],
            [
                'activity_title' => 'SSL Certificate Renewal',
                'description' => 'Updated Let’s Encrypt SSL certificates for support portal API endpoints.',
                'status' => 'Done',
                'remarks' => 'Verified valid until late 2026.',
                'created_at' => Carbon::now()->subDays(7)->setTime(10, 00),
            ],
        ];

        foreach ($sampleLogs as $log) {
            ActivityLog::create([
                'user_id' => $user->id,
                'activity_title' => $log['activity_title'],
                'description' => $log['description'],
                'status' => $log['status'],
                'remarks' => $log['remarks'],
                'created_at' => $log['created_at'],
                'updated_at' => $log['created_at'],
            ]);
        }
    }
}
