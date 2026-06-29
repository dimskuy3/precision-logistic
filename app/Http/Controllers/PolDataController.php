<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePolDataRequest;
use App\Http\Requests\UpdatePolDataRequest;
use App\Models\PolData;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PolDataController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', PolData::class);

        $filters = $request->only(['status', 'consignee', 'sales', 'kode_origin', 'origin']);

        $polData = PolData::filter($filters)
            ->orderBy('booking_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $salesList      = PolData::select('sales')->distinct()->whereNotNull('sales')->pluck('sales');
        $consigneeList  = PolData::select('consignee')->distinct()->whereNotNull('consignee')->pluck('consignee');
        $kodeOriginList = PolData::select('kode_origin')->distinct()->whereNotNull('kode_origin')->pluck('kode_origin');
        $originList     = PolData::select('origin')->distinct()->whereNotNull('origin')->pluck('origin');

        return view('pol.index', compact(
            'polData', 'filters',
            'salesList', 'consigneeList', 'kodeOriginList', 'originList'
        ));
    }

    public function create()
    {
        $this->authorize('create', PolData::class);
        return view('pol.create');
    }

    public function store(StorePolDataRequest $request)
    {
        PolData::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->id()]
        ));

        return redirect()->route('pol.index')
            ->with('success', 'Data POL berhasil ditambahkan.');
    }

    public function edit(PolData $pol)
    {
        $this->authorize('update', $pol);
        return view('pol.edit', compact('pol'));
    }

    public function update(UpdatePolDataRequest $request, PolData $pol)
    {
        $pol->update($request->validated());

        return redirect()->route('pol.index')
            ->with('success', 'Data POL berhasil diperbarui.');
    }

    public function destroy(PolData $pol)
    {
        $this->authorize('delete', $pol);
        $pol->delete();

        return redirect()->route('pol.index')
            ->with('success', 'Data POL berhasil dihapus.');
    }
}
