<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            
            'email'=>'abasto@gmail.com',
            'password'=>bcrypt('12345678'),
            'nombre'=>'Luis Rodrigo',
            'apellido'=>'Abasto',
            'fecha_nacimiento'=>'1996/04/20',
            'altura'=>'1.72',
            'peso'=>'82',
            'sexo'=>'MASCULINO',
            'tipo'=>'C'
            ]);
    }
}
