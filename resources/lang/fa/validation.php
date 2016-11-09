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

		'captcha'			=> 'کد امنیتی اشتباه است.',
		'invalid'			=> 'درخواست معتبر نیست',
		'phone'             => ':attribute درست وارد نشده است.',
		'code_melli'        => ":attribute درست وارد نشده است.",
		'national_id'        => ":attribute درست وارد نشده است.",
		'postal_code'        => ":attribute درست وارد نشده است.",
		'sheba'             => ":attribute درست وارد نشده است.",

		"accepted"         => ":attribute باید پذیرفته شده باشد.",
		"active_url"       => "نشانی :attribute معتبر نیست",
		"after"            => ":attribute منطقی نیست." , ":attribute باید تاریخی بعد از :date باشد.",
		"alpha"            => ":attribute باید شامل حروف الفبا باشد.",
		"alpha_dash"       => ":attribute فقط می‌تواند شامل حروف الفبا و عدد و خط (underline یا dash) باشد.",
		"alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
		"array"            => ":attribute باید شامل آرایه باشد.",
		"before"           => ":attribute باید تاریخی قبل از :date باشد.",
		"between"          => array(
				"numeric" => ":attribute باید بین :min و :max باشد.",
				"file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
				"string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
				"array"   => ":attribute باید بین :min و :max آیتم باشد.",
		),
		"boolean"          => "The :attribute field must be true or false",
		"confirmed"        => ":attribute با تاییدیه مطابقت ندارد.",
		"date"             => ":attribute یک تاریخ معتبر نیست.",
