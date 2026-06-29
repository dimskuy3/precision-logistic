@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 text-sm">Selamat datang di Sistem Monitoring POL</p>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-700 px-8 py-6">
            <div class="flex items-center space-x-5">
                <div class="bg-white rounded-full p-3">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="text-white">
                    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-blue-200">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="px-8 py-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-500 uppercase font-medium mb-1">Nama Lengkap</p>
                    <p class="text-gray-800 font-semibold">{{ $user->name }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-500 uppercase font-medium mb-1">Email</p>
                    <p class="text-gray-800 font-semibold">{{ $user->email }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-500 uppercase font-medium mb-1">Role</p>
                    @if($user->isAdmin())
                        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                            Admin
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                            Sales
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        @if($user->isAdmin())
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-400">
            <h3 class="font-bold text-gray-700 mb-2">Hak Akses Anda (Admin)</h3>
            <ul class="text-sm text-gray-600 space-y-1">
                <li>✅ Upload Data Excel ke sistem</li>
                <li>✅ Melihat seluruh data Tabel POL</li>
                <li>✅ Menambah, Edit, dan Hapus data POL</li>
                <li>✅ Filter data multi-kriteria</li>
            </ul>
        </div>
        @else
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-400">
            <h3 class="font-bold text-gray-700 mb-2">Hak Akses Anda (Sales)</h3>
            <ul class="text-sm text-gray-600 space-y-1">
                <li>✅ Melihat seluruh data Tabel POL</li>
                <li>✅ Filter data multi-kriteria</li>
                <li>🔒 Upload Data (hanya Admin)</li>
                <li>🔒 Edit / Hapus data (hanya Admin)</li>
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-400">
            <h3 class="font-bold text-gray-700 mb-3">Akses Cepat</h3>
            <div class="flex flex-col space-y-2">
                <a href="{{ route('pol.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg text-center transition-colors">
                    Buka Tabel POL
                </a>
                @if($user->isAdmin())
                <a href="{{ route('upload.index') }}"
                    class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg text-center transition-colors">
                    Upload Data Excel
                </a>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
