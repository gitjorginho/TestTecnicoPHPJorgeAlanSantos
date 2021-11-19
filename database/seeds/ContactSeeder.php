<?php

use App\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            "name" => "Jorge",
            "email" => "jorgeallan@msn.com",
            "telephone" => "(71)985067620",
            "message" => "Testando aplicativo",
            "file" => "file/YlnNaAwqonPbUElvlVxoaC78QQoH5YpMy9GioZjR.jpg"
        ]);
    }
}
