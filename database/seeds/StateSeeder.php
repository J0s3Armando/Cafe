<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['state'=>'Aguascalientes'],
            ['state'=>'Baja California'],
            ['state'=>'Baja California Sur'],
            ['state'=>'Campeche'],
            ['state'=>'Coahuila de Zaragoza'],
            ['state'=>'Colima'],
            ['state'=>'Chiapas'],
            ['state'=>'Chihuahua'],
            ['state'=>'Ciuidad de México'],
            ['state'=>'Durango'],
            ['state'=>'Guanajuato'],
            ['state'=>'Guerrero'],
            ['state'=>'Hidalgo'],
            ['state'=>'Jalisco'],
            ['state'=>'México'],
            ['state'=>'Michoacán de Ocampo'],
            ['state'=>'Morelos'],
            ['state'=>'Nayarit'],
            ['state'=>'Nuevo León'],
            ['state'=>'Oaxaca'],
            ['state'=>'Puebla'],
            ['state'=>'Querétaro'],
            ['state'=>'Quintana Roo'],
            ['state'=>'San Luis Potosí'],
            ['state'=>'Sinaloa'],
            ['state'=>'Sonora'],
            ['state'=>'Tabasco'],
            ['state'=>'Tamaulipas'],
            ['state'=>'Tlaxcala'],
            ['state'=>'Veracruz de Ignacio de la Llave'],
            ['state'=>'Yucatán'],
            ['state'=>'Zacatecas']
        ]);

    }
}
