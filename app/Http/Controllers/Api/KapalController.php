<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KapalController extends Controller
{
    public function getKapal(Request $request)
    {
        $kapal = Kapal::all();
        return response()->json($kapal);

        // $status = $request->input('status');
        // $search = $request->input('search');

        // $query = Kapal::query();

        // if ($status && $status !== 'semua') {
        //     $query->where('status', $status);
        // }

        // if ($search) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('nama_kapal', 'like', "%$search%")->orWhere('id', 'like', "%$search%");
        //     });
        // }

        // $perPage = $request->input('per_page', 5);
        // return response()->json($query->paginate($perPage));
    }

    public function getKapalbyId(Kapal  $kapal)
    {
        return response()->json($kapal);
    }

    public function tambahKapal(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|size:5|unique:kapal',
            'nama_kapal' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto_kapal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:' . implode(',', Kapal::STATUSES),
        ]);

        // Handle file upload
        if ($request->hasFile('foto_kapal')) {
            $path = $request->file('foto_kapal')->store('public/images/kapal');
            $validated['foto_kapal'] = Storage::url($path);
        }

        $kapal = Kapal::create($validated);

        return response()->json(
            [
                'data' => $kapal,
            ],
            201,
        );
    }

    public function updateKapal(Request $request, string $id)
    {
        $kapal = Kapal::findOrFail($id);

        $validated = $request->validate([
            'nama_kapal' => 'sometimes|string|max:255',
            'kapasitas' => 'sometimes|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto_kapal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'sometimes|in:' . implode(',', Kapal::STATUSES),
        ]);

        // Handle file update
        if ($request->hasFile('foto_kapal')) {
            // Delete old image
            if ($kapal->foto_kapal) {
                Storage::delete(str_replace('/storage', 'public', $kapal->foto_kapal));
            }

            $path = $request->file('foto_kapal')->store('public/images/kapal');
            $validated['foto_kapal'] = Storage::url($path);
        }

        $kapal->update($validated);

        return response()->json(
            [
                'data' => $kapal,
            ],
            200,
        );
    }

    public function deleteKapal(string $id)
    {
        $kapal = Kapal::findOrFail($id);

        // Delete associated image
        if ($kapal->foto_kapal) {
            Storage::delete(str_replace('/storage', 'public', $kapal->foto_kapal));
        }

        $kapal->delete();

        return response()->json(
            [
                'message' => 'Kapal berhasil dihapus',
            ],
            204,
        );
    }
}
