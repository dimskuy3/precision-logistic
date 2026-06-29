<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadExcelRequest;
use App\Imports\PolDataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload.index');
    }

    public function store(UploadExcelRequest $request)
    {
        try {
            $import = new PolDataImport();
            Excel::import($import, $request->file('file'));

            $count = $import->getImportedCount();

            return redirect()->route('upload.index')
                ->with('success', "Berhasil mengimpor {$count} data dari file Excel.");

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = collect($failures)->map(fn($f) => "Baris {$f->row()}: {$f->errors()[0]}")->join(', ');
            return back()->with('error', "Gagal import: {$errors}");

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses file. Pastikan format kolom sesuai template.');
        }
    }
}
