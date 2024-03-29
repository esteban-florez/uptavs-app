<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $students = User::all()->count();
        $incomes = Payment::incomes();
        
        $clubs = Club::latest()
            ->orderBy('id', 'desc')
            ->limit(2)
            ->get();

        $courses = Course::availables()
            ->orderBy('id', 'desc')
            ->limit(2)
            ->get();
            
        $payments = $user->payments()
            ->unfulfilled()
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        if ($user->role === 'Administrador') {
            $payments = Payment::where('status', 'Pendiente')
                ->orderBy('id', 'desc')
                ->limit(2)
                ->get();
        }
            
        return view('home', [
            'user' => $user,
            'clubs' => $clubs,
            'courses' => $courses,
            'payments' => $payments,
            'students' => $students,
            'incomes' => "{$incomes} Bs.D.",
        ]);
    }
}
