<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
    'active_url' => 'حقل :attribute ليس عنوان URL صحيح.',
    'after' => 'يجب أن يكون :attribute تاريخًا بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخًا بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'before' => 'يجب أن يكون :attribute تاريخًا قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي :date.',
    'between' => [
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'file' => 'يجب أن يكون :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون :attribute بين :min و :max حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على بين :min و :max عنصرًا.',
    ],
    'boolean' => 'يجب أن يكون حقل :attribute صحيحًا أو خاطئًا.',
    'confirmed' => 'حقل التأكيد غير متطابق مع :attribute.',
    'date' => 'حقل :attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون :attribute تاريخًا مساويًا لـ :date.',
    'date_format' => 'لا يتوافق حقل :attribute مع التنسيق :format.',
    'different' => 'يجب أن يكون حقل :attribute مختلفًا عن حقل :other.',
    'digits' => 'يجب أن يحتوي :attribute على :digits أرقام.',
    'digits_between' => 'يجب أن يكون :attribute بين :min و :max أرقام.',
    'dimensions' => 'حقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email' => ':attribute غير صالح.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'exists' => 'القيمة المحددة في حقل :attribute غير صحيحة.',
    'file' => 'يجب أن يكون :attribute ملفًا.',
    'filled' => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt' => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'file' => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'string' => 'يجب أن يحتوي :attribute على أكثر من :value حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصرًا.',
    ],
    'gte' => [
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'file' => 'يجب أن يكون :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يحتوي :attribute على :value حرفًا أو أكثر.',
        'array' => 'يجب أن يحتوي :attribute على :value عنصرًا أو أكثر.',
    ],
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => 'القيمة المحددة في حقل :attribute غير صحيحة.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute سلسلة JSON صحيحة.',
    'lt' => [
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'file' => 'يجب أن يكون :attribute أقل من :value كيلوبايت.',
        'string' => 'يجب أن يحتوي :attribute على أقل من :value حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عنصرًا.',
    ],
    'lte' => [
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'file' => 'يجب أن يكون :attribute أقل من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يحتوي :attribute على :value حرفًا أو أقل.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :value عنصرًا.',
    ],
    'max' => [
        'numeric' => 'قيمة :attribute قد لا تكون أكبر من :max.',
        'file' => 'يجب أن لا يكون حجم :attribute أكبر من :max كيلوبايت.',
        'string' => 'يجب أن لا يحتوي :attribute على أكثر من :max حرفًا.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عنصرًا.',
    ],
    'mimes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
    'min' => [
        'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
        'file' => 'يجب أن يكون حجم :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يحتوي :attribute على الأقل على :min أحرف.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عنصرًا.',
    ],
    'not_in' => 'القيمة المحددة في حقل :attribute غير صحيحة.',
    'not_regex' => 'تنسيق :attribute غير صحيح.',
    'numeric' => 'يجب أن يكون :attribute رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب تقديم حقل :attribute.',
    'regex' => 'تنسيق :attribute غير صحيح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_if' => 'حقل :attribute مطلوب عندما :other هو :value.',
    'required_unless' => 'حقل :attribute مطلوب ما لم :other يكون في :values.',
    'required_with' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_with_all' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_without' => 'حقل :attribute مطلوب عند عدم وجود :values.',
    'required_without_all' => 'حقل :attribute مطلوب عند عدم وجود أيٍ من :values.',
    'same' => 'يجب أن يتطابق حقل :attribute مع :other.',
    'size' => [
        'numeric' => 'يجب أن يكون :attribute بحجم :size.',
        'file' => 'يجب أن يكون حجم :attribute بحجم :size كيلوبايت.',
        'string' => 'يجب أن يحتوي :attribute على :size حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرًا.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون :attribute سلسلة نصية.',
    'timezone' => 'يجب أن يكون :attribute منطقة صحيحة.',
    'unique' => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'url' => 'تنسيق :attribute غير صحيح.',
    'uuid' => 'يجب أن يكون :attribute UUID صحيح.',
    'prohibited' => 'حقل :attribute محظور.',
    'prohibited_if' => 'حقل :attribute محظور عندما :other هو :value.',
    'prohibited_unless' => 'حقل :attribute محظور ما لم :other يكون في :values.',

    'charity_name_required_if' => 'اسم الجمعية مطلوب عندما يكون النوع جمعية.',
    'charity_name_prohibited_if' => 'اسم الجمعية ممنوع عندما لا يكون النوع جمعية.',
    'phone' => 'رقم الهاتف غير صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'username' => 'اسم المستخدم',
        'title' => 'العنوان',
        'content' => 'المحتوى',
        'description' => 'الوصف',
        'excerpt' => 'الملخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'متاح',
        'size' => 'الحجم',
        'image' => 'الصورة',
        'file' => 'الملف',
        'phone' => 'الهاتف',
        'address' => 'العنوان',
        'city' => 'المدينة',
        'country' => 'البلد',
        'postcode' => 'الرمز البريدي',
        'gender' => 'النوع',
        'age' => 'العمر',
        'dob' => 'تاريخ الميلاد',
        'terms' => 'الشروط',
        'amount' => 'المبلغ',
        'from_name' => 'اسم المحول',
        'receipt' => 'الإيصال',
        'monthly_income' => 'الدخل الشهري',
        'income_source' => 'مصدر الدخل',
        'user' => 'المستخدم',
        'name_en' => 'الاسم بالإنجليزية',
        'name_ar' => 'الاسم بالعربية',
        'nationality_en' => 'الجنسية بالإنجليزية',
        'nationality_ar' => 'الجنسية بالعربية',
        'code' => 'الرمز',
        'nationality' => 'الجنسية',
        'material_status' => 'الحالة الاجتماعية',
        'categories' => 'الفئات',
        'import_file' => 'ملف الاستيراد',
        'nationality_id' => 'الجنسية',
        'id_number' => 'رقم الهوية',
        'resal_product_id' => 'المنتج',
    ],

];