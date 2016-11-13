<?php
return [
		'new' => 'ثبت سفارش جدید' ,
		'edit' => 'ویرایش سفارش' ,
		'view' => "مشاهده‌ی سفارش",
		'of' => 'سفارش‌های',
		'all' => 'همه مشتریان' ,

		'form' => [
			'original_card_price' => "بهای اصلی محصول: :price ریال",
			'feedback_order_next_step' => "سایر اطلاعات فرم را تکمیل نمایید.",
			'original_charge' => 'شارژ پیش‌فرض: :charge :currency' ,
			'original_charge_min' => "حداقل: :min_charge :currency" ,
			'original_charge_max' => "حداکثر: :max_charge :currency",
			'original_charge_no_limit' => "شارژ را بدون محدودیت از پیش تعیین‌شده، به :currency وارد کنید.",
			'inventory_hint' => "موجودی انبار: :inventory عدد",
			'inventory_alarm' => "موجودی این محصول در انبار، کمتر از حداقل تعیین‌شده است!",
			'purchase_limit_alarm' => "این مشتری :total عدد از این کارت در اختیار دارد در حالی که حد تعیین‌شده، تنها :limit عدد است.",
			'original_invoice_hint' => "حاصل جمع بهای کارت و معادل ریالی شارژ اولیه با نرخ روز ارز (:rate) به ریال",
			'invoice_hint' => 'صورتحساب نهایی را می‌توانید با مبلغ دلخواه به ریال وارد نمایید.' ,
		],

		'status' => [
				'unprocessed' => 'جدید',
				'processing' => 'در دست اقدام' ,
				'under_payment' => 'منتظر پرداخت',
				'paid' => 'پرداخت‌شده',
				'partly_paid' => "منتظر تکمیل پرداخت",
				'unpaid' => 'منتظر پرداخت' ,
				'partially_paid' => 'پرداخت ناقص',
				'dispatched' => 'ارسال‌شده',
				'archive' => 'بایگانی',
				'open' => ' باز',
				'all' => 'همه با هم' ,
				'bin' => 'زباله‌دان' ,
		],
	
		'type' => [
			'title' => 'سفارش' ,
			'new' => 'کارت تازه',
			'extend' => 'تمدید کارت',
			'recharge' => 'شارژ مجدد',
			'refund' => 'بازگشت مبلغ',
			'block' => 'انسداد کارت',
		],

];