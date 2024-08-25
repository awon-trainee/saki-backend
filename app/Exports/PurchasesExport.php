<?php

namespace App\Exports;

use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchasesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Purchase::with([
            'beneficiary',
            'item',
            'item.resalProduct'
        ])->get();
    }

    public function map($purchase): array
    {
        return [
            $purchase->beneficiary->id_number,
            $purchase->beneficiary->name,
            $purchase->amount,
            $purchase->item->price_with_vat,
            $purchase->status == 'completed' ? 'مكتمل' : $purchase->status,
            $purchase->resal_order_id,
            $purchase->item->resalProduct->title,
            $purchase->item->value,
        ];
    }

    public function headings(): array
    {
        return [
            'رقم الهوية',
            'الاسم',
            'المبلغ',
            'المبلغ مع الضريبة',
            'الحالة',
            'رقم الطلب',
            'المنتج',
            'القيمة',
        ];
    }
}
