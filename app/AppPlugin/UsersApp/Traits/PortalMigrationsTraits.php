<?php

namespace App\AppPlugin\UsersApp\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait PortalMigrationsTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function tableUsers($funType) {
        if ($funType == 'up') {
            Schema::create('users_app', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid()->unique();
                $table->string('name')->nullable();
                $table->string('email')->unique();
                $table->string("phone")->nullable()->unique();
                $table->string("phone_code")->nullable();
                $table->string("whatsapp")->nullable();
                $table->string("whatsapp_code")->nullable();

                $table->integer('country_id')->nullable();
                $table->integer('city_id')->nullable();
                $table->integer('status')->default(1);
                $table->boolean("is_active")->default(true);
                $table->boolean("is_archived")->default(false);

                $table->string('photo')->nullable();
                $table->string('photo_thum_1')->nullable();

                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('password_temp')->nullable();
                $table->dateTime("last_login")->nullable();

                $table->integer('recovery_code')->nullable();
                $table->integer('recovery_count')->nullable();

                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['phone', 'phone_code']);
            });
            Schema::create('users_app_lang', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->unsigned();
                $table->string('locale')->index();
                $table->string('name_1')->nullable();
                $table->string('name_2')->nullable();
                $table->string('job_title')->nullable();
                $table->text('des')->nullable();
                $table->unique(['user_id', 'locale']);
                $table->foreign('user_id')->references('id')->on('users_app')->onDelete('cascade');
            });
            Schema::create('users_app_photos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('type');
                $table->string('size');
                $table->string('path');
                $table->foreign('user_id')->references('id')->on('users_app')->onDelete('cascade');
            });

        } elseif ($funType == 'down') {
            Schema::dropIfExists('users_app_photos');
            Schema::dropIfExists('users_app_lang');
            Schema::dropIfExists('users_app');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function tableUsersCard($funType) {
        if ($funType == 'up') {
            Schema::create('app_card_input', function (Blueprint $table) {
                $table->id();
                $table->integer('cat_id');
                $table->integer('vip')->nullable()->default(0);
                $table->string('input_id')->unique();
                $table->string('name_key');
                $table->string('icon_i')->nullable();
                $table->string('url')->nullable();
                $table->string('url_user')->nullable();
                $table->string('regex')->nullable();
                $table->string('err_ar')->nullable();
                $table->string('err_en')->nullable();
                $table->string('type')->nullable();
                $table->string('input_dir')->nullable();
                $table->integer('is_active')->default(1);
                $table->string('position')->nullable()->default(0);
                $table->string('position_vip')->nullable()->default(0);
            });
            Schema::create('app_card_input_lang', function (Blueprint $table) {
                $table->id();
                $table->foreignId('input_id')->constrained('app_card_input')->onDelete('cascade');
                $table->string('name')->nullable();
                $table->string('suggestion')->nullable();
                $table->string('locale', 10);
            });
            Schema::create('app_card', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->unsigned();
                $table->uuid()->unique();
                $table->string('slug', 100)->unique(); // كحد أقصى 100 حرف
                $table->string('card_name', 50); // الاسم لا يزيد عن 50 حرف
                $table->string('lang', 5); // كود اللغة لا يزيد عن 5 أحرف

                $table->integer('layout_id' )->nullable();
                $table->integer('template_id' )->nullable();


                $table->string('first_name', 50); // الاسم الأول لا يزيد عن 50 حرف
                $table->string('last_name', 50)->nullable(); // الاسم الأخير لا يزيد عن 50 حرف
                $table->string('prefix', 10)->nullable(); // اللقب لا يزيد عن 10 أحرف
                $table->string('middle_name', 50)->nullable(); // الاسم الأوسط لا يزيد عن 50 حرف
                $table->string('preferred_name', 50)->nullable(); // الاسم المفضل لا يزيد عن 50 حرف
                $table->string('job_title', 100)->nullable(); // المسمى الوظيفي لا يزيد عن 100 حرف
                $table->string('department', 100)->nullable(); // القسم لا يزيد عن 100 حرف
                $table->string('company_name', 100)->nullable(); // اسم الشركة لا يزيد عن 100 حرف
                $table->json('accreditations')->nullable(); // الاعتمادات تبقى كـ JSON
                $table->string('bio', 300)->nullable();

                $table->boolean('is_active')->default(false); // حالة التفعيل (true/false)

                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users_app')->onDelete('cascade');
            });
            Schema::create('app_card_template', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid()->unique();
                $table->bigInteger('card_id')->unsigned();
                $table->integer('layout_id');
                $table->string('color', 7)->nullable()->default('#dc3545'); // كود اللون لا يزيد عن 7 أحرف (كود HEX)
                $table->string('profile', 255)->nullable();
                $table->string('cover', 255)->nullable();
                $table->string('logo', 255)->nullable();
                  $table->json('config');
                $table->integer('is_active')->nullable()->default(true);
                $table->foreign('card_id')->references('id')->on('app_card')->onDelete('cascade');
            });
            Schema::create('app_card_data', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('card_id')->unsigned();
                $table->integer('cat_id');
                $table->integer('input_id');
                $table->string('input_key');
                $table->string('label')->nullable();
                $table->text('value')->nullable();
                $table->integer('position')->nullable()->default(0);
                $table->integer('is_active')->nullable()->default(true);
                $table->foreign('card_id')->references('id')->on('app_card')->onDelete('cascade');

            });



        } elseif ($funType == 'down') {


            Schema::dropIfExists('app_card_data');
            Schema::dropIfExists('app_card_template');
            Schema::dropIfExists('app_card');
            Schema::dropIfExists('app_card_input_lang');
            Schema::dropIfExists('app_card_input');
        }
    }




}
