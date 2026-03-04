<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    private $data = [
        ['id' => 1, 'nama' => 'Ali', 'npm' => '2022001'],
        ['id' => 2, 'nama' => 'Budi', 'npm' => '2022002'],
    ];

    public function index()
    {
        return response()->json($this->data);
    }

    public function show($id)
    {
        $mhs = collect($this->data)->firstWhere('id', $id);
        return $mhs ? response()->json($mhs) : response()->json(['error' => 'Not Found'], 404);
    }

    public function store(Request $request)
    {
        $new = [
            'id' => count($this->data) + 1,
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
        ];
        return response()->json($new, 201);
    }
}
