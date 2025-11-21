<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'recipient_name'           => 'required|string',
        'recipient_account_number' => 'required|string',
    ]);

    $beneficiary = Beneficiary::create([
        'recipient_name'           => $validated['recipient_name'],
        'recipient_account_number' => $validated['recipient_account_number'],
        'user_id'                  => auth()->id(),
    ]);

    return response()->json([
        'message' => 'Beneficiary added successfully.',
        'data'    => $beneficiary
    ], 201);
}

public function index()
{
    $beneficiaries = Beneficiary::where('user_id', auth()->id())->get();

    return response()->json([
        'message' => 'Beneficiaries retrieved successfully.',
        'data'    => $beneficiaries
    ]);
}
public function update(Request $request, $id)
{
    $beneficiary = Beneficiary::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $validated = $request->validate([
        'recipient_name'           => 'sometimes|string',
        'recipient_account_number' => 'sometimes|string',
    ]);

    $beneficiary->update($validated);

    return response()->json([
        'message' => 'Beneficiary updated successfully.',
        'data'    => $beneficiary
    ]);
}

public function destroy($id)
{
    $beneficiary = Beneficiary::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $beneficiary->delete();

    return response()->json([
        'message' => 'Beneficiary deleted successfully.'
    ]);
}



}
