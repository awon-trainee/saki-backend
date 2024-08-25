<?php

namespace App\Exports;

use App\Models\Beneficiaries;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BeneficiariesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (checkRolesAndPermission(User::ROLE_CHARITY)) {
            $beneficiaries = backpack_user()->beneficiaries;
        } else {
            $beneficiaries = Beneficiaries::all();
        }

        $beneficiaries->load('nationality');
        return $beneficiaries;
    }

    public function map($beneficiary): array
    {
        return [
            $beneficiary->id_number,
            $beneficiary->name,
            $beneficiary->email,
            $beneficiary->phone,
            $beneficiary->nationality->nationality_ar,
            $beneficiary->translatedGender(),
            $beneficiary->translatedMaterialStatus(),
            $beneficiary->monthly_income,
            $beneficiary->income_source,
        ];
    }


    public function headings(): array
    {
        return [
            'رقم الهوية',
            'الاسم',
            'البريد الالكتروني',
            'رقم الهاتف',
            'الجنسية',
            'النوع',
            'الحالة الاجتماعية',
            'الدخل الشهري',
            'مصدر الدخل',
        ];
    }
}
