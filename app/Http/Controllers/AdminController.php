<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function indexKapal()
    {
        $res = Http::get(env('APP_API_URL').'/kapal',);
        if($res->successful()) {
            $json = $res->json();
            $data['kapal'] = collect($json)->sortBy('nama_kapal');

        }
        return view('admin.boats', $data);
    }

    public function storeKapal(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|size:5|unique:kapal',
            'nama_kapal' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto_kapal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,maintenance,tidak aktif',
        ]);

        $file = $request->file('foto_kapal');
        $res = Http::attach(
            'foto_kapal',        // Nama field
            file_get_contents($file), // Isi file
            $validated['nama_kapal']// Nama file asli
            )->post(env('APP_API_URL').'/kapal', $validated);
            $json = $res->json();

        // $res = Http::post(env('APP_API_URL').'/kapal',$validated);
        if($res->successful()) {
            $json = $res->json();
            return redirect('/admin/boats')->with('message', 'Kapal berhasil ditambahkan');
        } else {
            return back()->with('error', 'Gagal menambahkan kapal: ' . $res->json()['message'] ?? 'Error tidak diketahui');
        }

    }

    public function editKapal($id) {
        $res = Http::get(env('APP_API_URL').'/kapal/'.$id);

        $json = $res->json();
        if($res->successful()){
            $data['kapal'] = $json;
        }
        return view('admin.boats', $data);
    }

    public function updateKapal(Request $request, $id)
    {
        $validated = $request->validate([
            'id' => 'required|string|size:5|unique:kapal',
            'nama_kapal' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto_kapal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,maintenance,tidak aktif',
        ]);

        if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $data = collect($validated)->except('foto')->all();

        $res = Http::asMultipart()->attach(
                'foto_kapal',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->put(env('APP_API_URL').'/kapal/'.$id, $data);
        } else {
            $res = Http::put(env('APP_API_URL').'/kapal/'.$id, $validated);
        }

        $res = Http::put(env('APP_API_URL').'/kapal/'.$id ,$validated);
        if($res->successful()) {
            $json = $res->json();
            return redirect('/admin/boats')->with('message', 'Data berhasil di update');
        }

    }

    public function deleteKapal($id)
    {

        $res = Http::delete(url: env('APP_API_URL').'/kapal/'.$id);
        $json = $res->json();
        if($res->successful()) {

            $data['kapal'] = collect($json)->sortBy('nama_kapal');

            return redirect('/admin/boats')->with('message', $json['message']);
        } else {
            return redirect()->back()->with('message', $json['message']);
        }

    }

}

// tambah else error
