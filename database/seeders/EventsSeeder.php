<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Tech Conference 2025',
                'description' => 'A conference bringing together innovators and leaders in technology.',
                'requirements' => 'Commitment: Should attend the pre-event briefing and complete assigned tasks responsibly.',
                'location' => 'Kathmandu, Nepal',
                'type' => '1', // offline
                'start_date' => Carbon::create(2025, 11, 10, 9, 0, 0),
                'end_date' => Carbon::create(2025, 11, 12, 17, 0, 0),
                'capacity' => '500',
                'is_volunteers_required' => true,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Online Coding Bootcamp',
                'description' => 'A 7-day online bootcamp covering full stack development.',
                'requirements' => 'Minimum Age: 18 years or above (or as per event policy).x`',
                'location' => 'Zoom',
                'type' => '0', // online
                'start_date' => Carbon::create(2025, 11, 8, 10, 0, 0),
                'end_date' => Carbon::create(2025, 11, 10, 18, 0, 0),
                'capacity' => '200',
                'is_volunteers_required' => false,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Charity Fundraiser Gala',
                'description' => 'Fundraising event for local NGOs working in education and health.',
                'location' => 'Biratnagar, Nepal',
                'requirements' => 'Availability: Must be available on the event date and during setup/cleanup time.',
                'type' => '1', // offline
                'start_date' => Carbon::create(2025, 12, 15, 18, 30, 0),
                'end_date' => Carbon::create(2025, 12, 15, 22, 0, 0),
                'capacity' => '300',
                'is_volunteers_required' => true,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
