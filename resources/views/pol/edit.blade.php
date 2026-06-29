@extends('layouts.app')
@section('title', 'Edit Data POL')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Edit Data POL</h1>
        <p class="text-gray-500 text-sm">Perbarui informasi data POL</p>
    </div>
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="{{ route('pol.update', $pol) }}" method="POST">
            @csrf
            @method('PUT')
            @include('pol._form', ['pol' => $pol])
            <div class="flex items-center justify-end space-x-3 mt-6 pt-5 border-t border-gray-100">
                <a href="{{ route('pol.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-5 py-2.5 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
