<?php namespace Pensoft\Mails\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftMailsGroups2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_mails_groups', function($table)
        {
            $table->renameColumn('add_replay_to', 'add_reply_to');
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_mails_groups', function($table)
        {
            $table->renameColumn('add_reply_to', 'add_replay_to');
        });
    }
}
