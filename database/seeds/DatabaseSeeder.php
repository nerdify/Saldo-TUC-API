<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            die('You can\'t run this in production -.-\'' . PHP_EOL);
        }

        Model::unguard();

        $this->call(CardsTableSeeder::class);

        Model::reguard();
    }
}
