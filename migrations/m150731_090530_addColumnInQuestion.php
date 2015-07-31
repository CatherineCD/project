<?php

use yii\db\Schema;
use yii\db\Migration;

class m150731_090530_addColumnInQuestion extends Migration
{
    public function up()
    {
        $this->addColumn("question", "answer_id", "int NOT NULL DEFAULT 0");
        $this->dropColumn("question", "has_been_played");
    }

    public function down()
    {
        $this->dropColumn("question", "answer_id");
        $this->addColumn("question", "has_been_played", "boolean NOT NULL DEFAULT 0");

    }

}
