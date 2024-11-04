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
            'email' => 'john123@example.com',
            'username' => 'john123',
        ], [
            'name' => 'John Doe',
            'password' => bcrypt('password'),
        ]);
        
        $user2 = User::firstOrCreate([
            'email' => 'james123@example.com',
            'username' => 'james123',
        ], [
            'name' => 'James Smith',
            'password' => bcrypt('password'),
        ]);
        
        $user3 = User::firstOrCreate([
            'email' => 'mike123@example.com',
            'username' => 'mike123',
        ], [
            'name' => 'Mike Johnson',
            'password' => bcrypt('password'),
        ]);
        
        $user4 = User::firstOrCreate([
            'email' => 'anna123@example.com',
            'username' => 'anna123',
        ], [
            'name' => 'Anna Brown',
            'password' => bcrypt('password'),
        ]);
        
        $user5 = User::firstOrCreate([
            'email' => 'susan123@example.com',
            'username' => 'susan123',
        ], [
            'name' => 'Susan Lee',
            'password' => bcrypt('password'),
        ]);
        
        $user6 = User::firstOrCreate([
            'email' => 'peter123@example.com',
            'username' => 'peter123',
        ], [
            'name' => 'Peter Green',
            'password' => bcrypt('password'),
        ]);
        
        $user7 = User::firstOrCreate([
            'email' => 'emily123@example.com',
            'username' => 'emily123',
        ], [
            'name' => 'Emily Clark',
            'password' => bcrypt('password'),
        ]);
        
        $user8 = User::firstOrCreate([
            'email' => 'david123@example.com',
            'username' => 'david123',
        ], [
            'name' => 'David King',
            'password' => bcrypt('password'),
        ]);
        
        $user9 = User::firstOrCreate([
            'email' => 'laura123@example.com',
            'username' => 'laura123',
        ], [
            'name' => 'Laura White',
            'password' => bcrypt('password'),
        ]);
        
        $user10 = User::firstOrCreate([
            'email' => 'chris123@example.com',
            'username' => 'chris123',
        ], [
            'name' => 'Chris Adams',
            'password' => bcrypt('password'),
        ]);
        
        $user11 = User::firstOrCreate([
            'email' => 'olivia123@example.com',
            'username' => 'olivia123',
        ], [
            'name' => 'Olivia Moore',
            'password' => bcrypt('password'),
        ]);
        
        $user12 = User::firstOrCreate([
            'email' => 'jason123@example.com',
            'username' => 'jason123',
        ], [
            'name' => 'Jason Scott',
            'password' => bcrypt('password'),
        ]);
        
        $user13 = User::firstOrCreate([
            'email' => 'nancy123@example.com',
            'username' => 'nancy123',
        ], [
            'name' => 'Nancy Hall',
            'password' => bcrypt('password'),
        ]);
        
        $user14 = User::firstOrCreate([
            'email' => 'kevin123@example.com',
            'username' => 'kevin123',
        ], [
            'name' => 'Kevin Miller',
            'password' => bcrypt('password'),
        ]);

        $user15 = User::firstOrCreate([
            'email' => 'ambatukam@example.com',
            'username' => 'ambatukam123'
        ], [
            'name' => 'Ambatukam Smith',
            'password' => bcrypt('password'),
        ]);

        $user16 = User::firstOrCreate([
            'email' => 'beyonce@example.com',
            'username' => 'beyonce123'
        ], [
            'name' => 'Beyonce',
            'password' => bcrypt('password'),
        ]);

        // Fetch existing roles (assuming they are already in the roles table)
        $employeeRole = Role::where('name', 'Employee')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $superadminRole = Role::where('name', 'Super Admin')->first();

        // Attach roles to users
        $user1->roles()->attach($employeeRole);  // John is an employee
        $user2->roles()->attach($employeeRole);
        $user3->roles()->attach($employeeRole);
        $user4->roles()->attach($employeeRole);
        $user5->roles()->attach($employeeRole);
        $user6->roles()->attach($employeeRole);
        $user7->roles()->attach($employeeRole);
        $user8->roles()->attach($employeeRole);
        $user9->roles()->attach($employeeRole);
        $user10->roles()->attach($employeeRole);
        $user11->roles()->attach($employeeRole);
        $user12->roles()->attach($employeeRole);
        $user13->roles()->attach($employeeRole);
        $user14->roles()->attach($employeeRole);
        $user15->roles()->attach($adminRole);  // Jane is an admin
        $user16->roles()->attach($superadminRole);   // Beyonce is an Super admin
    }
}
