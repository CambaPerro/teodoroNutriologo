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
            
            'email'=>'usuario@gmail.com',
            'password'=>bcrypt('12345678'),
            'nombre'=>'Usuario',
            'apellido'=>'',
            'fecha_nacimiento'=>'1996/04/20',
            'altura'=>'1.72',
            'peso'=>'82',
            'sexo'=>'MASCULINO',
            'tipo'=>'C',
            'estado'=>'0'
            ]);
            User::create([
            
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('12345678'),
                'nombre'=>'Admin',
                'apellido'=>'',
                'fecha_nacimiento'=>'1996/04/20',
                'altura'=>'1.72',
                'peso'=>'82',
                'sexo'=>'MASCULINO',
                'tipo'=>'A',
                'estado'=>'1'
                ]);
    }
}
