<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get all categories
    public function index()
    {
        $categories = Kategori::where('status', 'aktif')->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}
