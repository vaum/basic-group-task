<?php

use yii\db\Migration;

/**
 * Class m200805_073053_CREATE_user_tbl
 */
class m200805_073053_CREATE_user_tbl extends Migration
{
    public $tableName = 'user';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->unique()->notNull(),
            'balance' => $this->float(2)->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200805_073053_CREATE_user_tbl cannot be reverted.\n";

        return false;
    }
    */
}
