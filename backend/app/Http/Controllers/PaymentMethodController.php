<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Add a new external payment method
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tokenized_id' => 'required|string|unique:payment_methods,tokenized_id',
            'method_type'  => 'required|string',
        ]);

        $paymentMethod = PaymentMethod::create([
            'tokenized_id' => $validated['tokenized_id'],
            'method_type'  => $validated['method_type'],
            'user_id'      => auth()->id(),   // IMPORTANT
        ]);

        return response()->json([
            'message' => 'Payment method added successfully.',
            'data' => $paymentMethod
        ], 201);
    }
    public function update(Request $request, $id)
{
    // Find payment method
    $paymentMethod = PaymentMethod::where('id', $id)
        ->where('user_id', auth()->id()) // security check: user can edit only his payment methods
        ->firstOrFail();

    // Validate input
    $validated = $request->validate([
        'tokenized_id' => 'sometimes|string|unique:payment_methods,tokenized_id,' . $paymentMethod->id,
        'method_type'  => 'sometimes|string',
    ]);

    // Update payment method
    $paymentMethod->update($validated);

    return response()->json([
        'message' => 'Payment method updated successfully.',
        'data' => $paymentMethod
    ]);
}
public function destroy($id)
{
    // Find the payment method belonging to the authenticated user
    $paymentMethod = PaymentMethod::where('id', $id)
        ->where('user_id', auth()->id()) // Prevent deleting others' methods
        ->firstOrFail();

    // Delete it
    $paymentMethod->delete();

    return response()->json([
        'message' => 'Payment method deleted successfully.'
    ]);
}


}
