<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//['prize name','is calculated by won',percentage,prize table winner field]
return [
    'spin_indexs' => [
        ['FREE SPIN',true,8,'winners_free_spin'],
        ['XXX',false,20,''],
        ['$$$',true,10,'winners_cash'],
        ['FREE TOKEN',true,2,'winners_free_token'],
        ['AIR TIME',true,10,'winners_n500'],
        ['XXX',false,20,''],
        ['FREE SPIN',true,8,'winners_free_spin'],
        ['MYSTERY PRIZE',true,10,'winners_mystery_prize'],
        ['XXX',false,20,''],
        ['1/2 TOKEN',true,4,'winners_half_token'],
        ['XXX',false,10,''],
        ['JACKPOT',true,1,'winners_jackpot'],
        // etc
    ],
    'default_spin_count'=>3,
    'token_price'=>200,
    /*'pay_info'=>[
        'SECKEY'=>'FLWSECK-23cf37d16a889fae32321843691077e5-X',
        'pay_url'=>'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify',
        'pay_js_cdn'=>'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js',
        'API_publicKey'=>'FLWPUBK-6ed1f072ef79b4b4bd51a83e4197e32b-X',
        'currency'=>"NGN"
    ],*/
    'pay_info'=>[
      'SECKEY'=>'FLWSECK-a91ac91740acdbf40b13837da5295045-X',
      'pay_url'=>'https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify',
      'pay_js_cdn'=>'https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js',
      'API_publicKey'=>'FLWPUBK-482e4e302e5fb94c8454258d762d3444-X',
      'currency'=>"NGN"
    ],
    'states'=>[
        /*"Abia",
        "Adamawa",
        "Anambra",
        "Akwa Ibom",
        "Bauchi",
        "Bayelsa",
        "Benue",
        "Borno",
        "Cross River",
        "Delta",
        "Ebonyi",
        "Enugu",
        "Edo",
        "Ekiti",
        "FCT - Abuja",
        "Gombe",
        "Imo",
        "Jigawa",
        "Kaduna",
        "Kano",
        "Katsina",
        "Kebbi",
        "Kogi",
        "Kwara",*/
        "Lagos",
        /*"Nasarawa",
        "Niger",
        "Ogun",
        "Ondo",
        "Osun",
        "Oyo",
        "Plateau",
        "Rivers",
        "Sokoto",
        "Taraba",
        "Yobe",
        "Zamfara"*/
      ]
];
