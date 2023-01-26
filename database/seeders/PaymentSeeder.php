<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Enrollment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();
        
        Enrollment::all()
            ->each(function ($enrollment) {
                if ($enrollment->mode === 'Pago completo') {
                    $payment = $this->createPayment($enrollment, 'Completo');
                    $payment->save();
                    return;
                }
                
                $payment = $this->createPayment($enrollment, 'Reservación');
                $payment->save();

                if (rand(0, 1)) {
                    $payment = $this->createPayment($enrollment,'Restante');
                    $payment->save();
                }
            });
    }

    private function createPayment($enrollment, $category)
    {
        $payment = Payment::factory([
            'enrollment_id' => $enrollment->id,
            'category' => $category,
        ])->make();
        
        $course = $enrollment->course;

        $basePrices = [
            'Restante' => $course->total_price - $course->reserv_price,
            'Completo' => $course->total_price,
            'Reservación' => $course->reserv_price,
        ];

        if ($payment->type !== 'Efectivo ($)') {
            $payment->amount = $basePrices[$category] * 20.30;
        } else {
            $payment->amount = $basePrices[$category];
        }

        return $payment;
    }
}
