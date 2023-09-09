<?php

namespace Database\Seeders\Configuration;

use App\Models\Country\Country;
use App\Models\Currency\Currency;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //KES
        Currency::create([
            'name'=>'Kenyan Shilling',
            'code'=>'KES',
            'symbol'=>'KSh',
            'status'=>'ACTIVE'
        ]);
        //USD
        Currency::create([
            'name'=>'United States Dollar',
            'code'=>'USD',
            'symbol'=>'$',
            'status'=>'ACTIVE'
        ]);
        //EUR
        Currency::create([
            'name'=>'Euro',
            'code'=>'EUR',
            'symbol'=>'€',
            'status'=>'ACTIVE'
        ]);
        //GBP
        Currency::create([
            'name'=>'British Pound',
            'code'=>'GBP',
            'symbol'=>'£',
            'status'=>'ACTIVE'
        ]);
        //rand
        Currency::create([
            'name'=>'South African Rand',
            'code'=>'ZAR',
            'symbol'=>'R',
            'status'=>'ACTIVE'
        ]);
        //mauritian rupee
        Currency::create([
            'name'=>'Mauritian Rupee',
            'code'=>'MUR',
            'symbol'=>'₨',
            'status'=>'ACTIVE'
        ]);

        //Kenya
        Country::create([
            'name'=>'Kenya',
            'code'=>'KE',
            'phone_code'=>'254',
            'currency_id'=>1,
            'status'=>'ACTIVE'
        ]);
        //USA
        Country::create([
            'name'=>'United States',
            'code'=>'US',
            'phone_code'=>'1',
            'currency_id'=>2,
            'status'=>'ACTIVE'
        ]);
        //UK
        Country::create([
            'name'=>'United Kingdom',
            'code'=>'GB',
            'phone_code'=>'44',
            'currency_id'=>4,
            'status'=>'ACTIVE'
        ]);
        //South Africa
        Country::create([
            'name'=>'South Africa',
            'code'=>'ZA',
            'phone_code'=>'27',
            'currency_id'=>5,
            'status'=>'ACTIVE'
        ]);
        //Mauritius
        Country::create([
            'name'=>'Mauritius',
            'code'=>'MU',
            'phone_code'=>'230',
            'currency_id'=>6,
            'status'=>'ACTIVE'
        ]);
    }
}
