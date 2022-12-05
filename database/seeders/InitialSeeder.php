<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        User::create([
            'name' => 'Francis Wanjau Mbatia',
            'phone'=> '+254707220224',
            'username'=>'Mbatia',
            'email' => 'wanjaumbatia@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'active'=>true,
            'short'=>0,
            'blocked'=>0,
            'description'=>'Developer',
            'Branch'=>'ASABA',
            'type'=>'HQ',
            'role'=>'Admin'
        ]);
        
        Role::create([
            'name' => 'Admin',
            'active' => true
        ]);

        Role::create([
            'name' => 'Sales Executive',
            'active' => true
        ]);

        Role::create([
            'name' => 'Office Admin',
            'active' => true
        ]);

        Role::create([
            'name' => 'Branch Manager',
            'active' => true
        ]);

        Role::create([
            'name' => 'Loan Officer',
            'active' => true
        ]);

        Role::create([
            'name' => 'Region Manager',
            'active' => true
        ]);

        Role::create([
            'name' => 'Operation Manager',
            'active' => true
        ]);

        Role::create([
            'name' => 'General Manager',
            'active' => true
        ]);

        Role::create([
            'name' => 'Managing Director',
            'active' => true
        ]);


        Branch::create([
            'name' => 'Asaba'
        ]);
        Branch::create([
            'name' => 'Abraka'
        ]);
        Branch::create([
            'name' => 'Agbarho'
        ]);
        Branch::create([
            'name' => 'Agbor'
        ]);
        Branch::create([
            'name' => 'Issele-Uku'
        ]);
        Branch::create([
            'name' => 'Koko'
        ]);
        Branch::create([
            'name' => 'Kwale'
        ]);
        Branch::create([
            'name' => 'Obiaruku'
        ]);
        Branch::create([
            'name' => 'Oghara'
        ]);
        Branch::create([
            'name' => 'Ogwashi-Uku'
        ]);        
        Branch::create([
            'name' => 'Oleh'
        ]);
        Branch::create([
            'name' => 'Ozoro'
        ]);
        Branch::create([
            'name' => 'Sapele'
        ]);
        Branch::create([
            'name' => 'Ughelli'
        ]);
        Branch::create([
            'name' => 'Warri'
        ]);
    
    }
}
