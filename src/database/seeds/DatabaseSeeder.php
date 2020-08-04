<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert([
            'affiliateId' => 1,
            'primaryCategory' => 'Girl',
            'tags'  => '',
            'language' => ''
        ]);

        DB::table('campaigns')->insert([
            'affiliateId' => 1,
            'primaryCategory' => 'Girl',
            'tags'  => '',
            'language' => 'hu'
        ]);

        DB::table('campaigns')->insert([
            'affiliateId' => 1,
            'primaryCategory' => 'Girl',
            'tags' => 'Ass_Play,Bondage',
            'language' => ''
        ]);
    }
}
