<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
        <select name="status"
            class="w-full border @error('status') border-red-400 @else border-gray-300 @enderror rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300">
            <option value="">-- Pilih Status --</option>
            <option value="Approve" {{ old('status', $pol->status ?? '') === 'Approve' ? 'selected' : '' }}>Approve</option>
            <option value="Reject" {{ old('status', $pol->status ?? '') === 'Reject' ? 'selected' : '' }}>Reject</option>
        </select>
        @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Booking Date <span class="text-red-500">*</span></label>
        <input type="date" name="booking_date"
            value="{{ old('booking_date', isset($pol) ? $pol->booking_date?->format('Y-m-d') : '') }}"
            class="w-full border @error('booking_date') border-red-400 @else border-gray-300 @enderror rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300">
        @error('booking_date') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Consignee <span class="text-red-500">*</span></label>
        <input type="text" name="consignee" value="{{ old('consignee', $pol->consignee ?? '') }}"
            placeholder="Nama penerima / perusahaan"
            class="w-full border @error('consignee') border-red-400 @else border-gray-300 @enderror rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300">
        @error('consignee') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Sales <span class="text-red-500">*</span></label>
        <input type="text" name="sales" value="{{ old('sales', $pol->sales ?? '') }}"
            placeholder="Nama sales"
            class="w-full border @error('sales') border-red-400 @else border-gray-300 @enderror rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300">
        @error('sales') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Origin <span class="text-red-500">*</span></label>
        <input type="text" name="kode_origin" value="{{ old('kode_origin', $pol->kode_origin ?? '') }}"
            placeholder="Contoh: JKT, SGP" maxlength="20"
            class="w-full border @error('kode_origin') border-red-400 @else border-gray-300 @enderror rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300 uppercase">
        @error('kode_origin') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Origin <span class="text-red-500">*</span></label>
        <input type="text" name="origin" value="{{ old('origin', $pol->origin ?? '') }}"
            placeholder="Nama daerah / negara asal"
            class="w-full border @error('origin') border-red-400 @else border-gray-300 @enderror rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-300">
        @error('origin') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

</div>