//		"date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
		"date_format"      => ":attribute با الگوی تعریف‌شده مطاقبت ندارد.",
		"different"        => ":attribute و :other باید متفاوت باشند.",
		"digits"           => ":attribute باید :digits رقم باشد.",
		"digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
		"email"            => "قالب :attribute معتبر نیست.",
		"exists"           => ":attribute واردشده، معتبر نیست.",
		"image"            => ":attribute باید تصویر باشد.",
		"in"               => ":attribute معتبر نیست.",
		"integer"          => ":attribute باید نوع داده‌ای عددی (integer) باشد.",
		"ip"               => ":attribute باید آی‌پی نشانی معتبر باشد.",
		"max"              => [
				"numeric" => ":attribute نباید بزرگ‌تر از :max باشد.",
				"file"    => ":attribute نباید بزرگ‌تر از :max کیلوبایت باشد.",
				"string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
				"array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
		],
		"mimes"            => ":attribute باید یکی از قالب‌های :values باشد.",
		"min"              => array(
				"numeric" => ":attribute نباید کوچک‌تر از :max باشد.",
				"file"    => ":attribute نباید کوچک‌تر از :max کیلوبایت باشد.",
				"string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
				"array"   => ":attribute نباید کمتر از :max آیتم باشد.",
		),
		"not_in"           => ":attribute انتخاب شده، معتبر نیست.",
		"numeric"          => ":attribute باید به صورت عددی وارد شود.",
		"regex"            => ":attribute یک قالب معتبر نیست",
		"required"         => "وارد کردن «:attribute» الزامی است.",
		"required_if"      => "وارد کردن  «:attribute» الزامی است.",
		"required_with"    => ":attribute الزامی است زمانی که :values موجود است.",
		"required_with_all"=> ":attribute الزامی است زمانی که :values موجود است.",
		"required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
		"required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
		"same"             => ":attribute و :other باید مانند هم باشند.",
		"size"             => array(
				"numeric" => ":attribute باید برابر با :size باشد.",
				"file"    => ":attribute باید :size کیلوبایت باشد.",
				"string"  => ":attribute باید :size کاراکتر باشد.",
				"array"   => ":attribute باید شامل :size آیتم باشد.",
		),
		"timezone"         => "The :attribute must be a valid zone.",
		"unique"           => ":attribute تکراری است.",
		"url"              => "قالب نشانی :attribute اشتباه است.",
		"auth.fail"              => "شناسه‌ی کاربری یا گذرواژه اشتباه است.",
		"search"            => "جست‌وجو بی‌نتیجه بود.",
		"persian"			=> ":attribute را با حروف فارسی تکمیل نمایید.",
		"file_exists"        => "فایل :attribute وجود ندارد یا پاک شده است." ,

		'javascript_validation' => [
				"email"	=> "ایمیل را به درستی وارد نمایید.",
				"username" => "شناسه‌ی کاربری را به درستی وارد نمایید.",
				"security"	=> "کد امنیتی را با اعداد تکمیل نمایید.",
				"password"=> "گذرواژه را حداقل هشت کاراکتر وارد نمایید.",
				"password2"=> "تکرار رمز را به درستی وارد نمایید.",
				"birthday"=> "تاریخ تولد را به صورت صحیح وارد نمایید.",
				"name_first"=> "نام را با حروف فارسی وارد نمایید.",
				"name_last"=> "نام خانوادگی را با حروف فارسی وارد نمایید.",
				"name_father"=> "نام پدر را با حروف فارسی وارد نمایید.",
				"code_melli" => "کد ملی ده رقمی را وارد نمایید.",
				"code_id" => "شماره شناسنامه را وارد نمایید.",
				"gender"=> "جنسیت را انتخاب نمایید.",
				"birth_date" => "تاریخ تولد را به درستی وارد نمایید.",
				"birth_city" => "محل تولد را با حروف فارسی وارد نمایید.",
				"marital_status" => "وضعیت تأهل را انتخاب نمایید.",
				"occupation" => "شغل و تحصیلات را انتخاب نمایید." ,
				"education" => "تحصیلات انتخاب نمایید." ,
				"edu_level" => "میزان تحصیلات را انتخاب نمایید.",
				"edu_field" => "رشته‌ی تحصیلی را با حروف فارسی وارد نمایید." ,
				'edu_city' => 'محل تحصیل را با حروف فارسی وارد نمایید.',
				"tel_mobile" => 'تلفن همراه ۱۱ رقمی خود را وارد نمایید.',
				"tel_emergency" => 'تلفن اضطراری ۱۱ رقمی خود را وارد نمایید.' ,
				"home_city" => "محل سکونت را انتخاب نمایید.",
				"home_address" => "نشانی منزل را با حروف فارسی وارد نمایید.",
				"home_tel" => "تلفن منزل ۱۱ رقمی خود را وارد نمایید." ,
				"work_city" => "محل کار خود را انتخاب نمایید.",
				"work_address" => "نشانی محل کار خود را با حروف فارسی وارد نمایید.",
				"work_tel" => "تلفن محل کار ۱۱ رقمی خود را وارد نمایید." ,
				"job" => "شغل را با حروف فارسی وارد نمایید",
				"familization" => "نحوه‌ی آشنایی را انتخاب نمایید." ,
				"motivation" => "انگیزه‌ی همکاری را با حروف فارسی وارد نمایید.",
				"alloc_time" => "فرصت همکاری وارد نمایید." ,
				'title' => 'عنوان را وارد نمایید.',
				'slug' => 'نامک را وارد نمایید.',
				'cities' => 'شهرها را انتخاب نمایید.',
				'organs' => 'حداقل یکی از ارگان‌ها را انتخاب کنید.',
		],

		'attributes_example' => [
				"email"	=> "مثال: site@site.com",
				"username" => "مثال: mohammadahmadi",
				"password" => "********",
				"password2" => "********",
				"security"	=> "مثال: 15",
				"name_first"=> "مثال: محمد",
				"name_last"=> "مثال: احمدی",
				"name_father"=> "مثال: علی",
				"code_melli" => "مثال: ۱۲۳۴۵۶۷۸۹۰",
				"code_id" => "مثال: ۴۵۶",
				"gender"=> "مثال: آقا",
				"birth_date" => "مثال: ۱۳۶۱/۰۱/۰۵",
				"birth_city" => "مثال: تهران",
				"marital_status" => "مثال: متاهل",
				"edu_level" => "مثال: لیسانس",
				"edu_field" => "مثال: مهندسی مکانیک" ,
				'edu_city' => 'مثال: شیراز',
				"tel_mobile" => 'مثال: ۰۹۱۲۱۲۳۴۵۶۷',
				"tel_emergency" => 'مثال: ۰۲۱۲۲۳۳۴۴۵۵' ,
				"home_city" => "مثال: تهران",
				"home_address" => "مثال: دربند، خ احمدی، پ ۷۷",
				"home_tel" => "مثال: ۰۲۱۲۲۱۱۲۲۱۱" ,
				"work_city" => "مثال: کرج",
				"work_address" => "خ زمانی، خ آجری، پ ۹۰",
				"work_tel" => "۰۲۶۳۲۲۵۵۲۱۳" ,
				"job" => "مثال: کارمند",
				"familization" => "مثال: سایت" ,
				"motivation" => "مثال: انجام کارهای خیرخواهانه",
				"alloc_time" => "مثال: ۵روز" ,
				"marital" => 'مثال: متاهل',
				"home_postal_code" => 'مثال: 1122334455',
				"work_postal_code" => 'مثال: 1122334455',
		],

		'attributes_placeholder' => [
				"email"	=> "(حروف انگلیسی)",
				"username" => "(حروف انگلیسی)",
				"password" => "(حداقل ۸ کاراکتر)",
				"password2" => "(تکرار گذرواژه)",
				"security"	=> "(فقط عدد)",
				"name_first"=> "(حروف فارسی)",
				"name_last"=> "(حروف فارسی)",
				"name_father"=> "(حروف فارسی)",
				"code_melli" => "(۱۰ رقم بدون خط تیره)",
				"code_id" => "(فقط عدد)",
				"gender"=> "",
				"birth_date" => "(ترجیحاْ از جدول درج خودکار یا ۱۳۶۱/۰۱/۰۵)",
				"birth_city" => "(حروف فارسی)",
				"marital_status" => "",
				"edu_level" => "",
				"edu_field" => "(حروف فارسی)" ,
				'edu_city' => '(حروف فارسی)',
				"tel_mobile" => '(۱۱ رقم بدون خط تیره)',
				"tel_emergency" => '(۱۱ رقم بدون خط تیره)' ,
				"home_city" => "(حروف فارسی)",
				"home_address" => "(حروف فارسی)",
				"home_tel" => "(۱۱ رقم بدون خط تیره)" ,
				"work_city" => "(حروف فارسی)",
				"work_address" => "(حروف فارسی)",
				"work_tel" => "(۱۱ رقم بدون خط تیره)" ,
				"job" => "(حروف فارسی)",
				"familization" => "" ,
				"motivation" => "(حروف فارسی)",
				"alloc_time" => "(تعداد روز، فقط عدد)" ,
				"home_postal_code" => "(۱۰ رقم بدون خط تیره)" ,
				"work_postal_code" => "(۱۰ رقم بدون خط تیره)" ,
				"time" => 'ساعت و دقیقه، در قالب مرسوم دقیقه:ساعت. مثل ۲۰:۴۲' ,
		],


	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

		'custom' => [
				'attribute-name' => [
						'rule-name' => 'custom-message',
				],
		],

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
				'template' => 'قالب' ,
				"action" => 'عملیات' ,
				"email"	=> "ایمیل",
				"username" => "شناسه‌ی کاربری",
				"security"	=> "کد امنیتی",
				"current_password" => "گذرواژه فعلی" ,
				"new_password" => "گذرواژه تازه" ,
				"password"=> "گذرواژه",
				"password2"=> "تکرار رمز",
				"birthday"=> "تاریخ تولد",
				"name_first"=> "نام",
				"name_last"=> "نام خانوادگی",
				"name_father" => "نام پدر"  ,
				"code_melli" => "کد ملی",
				"code_id" => "شماره شناسنامه",
				"gender"=> "جنسیت",
				"birth_date" => "تاریخ تولد",
				"birth_city" => "محل تولد",
				"marital" => "وضعیت تأهل",
				"occupation" => "شغل و تحصیلات" ,
				"education" => "تحصیلات" ,
				"edu_level" => "میزان تحصیلات",
				"edu_field" => "رشته‌ی تحصیلی" ,
				'edu_city' => 'محل تحصیل',
				"tel_mobile" => 'تلفن همراه',
				"mobile" => 'تلفن همراه',
				"telephone" => 'تلفن ثابت',
				"tel_emergency" => 'تلفن اضطراری' ,
				"home_city" => "محل سکونت",
				"city_id" => 'شهر' ,
				"home_address" => "نشانی منزل",
				"address" => "نشانی پستی",
				"home_tel" => "تلفن منزل" ,
				"home_postal_code" => "کد پستی منزل" ,
				"postal_code" => "کد پستی " ,
				"icon" => "نمایه",
				"donation_date" => "تاریخ اهدای عضو" ,

				"work_city" => "محل کار",
				"work_address" => "نشانی محل کار",
				"work_tel" => "تلفن محل کار" ,
				"work_postal_code" => "کد پستی محل کار" ,

				"job" => "شغل",
				"familization" => "نحوه‌ی آشنایی" ,
				"motivation" => "انگیزه‌ی همکاری",
				"alloc_time" => "فرصت همکاری" ,
				'title' => 'عنوان',
				'title_two' => 'عنوان دوم',
				'plural_title' => 'عنوان در حالت جمع',
				'singular_title' => 'عنوان در حالت مفرد',
				'header_title' => 'عنوان سرصفحه',
				'category_title' => 'عنوان دسته‌بندی',
				'slug' => 'نامک',
				'cities' => 'شهرها',
				'create' => 'ایجاد',
				'publish' => 'انتشار',
				'publish_date' => 'زمان انتشار' ,
				'abstract' => 'چکیده',
				'text' => 'متن',
				'category_id' => 'دسته‌بندی',
				'category' => 'دسته‌بندی',
				'keywords' => 'کلیدواژه‌ها',
				'allowed_meta' => 'متاهای مجاز' ,
				'featured_image' => 'نمایه',
				'image' => 'تصویر' ,
				'card_no' => 'شماره کارت' ,
				'organs' => 'اعضای قابل اهدا',
				'newsletter' => 'خبرنامه' ,
				'reject_reason' => 'دلیل رد تقاضا' ,
				'option_true' => 'گزینه‌ی درست' ,
				'option_wrong_1' => 'گزینه‌ی اشتباه ۱' ,
				'option_wrong_2' => 'گزینه‌ی اشتباه ۲' ,
				'option_wrong_3' => 'گزینه‌ی اشتباه ۳' ,
				'additional_info' => 'اطلاعات اضافی' ,
				"token" => "توکن",
				'link' => 'لینک',

				'content' => 'محتوا',
				'capital_id'=> 'مرکز استان',
				'province_id' => 'استان',
				'domain_id' => 'دامنه',
				'alias' => 'نام مستعار' ,
				'status' => 'وضعیت' ,
				'level' => 'سطح دسترسی' ,
				'domain' => 'دامنه' ,
				'tel' => 'تلفن',
				'message' => 'متن پیام',
				'items'=>'گزیدگان',
				'keyword' => 'کلیدواژه',

				'branch_id' => 'شاخه' ,
				'value' => 'مقدار' ,
				'global_value' => 'مقدار پیش‌فرض' ,
				'data_type' => 'نوع داده' ,
				'available_for_domains' => 'قابلیت خصوصی‌سازی در دامنه‌ها' ,
				'developers_only' => 'فقط برای استفاده‌ی برنامه‌نویسان' ,
				'is_resident' => 'ماندگار در حافظه' ,
				'default_value' => 'مقدار پیش‌فرض' ,
				'custom_value' => 'مقدار دل‌خواه' ,

				'customer_type' => 'نوع شخصیت' ,
				'name_firm' => 'نام شخصیت' ,
				'national_id' => 'شناسه‌ی ملی' ,
				'register_no' => 'شماره‌ی ثبت' ,
				'register_date' => 'تاریخ ثبت' ,
				'register_firm' => 'سازمان ثبت‌کننده' ,
				'economy_code' => 'کد اقتصادی' ,
				'gazette_url' => 'نشانی اینترنتی روزنامه رسمی' ,

				'bank_name' => 'نام بانک' ,
				'sheba' => 'شماره شبا' ,
				'account_no' => 'شماره حساب' ,
				'beneficiary' => 'نام صاحب حساب' ,
				'branch_name' => 'نام شعبه' ,
				'branch_code' => 'کد شعبه' ,

				'currency_title' => 'نام ارز' ,
				'currency_slug' => 'نشان اختصاری' ,
				'currency' => 'ارز' ,
				'price' => 'بها' ,
				'card_price' => 'بهای کارت' ,
				'price_to_sell' => 'بهای فروش' ,
				'price_to_buy' => 'بهای خرید' ,
				'effective_date' => 'زمان مؤثر'  ,
				'date' => 'تاریخ' ,
				'time' => 'ساعت' ,
				'sender' => 'فرستنده' ,
				'priority' => 'فوریت' ,
				'department' => 'بخش' ,
				'feedback' => 'بازخورد' ,
				'charge' => 'شارژ' ,
				'min_charge' => 'حداقل شارژ' ,
				'max_charge' => 'حداکثر شارژ' ,
				'inventory' => 'موجودی انبار' ,
				'inventory_low_alarm' => 'هشدار موجودی' ,
				'inventory_low_action' => 'حداقل موجودی' ,
				'description' => 'توضیحات' ,
				'max_purchasable' => 'محدودیت خرید' ,
				'product_id' => 'عنوان محصول' ,
			'invoice' => 'صورتحساب',
			'expiry' => 'انقضاء',
		],

		"http" => [
				'Error404' => 'این نشانی را نمی‌شناسیم',
				'Error403' => 'با ما به از این باش که با خلق جهانی',
				'Error410' => 'دنبال که می‌گردی؟ او رفته از اینجا',
		],

		"hint" => [
				'unique' => 'یکتا',
				'english-only' => 'فقط با کاراکترهای انگلیسی',
				'persian-only' => 'فقط با کاراکترهای فارسی',
		],

];
