<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = User::create([
      'name' => 'Jason Roy',
      'email' => 'account@itcoders.in',
      'phone' => '9876543210',
      'password' => bcrypt('Admin@001')
    ]);

    $role = Role::create(['name' => 'Admin']);

    $permissions = Permission::pluck('id', 'id')->all();

    $role->syncPermissions($permissions);

    $user->assignRole([$role->id]);
  }
}
