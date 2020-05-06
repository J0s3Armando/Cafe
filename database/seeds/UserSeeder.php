<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Cambia tu nombre',
            'last_name'=>'Cambia tu apellido',
            'state_id'=>6,
            'address'=>'Cambia tu domicilio',
            'cp'=>12345,
            'phone'=>'1234567890',
            'idRole'=>2,
            'email'=>'tuCorreo@correo.es',
            'password'=>Hash::make('AdminMukulumcafe'),
        ]);
    }
}
