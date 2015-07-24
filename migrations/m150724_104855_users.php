<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_104855_users extends Migration
{
    public function up()
    {
        $this->createTable("users", array(
            "id" => "pk",
            "email" => "string NOT NULL",
            "password" => "string NOT NULL",
        ));

        $this->createTable("networks", array(
            "id" => "pk",
            "name" => "string NOT NULL",
            "src" => "string NOT NULL",
        ));


        $this->createTable("user_networks", array(
            "id" => "pk",
            "user_id" => "int",
            "network_id" => "int",
            "token" => "string"
        ));

        $this->createTable("news", array(
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
        $this->dropTable("users");
        $this->dropTable("networks");
        $this->dropTable("user_networks");
        $this->dropTable("news");
    }
}
