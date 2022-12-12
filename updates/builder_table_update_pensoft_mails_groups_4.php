<?php namespace Pensoft\Mails\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMailsGroups4 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_mails_groups', function($table)
        {
            $table->smallInteger('active')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_mails_groups', function($table)
        {
            $table->smallInteger('active')->nullable(false)->change();
        });
    }
}
