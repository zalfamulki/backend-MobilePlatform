<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function getMatkul()
    {
        return response()->json(Matkul::all());
    }

    public function storeMatkul(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:matkuls',
            'nama' => 'required',
            'jurusan' => 'nullable',
            'hari' => 'nullable',
            'jam_mulai' => 'nullable',
            'jam_selesai' => 'nullable',
            'ruangan' => 'nullable',
        ]);

        $matkul = Matkul::create($validated);
        return response()->json($matkul, 201);
    }

    public function updateMatkul(Request $request, $id)
    {
        $matkul = Matkul::findOrFail($id);
        $validated = $request->validate([
            'kode' => 'required|unique:matkuls,kode,' . $id,
            'nama' => 'required',
            'jurusan' => 'nullable',
            'hari' => 'nullable',
            'jam_mulai' => 'nullable',
            'jam_selesai' => 'nullable',
            'ruangan' => 'nullable',
        ]);

        $matkul->update($validated);
        return response()->json($matkul);
    }

    public function destroyMatkul($id)
    {
        Matkul::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function getMahasiswa()
    {
        return response()->json(Mahasiswa::all());
    }

    public function storeMahasiswa(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'email' => 'nullable|email',
            'jurusan' => 'nullable',
        ]);

        $mahasiswa = Mahasiswa::create($validated);
        return response()->json($mahasiswa, 201);
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'nama' => 'required',
            'email' => 'nullable|email',
            'jurusan' => 'nullable',
        ]);

        $mahasiswa->update($validated);
        return response()->json($mahasiswa);
    }

    public function destroyMahasiswa($id)
    {
        Mahasiswa::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function getGradeByMahasiswa($userId)
    {
        $mahasiswa = Mahasiswa::where('user_id', $userId)->first();
        
        if (!$mahasiswa) {
            return response()->json([], 200);
        }

        $grades = Grade::with('matkul')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get();

        return response()->json($grades);
    }

    public function storeGrade(Request $request)
    {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'matkul_id' => 'required|exists:matkuls,id',
            'nilai' => 'required',
        ]);

        $grade = Grade::create($validated);
        return response()->json($grade->load('matkul'), 201);
    }

    public function updateGrade(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'matkul_id' => 'required|exists:matkuls,id',
            'nilai' => 'required',
        ]);

        $grade->update($validated);
        return response()->json($grade->load('matkul'));
    }

    public function destroyGrade($id)
    {
        Grade::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function getSchedule()
    {
        return response()->json(Matkul::whereNotNull('hari')->get());
    }
}
