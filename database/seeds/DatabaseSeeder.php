<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
        Storage::delete('public/productos');
        Storage::delete('public/users');

        Storage::makeDirectory('public/productos');
        Storage::makeDirectory('public/users');

        //factory(\App\Role::class, 1)->create(['name'=>'admin']);
        factory(\App\General::class, 1)->create();

        factory(\App\User::class, 1)->create(
            [
                'name'=>'admin',
                'email'=>'admin@mail.com',
                'password'=> bcrypt('admin'),
                'type'=> 'ADMIN'
            ]);

        factory(\App\User::class, 5)->create();

        factory(\App\UnidadMedida::class, 5)->create();
        factory(\App\Categoria::class, 5)->create();
        factory(\App\Bodega::class, 5)->create();

        factory(\App\Product::class, 30)->create();

        factory(\App\Cliente::class, 5)->create();
        factory(\App\Proveedor::class, 5)->create();

        factory(\App\Caja::class, 1)->create();
        factory(\App\Factura::class, 1)->create();
        factory(\App\Credito::class, 1)->create();
        factory(\App\Pedido::class, 1)->create();
        factory(\App\PedidoCredito::class, 1)->create();

    }
}
