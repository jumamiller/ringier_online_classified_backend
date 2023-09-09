<?php

namespace Database\Seeders\Auth;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //generate permissions
        $permissions=[
            'create',
            'read',
            'update',
            'delete'
        ];
        //create permissions
        foreach ($permissions as $permission){
            Permission::create([
                'name'=>$permission,
                'guard_name'=>'api'
            ]);
        }
        //create roles
        $adminRole=Role::create([
            'name'=>'admin',
            'guard_name'=>'api'
        ]);
        $userRole=Role::create([
            'name'=>'user',
            'guard_name'=>'api'
        ]);
        //assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo([
            'read'
        ]);

    }
}
