<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
//https://event.webinarjam.com/live/109/krqxqivrtkoptklx1wimw701
class insert_records_in_users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $users = [
             [
               'name' => 'mithilesh',
               'email' => 'mithilesh@gmail.com',
               'password' => bcrypt('123456')
             ],
             [
               'name' => 'anjali verma',
               'email' => 'anjaliverma@gmail.com',
               'password' => bcrypt('123456')
             ]        
         ];

         User::insert($users);
    }
}
