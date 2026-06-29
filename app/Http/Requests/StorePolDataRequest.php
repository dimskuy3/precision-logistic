<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePolDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'status'       => ['required', 'in:Approve,Reject'],
            'booking_date' => ['required', 'date'],
            'consignee'    => ['required', 'string', 'max:255'],
            'sales'        => ['required', 'string', 'max:255'],
            'kode_origin'  => ['required', 'string', 'max:20'],
            'origin'       => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required'       => 'Status wajib dipilih.',
            'status.in'             => 'Status harus Approve atau Reject.',
            'booking_date.required' => 'Booking Date wajib diisi.',
            'booking_date.date'     => 'Format tanggal tidak valid.',
            'consignee.required'    => 'Consignee wajib diisi.',
            'sales.required'        => 'Sales wajib diisi.',
            'kode_origin.required'  => 'Kode Origin wajib diisi.',
            'origin.required'       => 'Origin wajib diisi.',
        ];
    }
}
