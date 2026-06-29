@extends('layouts.app')
@section('title', 'Tambah Data POL')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Data POL</h1>
        <p class="text-gray-500 text-sm">Isi formulir untuk menambahkan data baru</p>
    </div>
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="{{ route('pol.store') }}" method="POST">
            @csrf
            @include('pol._form')
            <div class="flex items-center justify-end space-x-3 mt-6 pt-5 border-t border-gray-100">
                <a href="{{ route('pol.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-5 py-2.5 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
