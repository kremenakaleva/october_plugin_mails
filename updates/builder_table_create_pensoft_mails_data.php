<?php namespace Pensoft\Mails\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMailsData extends Migration
{
    public function up()
    {
        Schema::create('pensoft_mails_data', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('group_id');
            $table->string('email');
            $table->string('type')->default('goto');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pensoft_mails_data');
    }
}
