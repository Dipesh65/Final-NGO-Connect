<?
 /*
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NgoSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('ngos')->insert([
            [
                'user_id' => 2,
                'ngo_name' => 'Nepal Education Foundation',
                'registration_date' => '2010-03-15',
                'category' => 'Education',
                'address' => 'Kathmandu, Nepal',
                'phone' => '+977-9851000001',
                'registration_number' => 'DAO-12345',
                'registration_district' => 'Kathmandu',
                'last_renewal_date' => '2024-01-05',
                'pan_number' => 'PAN1234567',
                'mission' => 'To improve education access in rural Nepal.',
                'description' => 'We run schools, provide scholarships, and train teachers in remote regions.',
                'photos' => json_encode(['photos/ngo1_1.jpg', 'photos/ngo1_2.jpg']),
                'contact_position' => 'Executive Director',
                'subcategory' => 'Child Education',
                'logo' => 'logos/ngo1.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'ngo_name' => 'Healthy Nepal Initiative',
                'registration_date' => '2015-07-20',
                'category' => 'Health',
                'address' => 'Pokhara, Nepal',
                'phone' => '+977-9851000002',
                'registration_number' => 'DAO-67890',
                'registration_district' => 'Kaski',
                'last_renewal_date' => '2023-12-15',
                'pan_number' => 'PAN9876543',
                'mission' => 'Promoting health and wellness for all.',
                'description' => 'We provide free health camps, awareness programs, and mobile clinics.',
                'photos' => json_encode(['photos/ngo2_1.jpg']),
                'contact_position' => 'Program Manager',
                'subcategory' => 'Community Health',
                'logo' => 'logos/ngo2.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
    */