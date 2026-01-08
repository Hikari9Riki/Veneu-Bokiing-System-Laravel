<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Users (Data from your image)
        // Password is fixed to '123qweasd' for everyone
        $password = Hash::make('123qweasd');

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '0123456789',
                'role' => 'user',
                'password' => $password,
                'created_at' => '2026-01-07 18:18:55',
                'updated_at' => '2026-01-07 18:18:55',
            ],
            [
                'id' => 2,
                'name' => 'duwe',
                'email' => 'duwe@123',
                'phone' => '1110',
                'role' => 'user',
                'password' => $password,
                'created_at' => '2026-01-07 22:46:39',
                'updated_at' => '2026-01-07 22:46:39',
            ],
            [
                'id' => 3,
                'name' => 'duwe',
                'email' => 'duwe@321', // Note: Emails must be unique
                'phone' => '0111',
                'role' => 'user',
                'password' => $password,
                'created_at' => '2026-01-07 23:15:53',
                'updated_at' => '2026-01-07 23:15:53',
            ],
            [
                'id' => 4,
                'name' => 'Super Admin',
                'email' => 'admin@iium.edu.my',
                'phone' => '0123456789',
                'role' => 'admin',
                'password' => $password,
                'created_at' => '2026-01-08 10:04:28',
                'updated_at' => '2026-01-08 10:04:28',
            ],
        ]);

        // 2. Seed Venues (Data from your image)
        DB::table('venues')->insert([
            [
                'venueID' => 'V001',
                'name' => 'Main Hall',
                'kuliyyah' => 'KICT',
                'location' => 'Block A, Level 2',
                'capacity' => 300,
                'available' => 1,
            ],
            [
                'venueID' => 'V002',
                'name' => 'LR14',
                'kuliyyah' => 'KENMS',
                'location' => 'Block A, Level 4',
                'capacity' => 30,
                'available' => 1,
            ],
            [
                'venueID' => 'V003',
                'name' => 'LR14',
                'kuliyyah' => 'KICT',
                'location' => 'Block C, Level 2',
                'capacity' => 120,
                'available' => 1,
            ],
        ]);

        // 3. Seed Reservations
        // I have filled in the NULL reasons with generic events as requested.
        DB::table('reservations')->insert([
            [
                'date' => '2026-01-15',
                'startTime' => '09:00:00',
                'endTime' => '12:00:00',
                'status' => 'Pending',
                'venueID' => 'V001',
                'user_id' => null, // Image showed ID as NULL for this one
                'reason' => 'Annual General Meeting', // Filled Reason
                'created_at' => '2026-01-08 07:13:27',
                'updated_at' => '2026-01-08 07:13:27',
            ],
            [
                'date' => '2026-01-16',
                'startTime' => '09:00:00',
                'endTime' => '11:00:00',
                'status' => 'Approved',
                'venueID' => 'V002',
                'user_id' => 1,
                'reason' => 'Study Group Session', // Filled Reason
                'created_at' => '2026-01-08 07:14:29',
                'updated_at' => '2026-01-08 07:14:29',
            ],
            [
                'date' => '2026-01-17',
                'startTime' => '14:00:00',
                'endTime' => '17:00:00',
                'status' => 'Approved',
                'venueID' => 'V003',
                'user_id' => 1,
                'reason' => 'Project Discussion', // Filled Reason
                'created_at' => '2026-01-08 07:14:32',
                'updated_at' => '2026-01-08 07:14:32',
            ],
            [
                'date' => '2026-01-23',
                'startTime' => '20:00:00',
                'endTime' => '12:00:00',
                'status' => 'Pending',
                'venueID' => 'V003',
                'user_id' => 2,
                'reason' => 'Overnight Event Preparation', // Filled Reason
                'created_at' => '2026-01-08 07:22:52',
                'updated_at' => '2026-01-08 07:22:52',
            ],
            [
                'date' => '2026-01-16',
                'startTime' => '17:02:00',
                'endTime' => '21:02:00',
                'status' => 'Pending',
                'venueID' => 'V003',
                'user_id' => 2,
                'reason' => 'Club Weekly Meetup', // Filled Reason
                'created_at' => '2026-01-08 09:02:52',
                'updated_at' => '2026-01-08 09:02:52',
            ],
            [
                'date' => '2026-01-29',
                'startTime' => '18:03:00',
                'endTime' => '22:03:00',
                'status' => 'Approved',
                'venueID' => 'V003',
                'user_id' => 2,
                'reason' => 'Video Recording Session', // Filled Reason
                'created_at' => '2026-01-08 09:03:53',
                'updated_at' => '2026-01-08 09:03:53',
            ],
            [
                'date' => '2026-01-29',
                'startTime' => '17:12:00',
                'endTime' => '21:12:00',
                'status' => 'Rejected',
                'venueID' => 'V002',
                'user_id' => 2,
                'reason' => 'makan nasi', // Kept original reason
                'created_at' => '2026-01-08 09:12:23',
                'updated_at' => '2026-01-08 10:21:29',
            ],
        ]);
    }
}