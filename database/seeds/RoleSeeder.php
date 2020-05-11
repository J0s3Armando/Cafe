<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['role_name'=>'Administrador'],
            ['role_name'=>'Usuario'],
            ['role_name'=>'Supervisor'],
            ['role_name'=>'Empleado'],
        ]);
    }
}
