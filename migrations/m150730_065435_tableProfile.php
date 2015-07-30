<?php

use yii\db\Schema;
use yii\db\Migration;

class m150730_065435_tableProfile extends Migration
{
    public function up()
    {
        $this->addColumn("question", "has_been_played", "boolean NOT NULL DEFAULT 0");
        $this->dropColumn("user", "score");

        $this->createTable("profile", array(
            "id" => "pk",
            "user_id" => "int NOT NULL",
            "audio_score" => "int",
            "photo_score" => "int",
            "group_score" => "int",
            "video_score" => "int",
            "score" => "int",
        ));

        $this->createIndex('relation', 'question_answer', ['question_id', 'answer_id'], true);


    }

    public function down()
    {
        $this->dropColumn("question", "has_been_played");
        $this->addColumn("user", "score", "int");

        $this->dropTable("profile");

        $this->dropIndex('relation', "question_answer");
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
