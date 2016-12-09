<?php
return [
	'new' => "دستور پرداخت جدید",
	'edit' => "ویرایش دستور پرداخت",
	'view' => "مشاهده جزئیات پرداخت",
	'process' => "بازبینی دستورپرداخت",
	'of' => "پرداخت‌های",
	'all' => 'همه مشتریان' ,

	'form' => [
		'insufficient_credit' => "اعتبار حساب برای انجام این تراکنش کافی نیست.",
		'fully_confirm' => "تأیید کامل مبلغ تراکنش",
		'fully_reject' => "رد کامل مبلغ تراکنش",
		'process_other_options' => "تأیید بخشی از مبلغ تراکنش",
	],

	'status' => [
		'confirmed' => "تأییدشده",
		'pending' => "منتظر بررسی",
		'underpaid' => "پرداخت ناکافی" ,
		'overpaid' => "پرداخت اضافی" ,
		'rejected' => "ناموفق",
		'all' => 'همه با هم' ,
		'bin' => 'زباله‌دان' ,
	],

	'methods' => [
		'cash' => "پرداخت نقدی",
		'shetab' => "کارت به کارت",
		'transfer' => "انتقال وجه",
		'deposit' => "پرداخت بانکی",
		'cheque' => "چک",
		'gateway' => "درگاه پرداخت",
		'pos' => "دستگاه کارت‌خوان",
		'site_credit' => "اعتبار",
	],
];

// id , order_id , amount_payable , payment_method , status , amount_declared , payment_date , payment_time ,
// account_no , bank_name , card_no , own_account_id , customer_account_id , depositor , receiver , sender , tracking_no ,
// cheque_date , cheque_no , description