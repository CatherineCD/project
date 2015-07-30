<?php

use yii\db\Schema;
use yii\db\Migration;

class m150730_091005_profile extends Migration
{
    public function up()
    {
        $this->alterColumn('profile', 'audio_score', 'int DEFAULT 0');
        $this->alterColumn('profile', 'photo_score', 'int DEFAULT 0');
        $this->alterColumn('profile', 'group_score', 'int DEFAULT 0');
        $this->alterColumn('profile', 'video_score', 'int DEFAULT 0');
        $this->alterColumn('profile', 'score', 'int DEFAULT 0');
    }

    public function down()
    {
        $this->alterColumn('profile', 'audio_score', 'int');
        $this->alterColumn('profile', 'photo_score', 'int');
        $this->alterColumn('profile', 'group_score', 'int');
        $this->alterColumn('profile', 'video_score', 'int');
        $this->alterColumn('profile', 'score', 'int');
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
