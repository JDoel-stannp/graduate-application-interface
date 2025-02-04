<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    // GET /api/graduates - List all graduates
    public function index()
    {
        return response()->json(Graduate::all());
    }

    // POST /api/graduates - Create a new graduate
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'postcode'   => 'nullable|string'
        ]);

        $graduate = Graduate::create($data);
        return response()->json($graduate, 201);
    }

    // GET /api/graduates/{id} - Show a single graduate
    public function show($id)
    {
        $graduate = Graduate::find($id);
        if (!$graduate) {
            return response()->json(['error' => 'Graduate not found'], 404);
        }
        return response()->json($graduate);
    }

    // PUT/PATCH /api/graduates/{id} - Update a graduate
    public function update(Request $request, $id)
    {
        $graduate = Graduate::find($id);
        if (!$graduate) {
            return response()->json(['error' => 'Graduate not found'], 404);
        }

        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'postcode'   => 'nullable|string'
        ]);

        $graduate->update($data);
        return response()->json($graduate);
    }

    // DELETE /api/graduates/{id} - Delete a graduate
    public function destroy($id)
    {
        $graduate = Graduate::find($id);
        if (!$graduate) {
            return response()->json(['error' => 'Graduate not found'], 404);
        }

        $graduate->delete();
        return response()->json(['success' => true]);
    }
}
