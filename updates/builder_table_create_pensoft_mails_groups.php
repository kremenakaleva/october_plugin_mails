<?php namespace Pensoft\Mails\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftMailsGroups extends Migration
{
    public function up()
    {
        Schema::create('pensoft_mails_groups', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('address');
            $table->text('goto');
            $table->text('moderators');
            $table->string('accesspolicy', 30);
            $table->string('domain');
            $table->smallInteger('active')->default(1);
            $table->string('reply_to')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pensoft_mails_groups');
    }
}
