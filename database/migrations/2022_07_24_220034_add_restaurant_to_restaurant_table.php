<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddRestaurantToRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('restaurants')->insert([
            [
                'name' => 'Burger king',
                'contact' => '111111',
                'address' => 'Noida sector 50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Domino',
                'contact' => '333333',
                'address' => 'Gurgaon sector 20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kfc',
                'contact' => '4444',
                'address' => 'Delgi cp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
