<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nationality;

class NationalitySeeder extends Seeder
{
    public function run()
    {
        $nationalities = [
            ['nationality_id' => 1, 'nationality_name' => 'Indonesia', 'nationality_code' => 'ID'],
            ['nationality_id' => 2, 'nationality_name' => 'Malaysia', 'nationality_code' => 'MY'],
            ['nationality_id' => 3, 'nationality_name' => 'Singapore', 'nationality_code' => 'SG'],
            ['nationality_id' => 4, 'nationality_name' => 'Thailand', 'nationality_code' => 'TH'],
            ['nationality_id' => 5, 'nationality_name' => 'Philippines', 'nationality_code' => 'PH'],
            ['nationality_id' => 6, 'nationality_name' => 'Vietnam', 'nationality_code' => 'VN'],
            ['nationality_id' => 7, 'nationality_name' => 'Japan', 'nationality_code' => 'JP'],
            ['nationality_id' => 8, 'nationality_name' => 'South Korea', 'nationality_code' => 'KR'],
            ['nationality_id' => 9, 'nationality_name' => 'Australia', 'nationality_code' => 'AU'],
            ['nationality_id' => 10, 'nationality_name' => 'United States', 'nationality_code' => 'US'],
            ['nationality_id' => 11, 'nationality_name' => 'United Kingdom', 'nationality_code' => 'GB'],
            ['nationality_id' => 12, 'nationality_name' => 'Germany', 'nationality_code' => 'DE'],
            ['nationality_id' => 13, 'nationality_name' => 'France', 'nationality_code' => 'FR'],
            ['nationality_id' => 14, 'nationality_name' => 'Netherlands', 'nationality_code' => 'NL'],
            ['nationality_id' => 15, 'nationality_name' => 'China', 'nationality_code' => 'CN'],
            ['nationality_id' => 16, 'nationality_name' => 'India', 'nationality_code' => 'IN'],
        ];

        foreach ($nationalities as $nationality) {
            Nationality::create($nationality);
        }
    }
}
