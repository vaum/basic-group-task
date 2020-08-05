<?php

use yii\db\Migration;

/**
 * Class m200805_085951_CREATE_transaction_tbl
 */
class m200805_085951_CREATE_transaction_tbl extends Migration
{
    public $tableName = 'transaction';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'sender' => $this->string(),
            'receiver' => $this->string(),
            'amount' => $this->float(2),
            'dateTime' => $this->dateTime()
        ]);

        $this->addForeignKey('fk-sender-username', $this->tableName, 'sender',
            'user', 'username');
        $this->addForeignKey('fk-receiver-username', $this->tableName, 'receiver',
            'user', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-sender-username', $this->tableName);
        $this->dropForeignKey('fk-receiver-username', $this->tableName);

        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200805_085951_CREATE_transaction_tbl cannot be reverted.\n";

        return false;
    }
    */
}
