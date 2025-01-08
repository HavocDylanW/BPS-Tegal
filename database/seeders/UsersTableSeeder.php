<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create users
        $user1 = User::firstOrCreate([
            'email' => 'nurchasanah@gmail.com',
            'username' => 'Nurchasanah123',
        ], [
            'name' => 'Nurchasanah',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No.1, Jakarta',
        ]);

        $user2 = User::firstOrCreate([
            'email' => 'nurlaeli@gmail.com',
            'username' => 'Nurlaeli123',
        ], [
            'name' => 'Nurlaeli',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567891',
            'address' => 'Jl. Kebon Jeruk No.2, Jakarta',
        ]);

        $user3 = User::firstOrCreate([
            'email' => 'somadi@gmail.com',
            'username' => 'Somadi123',
        ], [
            'name' => 'Somadi',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567892',
            'address' => 'Jl. Cendana No.3, Jakarta',
        ]);

        $user4 = User::firstOrCreate([
            'email' => 'qomarudin@gmail.com',
            'username' => 'Qomarudin123',
        ], [
            'name' => 'Qomarudin',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567893',
            'address' => 'Jl. Flamboyan No.4, Jakarta',
        ]);

        $user5 = User::firstOrCreate([
            'email' => 'sitymutiahfahmi@gmail.com',
            'username' => 'Sity123',
        ], [
            'name' => 'Sity Mutiah Fahmi',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567894',
            'address' => 'Jl. Anggrek No.5, Jakarta',
        ]);

        $user6 = User::firstOrCreate([
            'email' => 'wawanbudiman@gmail.com',
            'username' => 'Wawan123',
        ], [
            'name' => 'Wawan Budiman',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567895',
            'address' => 'Jl. Mawar No.6, Jakarta',
        ]);

        $user7 = User::firstOrCreate([
            'email' => 'betyatmani@gmail.com',
            'username' => 'Bety123',
        ], [
            'name' => 'Bety Atmani',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567896',
            'address' => 'Jl. Melati No.7, Jakarta',
        ]);

        $user8 = User::firstOrCreate([
            'email' => 'anirahmawati@gmail.com',
            'username' => 'Ani123',
        ], [
            'name' => 'Ani Rahmawati',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567897',
            'address' => 'Jl. Teratai No.8, Jakarta',
        ]);

        $user9 = User::firstOrCreate([
            'email' => 'ariefsubekhi@gmail.com',
            'username' => 'Arief123',
        ], [
            'name' => 'Arief Subekhi',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567898',
            'address' => 'Jl. Kenanga No.9, Jakarta',
        ]);

        $user10 = User::firstOrCreate([
            'email' => 'ajisusanto@gmail.com',
            'username' => 'Aji123',
        ], [
            'name' => 'Aji Susanto',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567899',
            'address' => 'Jl. Anggrek No.10, Jakarta',
        ]);

        $user11 = User::firstOrCreate([
            'email' => 'retnoanggraeny@gmail.com',
            'username' => 'Retno123',
        ], [
            'name' => 'Retno Anggraeny',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567800',
            'address' => 'Jl. Cempaka No.11, Jakarta',
        ]);

        $user12 = User::firstOrCreate([
            'email' => 'adhimrahman@gmail.com',
            'username' => 'Adhim123',
        ], [
            'name' => 'Adhim Rahman',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567801',
            'address' => 'Jl. Bunga No.12, Jakarta',
        ]);

        $user13 = User::firstOrCreate([
            'email' => 'masrudin@gmail.com',
            'username' => 'Masrudin123',
        ], [
            'name' => 'Masrudin',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567802',
            'address' => 'Jl. Melati No.13, Jakarta',
        ]);

        $user14 = User::firstOrCreate([
            'email' => 'muhammadbazar@gmail.com',
            'username' => 'Bazar123',
        ], [
            'name' => 'Muhammad Bazar',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567803',
            'address' => 'Jl. Cendana No.14, Jakarta',
        ]);

        $user15 = User::firstOrCreate([
            'email' => 'luzianawijaya@gmail.com',
            'username' => 'luziana123',
        ], [
            'name' => 'Luziana Wijaya Tanjung',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567804',
            'address' => 'Jl. Kemuning No.15, Jakarta',
        ]);

        $user16 = User::firstOrCreate([
            'email' => 'muhammadrizqon@gmail.com',
            'username' => 'Rizqon123',
        ], [
            'name' => 'Muhammad Rizqon Agusta',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567805',
            'address' => 'Jl. Angsana No.16, Jakarta',
        ]);

        $user17 = User::firstOrCreate([
            'email' => 'ariprabowo@gmail.com',
            'username' => 'Ari123',
        ], [
            'name' => 'Ari Prabowo',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567806',
            'address' => 'Jl. Meranti No.17, Jakarta',
        ]);

        $user18 = User::firstOrCreate([
            'email' => 'aminsuyitno@gmail.com',
            'username' => 'Amin123',
        ], [
            'name' => 'Amin Suyitno',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567807',
            'address' => 'Jl. Flamboyan No.18, Jakarta',
        ]);

        $user19 = User::firstOrCreate([
            'email' => 'bifawahyu@gmail.com',
            'username' => 'Wahyu123',
        ], [
            'name' => 'Bifa Wahyu Santoso',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567808',
            'address' => 'Jl. Teratai No.19, Jakarta',
        ]);

        $user20 = User::firstOrCreate([
            'email' => 'kasmali@gmail.com',
            'username' => 'Kasmali123',
        ], [
            'name' => 'Kasmali',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567809',
            'address' => 'Jl. Melati No.20, Jakarta',
        ]);

        $user21 = User::firstOrCreate([
            'email' => 'misbakhululum@gmail.com',
            'username' => 'Misbakhul123',
        ], [
            'name' => 'Misbakhul Ulum',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567810',
            'address' => 'Jl. Cempaka No.21, Jakarta',
        ]);

        $user22 = User::firstOrCreate([
            'email' => 'harimurti@gmail.com',
            'username' => 'Harimurti123',
        ], [
            'name' => 'Harimurti',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '081234567811',
            'address' => 'Jl. Bunga No.22, Jakarta',
        ]);

        $user23 = User::firstOrCreate([
            'email' => 'milasulasmaya@gmail.com',
            'username' => 'Mila123',
        ], [
            'name' => 'Mila Sulasmaya',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '081234567812',
            'address' => 'Jl. Mawar No.23, Jakarta',
        ]);

        $user24 = User::firstOrCreate([
            'email' => 'herih@gmail.com',
            'username' => 'Heri123'
        ], [
            'name' => 'Heri Hermawan',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '08123456789',
            'address' => 'Jl. Raya No. 12, Bandung',
            'profile_picture' => null,
        ]);
        
        $user25 = User::firstOrCreate([
            'email' => 'hesti@gmail.com',
            'username' => 'Hesti123'
        ], [
            'name' => 'Hesti Rahmawati',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '08234567890',
            'address' => 'Jl. Kenanga No. 25, Yogyakarta',
            'profile_picture' => null,
        ]);
        
        $user26 = User::firstOrCreate([
            'email' => 'norma@gmail.com',
            'username' => 'Norma123'
        ], [
            'name' => 'Norma Etika',
            'password' => bcrypt('password'),
            'gender' => 'Perempuan',
            'phone' => '08345678901',
            'address' => 'Jl. Melati No. 20, Jakarta',
            'profile_picture' => null,
        ]);        

        $user27 = User::firstOrCreate([
            'email' => 'farrel@gmail.com',
            'username' => 'farrelbaymax'
        ], [
            'name' => 'Farrel Maulana',
            'password' => bcrypt('password'),
            'gender' => 'Laki-laki',
            'phone' => '085933293040',
            'address' => 'Jl. Kartini No.12',
            'profile_picture' => null,
        ]);

        // Assign roles to users
        // Fetch existing roles (assuming they are already in the roles table)
        $employeeRole = Role::where('name', 'Employee')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $superadminRole = Role::where('name', 'Super Admin')->first();

        // Assign roles to users
        $user1->roles()->attach($adminRole); // Admin
        $user2->roles()->attach($employeeRole); // Employee
        $user3->roles()->attach($employeeRole); // Employee
        $user4->roles()->attach($employeeRole); // Employee
        $user5->roles()->attach($employeeRole); // Employee
        $user6->roles()->attach($adminRole); // Employee
        $user7->roles()->attach($employeeRole); // Employee
        $user8->roles()->attach($employeeRole); // Employee
        $user9->roles()->attach($employeeRole); // Employee
        $user10->roles()->attach($adminRole); // Employee
        $user11->roles()->attach($employeeRole); // Employee
        $user12->roles()->attach($employeeRole); // Employee
        $user13->roles()->attach($employeeRole); // Employee
        $user14->roles()->attach($adminRole); // Employee
        $user15->roles()->attach($employeeRole); // Admin
        $user16->roles()->attach($employeeRole); // Super Admin
        $user17->roles()->attach($employeeRole); // Employee
        $user18->roles()->attach($employeeRole); // Employee
        $user19->roles()->attach($employeeRole); // Employee
        $user20->roles()->attach($employeeRole); // Employee
        $user21->roles()->attach($employeeRole); // Employee
        $user22->roles()->attach($employeeRole); // Employee
        $user23->roles()->attach($employeeRole); // Employee
        $user24->roles()->attach($adminRole);
        $user25->roles()->attach($employeeRole);
        $user26->roles()->attach($employeeRole);
        $user27->roles()->attach($superadminRole);

    }
}
