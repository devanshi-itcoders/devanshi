<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $permissions = [
      'role-list',
      'role-create',
      'role-edit',
      'role-delete',
      'user-list',
      'user-create',
      'user-edit',
      'user-delete',
      'configuration-list',
      'configuration-create',
      'configuration-edit',
      'configuration-delete',
      'page-list',
      'page-create',
      'page-edit',
      'page-delete',
      'image-list',
      'image-create',
      'image-edit',
      'image-delete',
      'blog-list',
      'blog-create',
      'blog-edit',
      'blog-delete',
      'dashboard',
      'reports'
    ];

    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }
  }
}
