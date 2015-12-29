<?php

use Illuminate\Database\Eloquent\Model;
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
        if (app()->environment() == 'production') {
            die('You can\'t run this in production -.-\''.PHP_EOL);
        }

        Model::unguard();

        $this->call(CardsTableSeeder::class);

        Model::reguard();
    }
}
