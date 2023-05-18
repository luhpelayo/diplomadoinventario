<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'ci'=>'1234895',
            'nombre'=> 'Jose Callejas',
            'sexo'=> 'm',
            'telefono'=> '72180056',
            'email'=> 'josec@gmail.com',
        ]);

        Cliente::create([
            'ci'=>'12788',
            'nombre'=> 'Morgan Ruiz',
            'sexo'=> 'm',
            'telefono'=> '72182556',
            'email'=> 'morgan@gmail.com',
        ]);
    }
}
