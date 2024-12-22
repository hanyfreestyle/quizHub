<?php

namespace Database\Seeders;

use App\AppCore\AdminRole\Seeder\PermissionSeeder;
use App\AppCore\AdminRole\Seeder\AdminUserSeeder;
use App\AppCore\AdminRole\Seeder\RoleSeeder;
use App\AppCore\AdminRole\Seeder\UsersTableSeeder;
use App\AppCore\Menu\AdminMenuSeeder;
use App\Http\Traits\Files\AppSettingFileTraits;
use App\Http\Traits\Files\DataFileTraits;
use App\Http\Traits\Files\PortalCardFileTraits;
use App\Http\Traits\Files\UsersAppFileTraits;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder {

    public function run(): void {

        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminMenuSeeder::class);

        UsersAppFileTraits::LoadSeeder();
//        PortalCardFileTraits::LoadSeeder();
        PortalCardFileTraits::LoadSeeder();
        AppSettingFileTraits::LoadSeeder();
        DataFileTraits::LoadSeeder();
        $this->call(ModelSeeder::class);

    }
}
