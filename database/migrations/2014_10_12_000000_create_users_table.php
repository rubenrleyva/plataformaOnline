<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Tabla encargada de los roles.
        Schema::create('roles', function (Blueprint $table) {
    		$table->bigIncrements('id');
    		$table->string('name')->comment('Nombre del rol de usuario');
    		$table->text('description');
    		$table->timestamps();
	    });

        // Tabla encargada de los ususarios.
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id')->default(\App\Role::STUDENT);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('name');
	        $table->string('last_name')->nullable();
	        $table->string('slug');
            $table->string('email')->unique();
            $table->string('password')->nullable();
	        $table->string('picture')->nullable();
	        $table->string('stripe_id')->nullable();
	        $table->string('card_brand')->nullable();
	        $table->string('card_last_four')->nullable();
	        $table->timestamp('trial_ends_at')->nullable();
	        $table->rememberToken();
	        $table->timestamps();
        });

        // Tabla encargada de las suscripciones.
	    Schema::create('subscriptions', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->unsignedBigInteger('user_id');
		    $table->foreign('user_id')->references('id')->on('users');
		    $table->string('name');
		    $table->string('stripe_id');
		    $table->string('stripe_plan');
		    $table->integer('quantity');
		    $table->timestamp('trial_ends_at')->nullable();
		    $table->timestamp('ends_at')->nullable();
		    $table->timestamps();
	    });

        // Tabla encargada de las cuentas sociales de los usuarios.
	    Schema::create('user_social_accounts', function(Blueprint $table){
		    $table->bigIncrements('id');
		    $table->unsignedBigInteger('user_id');
		    $table->foreign('user_id')->references('id')->on('users');
		    $table->string('provider');
		    $table->string('provider_uid');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('user_social_accounts');
    }
}
