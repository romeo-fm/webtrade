<?php

class m140424_085336_user_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('user', array(
            'id' => 'pk',
            'username' => 'VARCHAR(100) NOT NULL',
            'password' => 'VARCHAR(32) NOT NULL',
			'last_login' => 'datetime NOT NULL'
        ));
    }

    public function down()
    {
        $this->dropTable('user');
    }
}