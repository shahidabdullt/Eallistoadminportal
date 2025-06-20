<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Only seed if no admin users exist
        if (User::where('isadmin', '1')->count() === 0) {
            
            // Get credentials from environment variables
            $adminemail = env('ADMIN_EMAIL');
            $adminPassword = env('ADMIN_PASSWORD');
            
            // Validate required environment variables
            if (!$adminemail || !$adminPassword) {
                $this->command->error('ADMIN_EMAIL and ADMIN_PASSWORD must be set in .env file');
                return;
            }
            
            // Validate password strength
            
            
            // Create admin user
            User::create([
                'username' => env('ADMIN_USERNAME', 'admin'),
                'email' => $adminemail,
                'email_verified_at' => now(),
                'isadmin' => '1',
                'password' => Hash::make($adminPassword),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $this->command->info('Admin user created successfully');
            
            // Only create regular user if in development
            if (app()->environment('local', 'staging')) {
                User::create([
                    'username' => 'testuser',
                    'email' => 'test@example.com',
                    'email_verified_at' => now(),
                    'isadmin' => '0',
                    'password' => Hash::make('SecureTestPass123!'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $this->command->info('Test user created successfully');
            }
            
        } else {
            $this->command->info('Admin user already exists, skipping seeding');
        }

    }
}