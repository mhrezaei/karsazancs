<?php
return [
		'page_title' => 'صرافی میهن',
		'index' => 'پیشخوان' ,
		'logout' => 'خروج' ,
		'grid_count' => 'در حال نمایش :rows سطر از مجموع :total سطر موجود اطلاعات'  ,
		'admins' => 'مدیران سایت' ,

		'modules' => [
			'content_management' => 'مدیریت محتوا' ,
			'admins' => 'مدیران سایت' ,
			'customers' => 'مشتریان' ,
			'orders' => 'سفارش‌ها' ,
			'payments' => "پرداخت‌ها",
			'tickets' => 'پشتیبانی' ,
			'chats' => 'گفت‌وگوی آنلاین' ,
			'products' => 'محصولات' ,
			'currencies' => 'مدیریت ارزها' ,
		],

		"permits" => [
				'*' => 'کنترل کامل',
				'view' => 'نمایش' ,
				'browse' => 'پیمایش' ,
				'send' => 'ارسال ایمیل/پیامک',
				'search' => 'جست‌وجو' ,
				'create' => 'افزودن' ,
				'bulk' => 'کارهای دسته‌جمعی' ,
				'edit' => 'ویرایش' ,
				'publish' => 'انتشار' ,
				'report' => 'گزارش‌گیری' ,
				'cats' => 'دسته‌بندی‌ها' ,
				'permits' => 'مجوزهای دسترسی',
				'delete' => 'پاک کردن' ,
				'bin' => 'زباله‌دان' ,
				'print' => 'چاپ' ,
				'process' => 'اقدام' ,
				'activation' => 'فعال‌سازی' ,
		],

		'account' => [
				'account_settings' => 'پرونده' ,
		],

		'settings' => [
				'upstream' => 'تنظیمات بالادستی' ,

				'downstream' => 'تنظیمات' ,

				'states' => 'شهرها و استان‌ها' ,
				'province_edit' => 'ویرایش استان' ,
				'province_new' => 'ایجاد استان تازه' ,
				'city_new' => 'ایجاد شهر تازه' ,
				'city_edit' => 'ویرایش شهر' ,
				'search_states' => 'جست‌وجوی شهر' ,
				'cities' => 'شهرها' ,
				'city' => 'شهر' ,
				'city_delete_alert' => 'این حذف به شیوه‌ی نرم انجام می‌شود و موارد استفاده‌شده در بانک اطلاعاتی برنامه، به حال خود رها می‌شوند.' ,
				'province_cant_delete_alert' => 'در این استان، :count شهر به ثبت رسیده است. پیش از حذف، ابتدا تکلیف آن‌ها را مشخص کنید.' ,
				'cities_of' => 'شهرهای :province' ,

				'branches' => 'شاخه‌های مطالب' ,
				'edit_branch' => 'ویرایش شاخه' ,
				'new_branch' => 'ایجاد شاخه‌ی تازه' ,
				'branch_icon_hint' => 'کد یکی از آیکون‌های Font Awesome بدون کاراکتر fa' ,
				'one_of_these' => 'یکی از این‌ها: ' ,
				'some_of_these' => 'تعداد دل‌خواه از این‌ها:' ,
				'branches_features' => 'ویژگی‌ها' ,
				'branches_meta_hint' => 'متاها را به صورت key:type بنویسید و با کامای انگلیسی (,) از هم جدا کنید. اگر نوع مشخص نشود، text در نظر گرفته می‌شود. نوع‌های مجاز: ',
				'branches_delete_alert_posts' => 'اصلاً به سرنوشت :count پستی که به این شاخه تعلق دارد فکر کرده‌ای عزیز جان؟',
				'branches_delete_alert' => 'این حذف به شیوه‌ی نرم انجام می‌شود، اما در داخل برنامه راهی برای بازیافت وجود ندارد.' ,

				'departments' => 'واحدهای پشتیبانی' ,
				'department' => 'واحد' ,
				'edit_department' => 'ویرایش واحد' ,
				'new_department' => 'واحد پشتیبانی جدید' ,
				'online_feature' => 'قابلیت چت آنلاین' ,
				'department_delete_alert_tickets' => 'اصلاً به سرنوشت :count پستی که به این شاخه تعلق دارد فکر کرده‌ای عزیز جان؟',
				'' => '' ,

				'categories' => 'دسته‌بندی مطالب' ,
				'category' => 'دسته‌بندی',
				'category_new' => 'دسته‌بندی تازه' ,
				'category_edit' => 'ویرایش دسته‌بندی' ,
				'category_delete_alert_posts' => 'این دسته‌بندی برای :count مطلب در نظر گرفته شده است. پاک کردن دسته‌بندی، مطلب یا مطالب مرتبط را «پادرهوا» خواهد ساخت.' ,
				'category_delete_alert' => 'این حذف، غیر قابل بازیافت است.' ,

				'downstream_settings' => [

						'edit' => 'ویرایش گزینه' ,
						'new' => 'گزینه‌ی تازه' ,
						'unset' => 'تنظیم‌نشده' ,

						'category' => [
								'template' => 'قالب سایت' ,
								'contact' => 'راه‌های ارتباطی' ,
								'socials' => 'شبکه‌های اجتماعی' ,
								'database' => 'بستر اطلاعاتی' ,
						],
						'data_type' => [
								'text' => 'عبارت کوتاه' ,
								'textarea' => 'پاراگراف' ,
								'boolean' => 'بله / خیر' ,
								'date' => 'تاریخ' ,
								'photo' => 'تصویر' ,
								'array' => 'آرایه' ,
								'array_hint' => 'هر مورد را در یک خط بنویسید' ,
						],
				],



		],
];