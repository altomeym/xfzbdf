<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Company Information Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default company information
    |
    */

    'name' => env('APP_NAME', 'Tiejet'),
    'company_owner' => 'Roma Tietz',
    'vat_id' => 'DE339798613',
	
	'how_company_work' => 'cvIOP-V__qc', // youtube video  + taskChangeCatLayout00942

    'bank' => [
        'ust_idnr' => 'DE339798613',
        'name' => 'N26 Bank',
        'iban' => 'DE62100110012624725675',
        'bic' => 'NTSBDEB1XXX',
    ],

    'managment' => [
        'director' => [
            'first_name' => 'Roma',
            'last_name' => 'Tietz',
        ]
    ],

    //
    'address' => [
        'line1' => config('system.name'),
        'line2' => 'Radelandstraße 38',
        'line3' => '13589 Berlin',
        'line4' => 'Germany',
        'tel' => '+4915166545422',
        'support_email' => 'support@tiejet.com',
        'website' => env('APP_URL'),
    ],
	
	'subscriber' => [
        'counts' => 2800
    ],
    'youtube' => [
        'counts' => 8
    ],
    'facebook' => [
        'counts' => 19500
    ],
    'twitter' => [
        'counts' => 0
    ],
    'instagram' => [
        'counts' => 16
    ],
    'pinterest' => [
        'counts' => 0
    ],
    'whatsapp_link' => 'https://api.whatsapp.com/send/?phone=4915166545422&Hi, I am intreted in tiejet&type=phone_number&app_absent=0',

    // bussiness branding detail visisble to home page
    'business_branding' => [
        'title' => 'The Tiejet Workspace: Powerful Tools to Boost Productivity',
        'detail' => 'With Tiejet, you will get everything you need to take your business to the next level',
        'bullets' => [
            '1' => 'We can help you connect with experienced brands who can help your business succeed.',
            '2' => 'Tiejet customer success manager will help you find the perfect match for your needs',
            '3' => 'Our powerful workspace tools will help you manage teamwork and boost productivity.',
        ],
        'media' => [
            'url' => 'https://tiejet.com/image/images/R4OYuN8rydUrmwKlnbXzD6sLs2OnrVO11Mnz6frw.png?p=full', // image or yt video
            'alt' => 'alt', // only for image
            'title' => '', // only for image
        ]
    ],
];
