<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Course;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::all();
        return view ('payments.index')->with('payments', $payments);
    }

    public function create(): View
    {
        $enrollments = Enrollment::pluck('enroll_no', 'id');
        return view('payments.create', compact('enrollments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Payment::create($input);
        return redirect('payments')->with('flash_message', 'Payment Added!');
    }

    public function show(string $id): View
    {
        $payment = Payment::find($id);
        return view('payments.show')->with('payments', $payment);
    }

    public function edit(string $id): View
    {

        $payment = Payment::find($id);
        $enrollments = Enrollment::pluck('enroll_no', 'id');

        return view('payments.edit', compact('payments','enrollments'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $payment = Payment::find($id);
        $input = $request->all();
        $payment->update($input);
        return redirect('payments')->with('flash_message', 'Payment Updated !');
    }

    public function destroy(string $id): RedirectResponse
    {
        Payment::destroy($id);
        return redirect('payments')->with('flash_message', 'Payment deleted!');
    }
}
