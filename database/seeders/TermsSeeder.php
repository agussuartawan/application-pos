<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Term::insert([
            [
                'description' => 'CASH',
                'is_cash' => 1,
                'term_day' => null,
                'slug' => 'cash'
            ],
            [
                'description' => '1 Hari',
                'is_cash' => 0,
                'term_day' => 1,
                'slug' => '1-hari'
            ],
            [
                'description' => '7 Hari',
                'is_cash' => 0,
                'term_day' => 7,
                'slug' => '7-hari'
            ],
            [
                'description' => '14 Hari',
                'is_cash' => 0,
                'term_day' => 14,
                'slug' => '14-hari'
            ],
            [
                'description' => '30 Hari',
                'is_cash' => 0,
                'term_day' => 30,
                'slug' => '30-hari'
            ],
        ]);
    }
}
