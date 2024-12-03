<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

// class RoleSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         $roles = ['admin', 'normal'];

//         foreach ($roles as $role) {
//             DB::table('roles')->updateOrInsert(
//                 ['role_name' => $role], // Check if the role exists
//                 ['created_at' => now(), 'updated_at' => now()] // Add timestamps
//             );
//         }
//     }
// }
