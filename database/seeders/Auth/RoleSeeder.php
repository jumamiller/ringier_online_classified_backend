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
        //generate roles
        $roles=[
            'admin',
            'user'
        ];
        //create permissions
        foreach ($permissions as $permission){
            Permission::create([
                'name'=>$permission,
                'guard_name'=>'api'
            ]);
        }
        //create roles
        foreach ($roles as $role){
            $role=Role::create([
                'name'=>$role,
                'guard_name'=>'api'
            ]);
            //permissions
            $perms=Permission::all();
            //assign permissions to roles
            //admin(all)
            if($role->name==='admin'){
                $role->syncPermissions($perms);
            }
            //user(read)
            if($role->name==='user'){
                $role->syncPermissions($perms->where('name','read'));
            }
        }
    }
}
