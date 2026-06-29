@extends('layouts.app')
@section('title', 'Upload Data')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Upload Data Excel</h1>
        <p class="text-gray-500 text-sm">Impor data POL dari file Excel ke sistem</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Upload File Excel</h2>
            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition-colors cursor-pointer"
                    onclick="document.getElementById('fileInput').click()">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p class="text-gray-600 font-medium mb-1">Klik untuk pilih file</p>
                    <p class="text-gray-400 text-sm">Format: .xlsx atau .xls (Maks. 10MB)</p>
                    <input type="file" id="fileInput" name="file" accept=".xlsx,.xls" class="hidden"
                        onchange="showFileName(this)">
                </div>

                <div id="fileName" class="hidden mt-3 bg-blue-50 border border-blue-200 rounded-lg px-4 py-2 text-sm text-blue-700"></div>

                @error('file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                    Upload & Import Data
                </button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Format Kolom Excel</h2>
            <p class="text-sm text-gray-500 mb-3">Baris pertama harus berupa header dengan nama kolom berikut:</p>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-200 px-3 py-2 text-left text-gray-600">Nama Kolom</th>
                            <th class="border border-gray-200 px-3 py-2 text-left text-gray-600">Contoh Isi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([
                            ['status', 'Approve / Reject'],
                            ['booking_date', '2024-01-15'],
                            ['consignee', 'PT. ABC Indonesia'],
                            ['sales', 'Budi Santoso'],
                            ['kode_origin', 'JKT'],
                            ['origin', 'Jakarta, Indonesia'],
                        ] as [$col, $ex])
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-200 px-3 py-2">
                                <code class="bg-yellow-100 text-yellow-800 px-1 rounded text-xs">{{ $col }}</code>
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-gray-500">{{ $ex }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 bg-amber-50 border border-amber-200 rounded-lg p-3 text-xs text-amber-700">
                Nama header kolom harus persis sama (huruf kecil, tanpa spasi).
            </div>
        </div>

    </div>
</div>

<script>
function showFileName(input) {
    const el = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        el.classList.remove('hidden');
        el.textContent = 'File terpilih: ' + input.files[0].name;
    }
}
</script>
@endsection
