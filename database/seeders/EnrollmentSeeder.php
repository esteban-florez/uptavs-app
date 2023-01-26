<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\User;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enrollment::truncate();

        $students = User::where('role', 'Estudiante')->get()->skip(1);
        
        // Curso en inscripciones
        $students->take(14)
            ->each(function ($s) {
                Enrollment::create([
                    'user_id' => $s->id,
                    'course_id' => 1,
                    'mode' => modes()->random(),
                ]);
            });
        
        // Curso inscripciones para probar lo de enrollments:expired
        $students->take(11)
            ->each(function ($s, $i) {
                Enrollment::create([
                    'user_id' => $s->id,
                    'course_id' => 2,
                    'created_at' => $i === 1 ? now()->subDays(Enrollment::EXPIRES_IN + 1) : now(),
                    'mode' => 'Pago completo',
                ]);
            });

        // Curso activo
        $students->take(12)
            ->each(function ($s, $i) {
                Enrollment::create([
                    'user_id' => $s->id,
                    'course_id' => 4,
                    // Estudiante no confirmado a proposito para probar lo de enrollments:unconfirmed
                    'confirmed_at' => $i === 1 ? null : now()->subDays(1),
                    'mode' => modes()->random(),
                ]);
            });
        
        // Curso finalizado
        $students->take(12)
            ->each(function ($s) {
                Enrollment::create([
                    'user_id' => $s->id,
                    'course_id' => 5,
                    'confirmed_at' => now()->subDays(1),
                    'mode' => modes()->random(),
                ]);
            });
    }
}
