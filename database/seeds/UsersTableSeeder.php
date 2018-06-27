<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime=date('Y-m-d H:i:s');
        DB::table('users')->insert([
        	[
        		'id'=>1,
        		'name'=>'user',
        		'email'=>'user@gmail.com',
        		'password'=>bcrypt('123456'),
                'is_admin'=> false,
        		'created_at'=> $currentTime,
        		'updated_at'=> $currentTime
        	],
        	[
        		'id'=>2,
                'name'=>'masu',
                'email'=>'masu@gmail.com',
                'password'=>bcrypt('123456'),
                'is_admin'=> true,
        		'created_at'=> $currentTime,
        		'updated_at'=> $currentTime
        	]
        ]);
    }
}
