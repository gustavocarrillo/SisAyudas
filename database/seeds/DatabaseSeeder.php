<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'nombre' => 'admin',
            'nacionalidad' => 'V',
            'cedula' => '00000000',
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'tipo' => 'admin',
            'estatus' => 'activo',
        ]);



        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
