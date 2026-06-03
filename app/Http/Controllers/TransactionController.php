<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index()
    {
        $transactions = Transaction::with('project')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.transaction.index', compact('transactions'));
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('project.client');
        return view('admin.transaction.show', compact('transaction'));
    }
}
