@extends('layouts.app')
@section('title', 'Tabel POL')

@section('content')
<div class="space-y-5">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tabel POL</h1>
            <p class="text-gray-500 text-sm">Data ekspor-impor PT. Precision Logistic</p>
        </div>
        @can('create', App\Models\PolData::class)
        <a href="{{ route('pol.create') }}"
            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm">
            + Tambah Data
        </a>
        @endcan
    </div>

    <div class="bg-white rounded-2xl shadow-md p-5">
        <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">Filter Data</h2>
        <form method="GET" action="{{ route('pol.index') }}">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                    <select name="status" onchange="this.form.submit()"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-300 outline-none">
                        <option value="">Semua</option>
                        <option value="Approve" {{ ($filters['status'] ?? '') === 'Approve' ? 'selected' : '' }}>Approve</option>
                        <option value="Reject" {{ ($filters['status'] ?? '') === 'Reject' ? 'selected' : '' }}>Reject</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Consignee</label>
                    <select name="consignee" onchange="this.form.submit()"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-300 outline-none">
                        <option value="">Semua</option>
                        @foreach($consigneeList as $c)
                            <option value="{{ $c }}" {{ ($filters['consignee'] ?? '') === $c ? 'selected' : '' }}>
                                {{ Str::limit($c, 25) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Sales</label>
                    <select name="sales" onchange="this.form.submit()"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-300 outline-none">
                        <option value="">Semua</option>
                        @foreach($salesList as $s)
                            <option value="{{ $s }}" {{ ($filters['sales'] ?? '') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Kode Origin</label>
                    <select name="kode_origin" onchange="this.form.submit()"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-300 outline-none">
                        <option value="">Semua</option>
                        @foreach($kodeOriginList as $k)
                            <option value="{{ $k }}" {{ ($filters['kode_origin'] ?? '') === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Origin</label>
                    <select name="origin" onchange="this.form.submit()"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-300 outline-none">
                        <option value="">Semua</option>
                        @foreach($originList as $o)
                            <option value="{{ $o }}" {{ ($filters['origin'] ?? '') === $o ? 'selected' : '' }}>
                                {{ Str::limit($o, 20) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    @if(array_filter($filters))
                    <a href="{{ route('pol.index') }}"
                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-3 py-2 rounded-lg text-center transition-colors">
                        Reset Filter
                    </a>
                    @endif
                </div>

            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Booking Date</th>
                        <th class="px-4 py-3 text-left">Consignee</th>
                        <th class="px-4 py-3 text-left">Sales</th>
                        <th class="px-4 py-3 text-left">Kode Origin</th>
                        <th class="px-4 py-3 text-left">Origin</th>
                        @can('update', App\Models\PolData::class)
                        <th class="px-4 py-3 text-center">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($polData as $row)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="px-4 py-3 text-gray-400 text-xs">
                            {{ ($polData->currentPage() - 1) * $polData->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-3">
                            @if($row->status === 'Approve')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">Approve</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">Reject</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-700">
                            {{ $row->booking_date ? $row->booking_date->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-gray-700 font-medium">{{ $row->consignee ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $row->sales ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="bg-gray-100 text-gray-700 text-xs font-mono font-bold px-2 py-1 rounded">
                                {{ $row->kode_origin ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $row->origin ?? '-' }}</td>
                        @can('update', App\Models\PolData::class)
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('pol.edit', $row) }}"
                                    class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('pol.destroy', $row) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endcan
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-12 text-center text-gray-400">
                            <p class="font-medium">Belum ada data</p>
                            <p class="text-sm mt-1">Upload Excel atau tambah data manual</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($polData->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-500">
                    Menampilkan {{ $polData->firstItem() }}-{{ $polData->lastItem() }} dari {{ $polData->total() }} data
                </p>
                {{ $polData->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
