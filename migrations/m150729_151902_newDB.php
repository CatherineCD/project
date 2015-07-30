<?php

use yii\db\Schema;
use yii\db\Migration;

class m150729_151902_newDB extends Migration
{
    public function up()
    {
	    $this->dropIndex('relation', 'user_networks');
	    $this->dropTable("users");
	    $this->dropTable("networks");
	    $this->dropTable("user_networks");
	    $this->dropTable("news");

	    $this->createTable("user", array(
		    "id" => "pk",
		    "vk_id" => "int(11) NOT NULL",
		    "token" => "string",
		    "score" => "int(11)",
	    ));

	    $this->createTable("game", array(
		    "id" => "pk",
		    "started" => "datetime NOT NULL",
		    "finished" => "datetime NOT NULL",
		    "score" => "int(11)",
		    "user_id" => "int NOT NULL",
	    ));

	    $this->createTable("question", array(
		    "id" => "pk",
		    "type" => "ENUM ('audio', 'video', 'photo', 'group') NOT NULL DEFAULT 'audio'",
		    "url" => "string NOT NULL",
		    "content_name" => "string NOT NULL",
		    "score" => "int",
		    "game_id" => "int NOT NULL",
	    ));

	    $this->createTable("answer", array(
		    "id" => "pk",
		    "name" => "string NOT NULL",
		    "avatar_url" => "string NOT NULL",
		    "vk_id" => "int NOT NULL",
	    ));

	    $this->createTable("question_answer", array(
		    "id" => "pk",
		    "question_id" => "int NOT NULL",
		    "answer_id" => "int NOT NULL",
		    "is_right" => "boolean NOT NULL",
	    ));
    }

    public function down()
    {
	    $this->dropTable("user");
	    $this->dropTable("game");
	    $this->dropTable("question");
	    $this->dropTable("answer");
	    $this->dropTable("question_answer");

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

	    $this->createIndex('relation', 'user_networks', ['user_id', 'network_id'], true);
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
