<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    // Get all freelancers
    public function index(Request $request)
    {
        $query = Freelancer::where('status', 'aktif');

        // Filter by keahlian
        if ($request->has('keahlian')) {
            $query->where('keahlian', 'LIKE', '%' . $request->keahlian . '%');
        }

        $freelancers = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $freelancers
        ]);
    }

    // Get single freelancer
    public function show($id)
    {
        $freelancer = Freelancer::find($id);

        if (!$freelancer) {
            return response()->json([
                'success' => false,
                'message' => 'Freelancer tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $freelancer
        ]);
    }
}
