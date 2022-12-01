<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registry;

class RegistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Registry::truncate();
        
        for ($i = 1; $i <= 5; $i++) {
            Registry::create([
                'student_id' => $i,
                'course_id' => $i,
                'unique' => null,
            ]);
        }

        for ($i = 2; $i <= 5; $i++) {
            Registry::create([
                'student_id' => $i,
                'course_id' => 1,
                'unique' => null,
            ]);
        }
    }
}
