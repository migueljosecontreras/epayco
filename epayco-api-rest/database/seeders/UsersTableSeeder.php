<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\DB::table('users')->count() == 0)
        {
            $now = date('Y-m-d H:i:s');

            \DB::table('users')->insert(
                [
                    [
                        'document'   => '20916310',
                        'name'       => 'Miguel Contreras',
                        'password'   => app('hash')->make(env('USER_PASSWORD_DEFAULT')),
                        'email'      => 'migueljosecontreras@gmail.com',
                        'phone'      => '+584148841858',
                        'role'       => 'admin',
                        'balance'    => 0,
                        'active'     => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'document'   => '00000000',
                        'name'       => 'Epayco',
                        'password'   => app('hash')->make(env('USER_PASSWORD_DEFAULT')),
                        'email'      => 'client@epayco.com',
                        'phone'      => '+000000000000',
                        'role'       => 'client',
                        'balance'    => 0,
                        'active'     => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                ]);
        }
    }
}
