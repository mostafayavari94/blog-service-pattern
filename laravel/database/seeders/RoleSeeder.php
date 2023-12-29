<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $data =
            [
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now
            ];


        DB::table('roles')->insert($data);

    }
}
