<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Get all payments
    public function index()
    {
        return response()->json(Payment::all());
    }

    // Store new payment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollno' => 'required|string|max:255',
            'paiddate' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $payment = Payment::create($validated);

        return response()->json([
            'message' => 'Payment created successfully!',
            'payment' => $payment,
        ], 201);
    }

    // Show a single payment
    public function show(Payment $payment)
    {
        return response()->json($payment);
    }

    // Update existing payment
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'enrollno' => 'required|string|max:255',
            'paiddate' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $payment->update($validated);

        return response()->json([
            'message' => 'Payment updated successfully!',
            'payment' => $payment,
        ]);
    }

    // Delete payment
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json([
            'message' => 'Payment deleted successfully!',
        ]);
    }
}
