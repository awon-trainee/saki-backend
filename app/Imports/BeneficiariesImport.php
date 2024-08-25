<?php

namespace App\Imports;

use App\Http\Requests\BeneficiariesRequest;
use App\Models\Beneficiaries;
use App\Models\Country;
use Doctrine\DBAL\Exception\DatabaseDoesNotExist;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Propaganistas\LaravelPhone\PhoneNumber;

class BeneficiariesImport implements ToModel, WithBatchInserts
{

    use Importable;

    public $successful_count = 0;
    public $row_count = 0;
    public $custom_failures = [];
    public $user_id;

    public function __construct($_user_id)
    {
        $this->user_id = $_user_id;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $this->row_count++;
        $row = array_map('trim', $row);

        $id_number            = $row[0];
        $name                   = $row[1];
        $email                  = $row[2];
        $phone                  = $row[3];
        $nationality_code       = empty($row[4]) ? Country::query()->first()->code : $row[4];
        $gender                 = empty($row[5]) ? null : strtolower($row[5]);
        $material_status        = empty($row[6]) ? null : strtolower($row[6]);
        $monthly_income         = empty($row[7]) ? null : $row[7];
        $income_source          = empty($row[8]) ? null : $row[8];

        if (empty($id_number) && empty($name) && empty($email) && empty($phone)) {
            return null;
        }

        if (!empty($gender)) {
            $gender = str_replace(['ا', 'أ', 'إ', 'آ'], 'ا', $gender);
            $gender = str_replace(['ة', 'ه'], 'ه', $gender);
            $gender = strtolower($gender); // Convert to lowercase for case-insensitive comparison
            switch ($gender) {
                case 'male':
                case 'm':
                case 'man':
                case 'boy':
                case 'ذكر':
                case 'رجل':
                case 'ولد':
                    $gender = 'male';
                    break;
                case 'female':
                case 'f':
                case 'woman':
                case 'girl':
                case 'انثى':
                case 'فتاه':
                case 'بنت':
                    $gender = 'female';
                    break;
            }
        }
        
        if (!empty($material_status)) {
            $material_status = str_replace(['ا', 'أ', 'إ', 'آ'], 'ا', $material_status);
            $material_status = str_replace(['ة', 'ه'], 'ه', $material_status);
            switch ($material_status) {
                case 'single':
                case 'اعزب':
                case 'عازب':
                case 'عازبه':
                case 'unmarried':
                case 'bachelor':
                    $material_status = 'single';
                    break;
                case 'married':
                case 'متزوج':
                case 'متزوجه':
                case 'wedded':
                    $material_status = 'married';
                    break;
                case 'divorced':
                case 'مطلق':
                case 'مطلقه':
                case 'separated':
                case 'منفصل':
                case 'منفصله':
                    $material_status = 'divorced';
                    break;
                case 'widower':
                case 'ارمل':
                case 'ارمله':
                case 'bereaved':
                case 'widowed':
                    $material_status = 'widower';
                    break;
            }
        }
        
        $full_phone = null;
        try {
            $full_phone = (new PhoneNumber($phone, 'SA'))->formatE164();
        } catch (\Exception $e) {
            $full_phone = null;
        }

        $data = [
            'id_number'         => $id_number,
            'name'              => $name,
            'email'             => $email,
            'phone'             => $full_phone,
            'user_id'           => $this->user_id,
            'nationality_id'    => $nationality_code,
            'gender'            => $gender,
            'material_status'   => $material_status,
            'monthly_income'    => $monthly_income,
            'income_source'     => $income_source,
        ];


        $rules = (new BeneficiariesRequest())->rules();
        $rules['nationality_id'] = 'required|string|exists:countries,code';
        $rules['user_id'] = 'required|integer|exists:users,id';

        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules);
        
        if ($validator->fails()) {
            $this->custom_failures[] = [
                'errors' => $validator->errors()->toArray(),
                'row' => $this->row_count,
                'values' => $data,
            ];
            return null;
        }

        $data['nationality_id'] = Country::query()->where('code', $nationality_code)->first()->id ?? 1;
        $beneficiary = Beneficiaries::create($data);

        $beneficiary->balance()->create(['amount' => 0]);
        $beneficiary->categories()->attach($beneficiary->user->categories->pluck('id'));

        $this->successful_count++;
        return null;
    }
}