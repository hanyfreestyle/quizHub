<?php

use App\AppPlugin\UsersApp\Traits\PortalMigrationsTraits;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    use PortalMigrationsTraits;

    public function up(): void {
        self::tableUsers('up');
//        self::tableUsersCard('up');
    }

    public function down(): void {
//        self::tableUsersCard('down');
        self::tableUsers('down');
    }

};
