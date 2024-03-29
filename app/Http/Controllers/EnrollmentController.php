<?php

namespace App\Http\Controllers;

use App\Events\PaymentEvent;
use App\Http\Requests\EnrollmentRequest;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\MovilCredentials;
use App\Models\TransferCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Enrollment::class);
    }

    public function index(Request $request)
    {
        $course = Course::findOrFail($request->query('course'));
        $search = $request->query('search');
        
        $enrollments = Enrollment::whereBelongsTo($course)
            ->latest()
            ->paginate(10)
            ->withQueryString();
        
        return view('enrollments.index', [
            'course' => $course,
            'enrollments' => $enrollments,
            'search' => $search,
        ]);
    }

    public function create(Request $request)
    {
        $course = Course::findOrFail($request->query('course'));
        $credentials = new \stdClass;
        
        $credentials->movil = MovilCredentials::select(
            ['ci', 'bank', 'phone'])->firstOrFail();
        
        $credentials->transfer = TransferCredentials::select(
            ['name', 'ci', 'bank', 'account', 'type'])->firstOrFail();

        return view('enrollments.create', [
            'course' => $course,
            'credentials' => $credentials,
        ]);
    }

    public function store(EnrollmentRequest $request)
    {
        $enrollment = Enrollment::create([
            'course_id' => Course::findOrFail($request->query('course'))->id,
            'user_id' => Auth::user()->id,
            'mode' => $request->safe()->mode,
        ]);

        $data = $request->safe()->merge([
            'enrollment_id' => $enrollment->id,
        ])->except('mode');

        $payment = Payment::create($data);

        if ($request->input('mode') === 'Reservación') {
            Payment::create([
                'category' => 'Cuota restante',
                'fulfilled' => false,
                'enrollment_id' => $enrollment->id,
            ]);
        }

        event(new PaymentEvent($payment, 'created'));

        return redirect()
            ->route('enrollments.success', $enrollment);
    }

    public function success(Enrollment $enrollment)
    {
        $this->authorize('enrollments.success', $enrollment);

        $payment = $enrollment
            ->payments()
            ->whereIn('category', ['Pago completo', 'Reservación'])
            ->first();

        return view('enrollments.success', [
            'enrollment' => $enrollment,
            'isOnline' => $payment->isOnline(),
        ]);
    }
}
