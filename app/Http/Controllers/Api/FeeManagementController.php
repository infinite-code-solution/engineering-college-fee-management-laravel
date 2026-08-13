<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeManagementController extends Controller
{
    public function index()
    {
        // 1. Fetch all raw ledger rows
        $records = FeeStructure::orderBy('due_date', 'asc')->get();

        // 2. Aggregate dashboard mathematical totals
        $totalCollected = FeeStructure::sum('amount_paid');
        $totalPending = FeeStructure::sum('balance_amount');
        $grandTotal = FeeStructure::sum('total_amount');

        // Prevent division by zero errors on fresh setups
        $collectionRate = $grandTotal > 0 ? round(($totalCollected / $grandTotal) * 100, 1) : 0;

        // 3. Return a clean unified payload matching your Angular models
        return response()->json([
            'success' => true,
            'summary' => [
                'total_collected' => $totalCollected,
                'total_pending' => $totalPending,
                'collection_rate_percentage' => $collectionRate
            ],
            'data' => $records
        ], 200);
    }
}
