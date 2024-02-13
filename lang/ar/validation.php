<?php 

return [
    'accepted' => 'يجب قبول :attribute',
    'active_url' => ':attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي :attribute سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي :attribute على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون :attribute ًمصفوفة',
    'before' => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date' => ':attribute ليس تاريخًا صحيحًا',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'لا يتوافق :attribute مع الشكل :format.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام ',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'exists' => 'القيمة المحددة :attribute غير موجودة',
    'file' => 'الـ :attribute يجب أن يكون ملفا.',
    'filled' => ':attribute إجباري',
    'image' => 'يجب أن يكون :attribute صورةً',
    'in' => ':attribute لاغٍ',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'max' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر لـ :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'min' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر لـ :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in' => ':attribute لاغٍ',
    'numeric' => 'يجب على :attribute أن يكون رقمًا',
    'present' => 'يجب تقديم :attribute',
    'regex' => 'صيغة :attribute .غير صحيحة',
    'required' => ':attribute مطلوب.',
    'required_if' => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless' => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all' => ':attribute مطلوب إذا توفّر :values.',
    'required_without' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other',
    'size' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالظبط',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'يجب أن يكون :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة :attribute مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'url' => 'صيغة الرابط :attribute غير صحيحة',
    'required_package_id' => 'You have to select a premium listing option to continue.',
    'required_payment_method_id' => 'You have to select a payment method to continue.',
    'blacklist_unique' => 'The :attribute field value is already banned for :type.',
    'blacklist_email_rule' => 'عنوان البريد الإلكتروني هذا مدرج في القائمة السوداء.',
    'blacklist_phone_rule' => 'رقم الهاتف هذا مدرج في القائمة السوداء.',
    'blacklist_domain_rule' => 'نطاق عنوان بريدك الإلكتروني مدرج في القائمة السوداء.',
    'blacklist_word_rule' => 'The :attribute contains a banned words or phrases.',
    'blacklist_title_rule' => 'The :attribute contains a banned words or phrases.',
    'between_rule' => 'The :attribute must be between :min and :max characters.',
    'captcha' => 'The :attribute field is not correct.',
    'recaptcha' => 'The :attribute field is not correct.',
    'phone' => 'The :attribute field contains an invalid number.',
    'phone_number' => 'رقم هاتفك غير صالح.',
    'username_is_valid_rule' => 'The :attribute field must be an alphanumeric string.',
    'username_is_allowed_rule' => 'The :attribute is not allowed.',
    'custom' => [
        'database_connection' => [
            'required' => 'لا يمكن الاتصال بخادم ميسكل',
        ],
        'database_not_empty' => [
            'required' => 'قاعدة البيانات ليست فارغة. يرجى إفراغ قاعدة البيانات أو التحديد <a href="./database">قاعدة بيانات أخرى</a>.',
        ],
        'promo_code_not_valid' => [
            'required' => 'الرمز الترويجي غير صالح',
        ],
        'smtp_valid' => [
            'required' => 'لا يمكن الاتصال بخادم سمتب',
        ],
        'yaml_parse_error' => [
            'required' => 'لا يمكن تحليل يمل. الرجاء التحقق من بناء الجملة',
        ],
        'file_not_found' => [
            'required' => 'لم يتم العثور على الملف.',
        ],
        'not_zip_archive' => [
            'required' => 'الملف ليس حزمة زيب.',
        ],
        'zip_archive_unvalid' => [
            'required' => 'لا يمكن قراءة الحزمة.',
        ],
        'custom_criteria_empty' => [
            'required' => 'لا يمكن أن تكون المعايير المخصصة فارغة',
        ],
        'php_bin_path_invalid' => [
            'required' => 'فب غير صالح للتنفيذ. يرجى التحقق مرة أخرى.',
        ],
        'can_not_empty_database' => [
            'required' => 'لا يمكن دروب جداول معينة، يرجى تنظيف قاعدة البيانات الخاصة بك يدويا وحاول مرة أخرى.',
        ],
        'can_not_create_database_tables' => [
            'required' => 'Cannot create certain tables. Please make sure you have full privileges on the database and try again.',
        ],
        'can_not_import_database_data' => [
            'required' => 'Cannot import all the app required data. Please try again.',
        ],
        'recaptcha_invalid' => [
            'required' => 'فحص ريكابتشا غير صالح.',
        ],
        'payment_method_not_valid' => [
            'required' => 'حدث خطأ ما في إعداد طريقة الدفع. يرجى التحقق مرة أخرى.',
        ],
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'attributes' => [
        'gender' => 'جنس',
        'gender_id' => 'جنس',
        'name' => 'اسم',
        'first_name' => 'الاسم الاول',
        'last_name' => 'الكنية',
        'user_type' => 'نوع المستخدم',
        'user_type_id' => 'نوع المستخدم',
        'country' => 'بلد',
        'country_code' => 'بلد',
        'phone' => 'هاتف',
        'address' => 'عنوان',
        'mobile' => 'التليفون المحمول',
        'sex' => 'جنس',
        'year' => 'عام',
        'month' => 'شهر',
        'day' => 'يوم',
        'hour' => 'ساعة',
        'minute' => 'اللحظة',
        'second' => 'ثانيا',
        'username' => 'اسم المستخدم',
        'email' => 'عنوان البريد الإلكتروني',
        'password' => 'كلمه السر',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'g-recaptcha-response' => 'كلمة التحقق',
        'accept_terms' => 'شروط',
        'category' => 'الفئة',
        'category_id' => 'الفئة',
        'post_type' => 'نوع آخر',
        'post_type_id' => 'نوع آخر',
        'title' => 'عنوان',
        'body' => 'الجسم',
        'description' => 'وصف',
        'excerpt' => 'مقتطفات',
        'date' => 'تاريخ',
        'time' => 'زمن',
        'available' => 'متاح',
        'size' => 'بحجم',
        'price' => 'السعر',
        'salary' => 'راتب',
        'contact_name' => 'اسم',
        'location' => 'موقعك',
        'admin_code' => 'موقعك',
        'city' => 'مدينة',
        'city_id' => 'مدينة',
        'package' => 'صفقة',
        'package_id' => 'صفقة',
        'payment_method' => 'طريقة الدفع او السداد',
        'payment_method_id' => 'طريقة الدفع او السداد',
        'sender_name' => 'اسم',
        'subject' => 'موضوع',
        'message' => 'رسالة',
        'report_type' => 'نوع التقرير',
        'report_type_id' => 'نوع التقرير',
        'file' => 'ملف',
        'filename' => 'اسم الملف',
        'picture' => 'صورة',
        'resume' => 'استئنف',
        'login' => 'تسجيل الدخول',
        'code' => 'الشفرة',
        'token' => 'رمز',
        'comment' => 'تعليق',
        'rating' => 'تقييم',
        'captcha' => 'رمز الحماية',
        'locale' => 'locale',
        'currencies' => 'currencies',
        'tags' => 'Tags',
        'from_name' => 'name',
        'from_email' => 'email',
        'from_phone' => 'phone',
    ],
    'not_regex' => 'The :attribute format is invalid.',
    'locale_of_language_rule' => 'The :attribute field is not valid.',
    'locale_of_country_rule' => 'The :attribute field is not valid.',
    'currencies_codes_are_valid_rule' => 'The :attribute field is not valid.',
    'blacklist_ip_rule' => 'The :attribute must be a valid IP address.',
    'custom_field_unique_rule' => 'The :field_1 have this :field_2 assigned already.',
    'custom_field_unique_rule_field' => 'The :field_1 is already assigned to this :field_2.',
    'custom_field_unique_children_rule' => 'A child :field_1 of the :field_1 have this :field_2 assigned already.',
    'custom_field_unique_children_rule_field' => 'The :field_1 is already assign to one :field_2 of this :field_2.',
    'custom_field_unique_parent_rule' => 'The parent :field_1 of the :field_1 have this :field_2 assigned already.',
    'custom_field_unique_parent_rule_field' => 'The :field_1 is already assign to the parent :field_2 of this :field_2.',
    'mb_alphanumeric_rule' => 'Please enter a valid content in the :attribute field.',
    'date_is_valid_rule' => 'The :attribute field does not contain a valid date.',
    'date_future_is_valid_rule' => 'The date of :attribute field need to be in the future.',
    'date_past_is_valid_rule' => 'The date of :attribute field need to be in the past.',
    'video_link_is_valid_rule' => 'The :attribute field does not contain a valid (Youtube or Vimeo) video link.',
    'sluggable_rule' => 'The :attribute field contains invalid characters only.',
    'uniqueness_of_listing_rule' => 'لقد قمت بالفعل بنشر هذا الإعلان. لا يمكن تكراره.',
    'uniqueness_of_unverified_listing_rule' => 'لقد قمت بالفعل بنشر هذا الإعلان. يرجى التحقق من عنوان بريدك الإلكتروني أو الرسائل القصيرة لاتباع تعليمات التحقق من الصحة.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'password' => [
        'letters' => 'يجب أن تحتوي :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن تحتوي :attribute على الأقل على حرف كبير واحد وحرف صغير واحد.',
        'numbers' => 'يجب أن تحتوي :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن تحتوي :attribute على رمز واحد على الأقل.',
        'uncompromised' => 'ظهرت :attribute المحددة في تسرب بيانات. الرجاء اختيار :attribute مختلفة.',
    ],
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'can' => 'The :attribute field contains an unauthorized value.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'ulid' => 'The :attribute field must be a valid ULID.',
];
