<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'code'    => 'BAN566HQ',
                'country' => 'bangladesh',
                'name'    => 'Region HQ Sarail',
                'slug'    => 'region-hq-sarail',
                'status'  => 'active'
            ],

            [
                'code'    => 'INDIND7643',
                'country' => 'india',
                'name'    => 'Kolkata Frontier',
                'slug'    => 'kolkata-frontier',
                'status'  => 'active'
            ],
        ];

        Region::insert($regions);
    }
}
