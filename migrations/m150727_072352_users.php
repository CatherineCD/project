<?php

use yii\db\Schema;
use yii\db\Migration;

class m150727_072352_users extends Migration
{
    public function up()
    {
        $this->createIndex('relation', 'user_networks', ['user_id', 'network_id'], true);
    }

    public function down()
    {
        return false;
    }

}
