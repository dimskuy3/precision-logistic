<?php

namespace App\Imports;

use App\Models\PolData;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class PolDataImport implements ToCollection, WithHeadingRow
{
    private int $importedCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['consignee']) && empty($row['sales'])) {
                continue;
            }

            $bookingDate = null;
            if (!empty($row['booking_date'])) {
                try {
                    if (is_numeric($row['booking_date'])) {
                        $bookingDate = Carbon::instance(
                            \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['booking_date'])
                        )->toDateString();
                    } else {
                        $bookingDate = Carbon::parse($row['booking_date'])->toDateString();
                    }
                } catch (\Exception $e) {
                    $bookingDate = null;
                }
            }

            PolData::create([
                'status'       => in_array($row['status'] ?? '', ['Approve', 'Reject']) ? $row['status'] : 'Approve',
                'booking_date' => $bookingDate,
                'consignee'    => $row['consignee'] ?? null,
                'sales'        => $row['sales'] ?? null,
                'kode_origin'  => $row['kode_origin'] ?? null,
                'origin'       => $row['origin'] ?? null,
                'created_by'   => auth()->id(),
            ]);

            $this->importedCount++;
        }
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }
}
