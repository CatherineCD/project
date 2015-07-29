<?php

use yii\db\Schema;
use yii\db\Migration;

class m150729_060910_tableMessage extends Migration
{
    public function up()
    {
        $this->createTable("messages", array(
            "id" => "pk",
            "title" => "string NOT NULL",
            "content" => "string NOT NULL",
            "date" => "date NOT NULL",
            "user_networks_id" => "int NOT NULL",
            "original_id" => "int NOT NULL",
        ));
    }

    public function down()
    {
        $this->dropTable("news");
    }
}
