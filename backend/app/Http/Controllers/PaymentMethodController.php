<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tokenized_id' => 'required|string|unique:payment_methods,tokenized_id',
            'method_type'  => 'required|string',
        ]);

        $paymentMethod = PaymentMethod::create([
            'tokenized_id' => $validated['tokenized_id'],
            'method_type'  => $validated['method_type'],
            'user_id'      => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Payment method added successfully.',
            'data' => $paymentMethod
        ], 201);
    }
    public function update(Request $request, $id)
{
    $paymentMethod = PaymentMethod::where('id', $id)
        ->where('user_id', auth()->id()) 
        ->firstOrFail();

    $validated = $request->validate([
        'tokenized_id' => 'sometimes|string|unique:payment_methods,tokenized_id,' . $paymentMethod->id,
        'method_type'  => 'sometimes|string',
    ]);

    $paymentMethod->update($validated);

    return response()->json([
        'message' => 'Payment method updated successfully.',
        'data' => $paymentMethod
    ]);
}
public function destroy($id)
{
    $paymentMethod = PaymentMethod::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $paymentMethod->delete();

    return response()->json([
        'message' => 'Payment method deleted successfully.'
    ]);
}
}