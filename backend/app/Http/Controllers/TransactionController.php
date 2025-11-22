<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
class TransactionController extends Controller
{

public function index()
{
    $userAccountIds = Account::where('user_id', auth()->id())->pluck('id');

    $transactions = Transaction::whereIn('sender_account_id', $userAccountIds)
        ->orWhereIn('receiver_account_id', $userAccountIds)
        ->with(['senderAccount', 'receiverAccount', 'currency', 'paymentMethod'])
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'message' => 'Transaction history retrieved successfully.',
        'data' => $transactions
    ]);
}

}
