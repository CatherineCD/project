<?php

use yii\db\Schema;
use yii\db\Migration;

class m150730_075737_updateTableGame extends Migration
{
    public function up()
    {
        $this->alterColumn("game", "finished", "datetime");
    }

    public function down()
    {
        $this->alterColumn("game", "finished", "datetime NOT NULL");
    }
}
