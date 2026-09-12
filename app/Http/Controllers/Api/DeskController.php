<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desk;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    // 1. Fetch a list of all active desks
    public function index()
    {
        // Fetch only active desks, ordered by their ID
        $desks = Desk::where('is_active', true)->orderBy('id')->get();
        
        // Return them as a JSON response with a 200 (OK) status code
        return response()->json($desks, 200);
    }

    // 2. Create a new desk (for Admin users)
    public function store(Request $request)
    {
        // Validate the incoming data from React
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'features' => 'nullable|json',
        ]);

        // Create the desk in the database
        $desk = Desk::create($validated);

        // Return the newly created desk as JSON with a 201 (Created) status code
        return response()->json($desk, 201);
    }
}