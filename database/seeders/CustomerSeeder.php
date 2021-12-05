<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creates superuser with
        //email: admin@admin.com
        //password : adminadmin
        $superUser = User::where('email', "admin@admin.com")->get();
        
        User::destroy($superUser);


        $superUser = User::factory()->create();
        $superUser->save();
        DB::table('customers')->insert([
            'first_name' => "admin",
            'last_name' => "admin",
            'email' => $superUser->email,
            'telephone' => "0876543231",
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => true,
            'user_id' => $superUser->id,
        ]);
    }
}
