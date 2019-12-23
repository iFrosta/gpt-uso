<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m191219_203934_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'access_token' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'third_name' => $this->string()->notNull(),
            'telny_number' => $this->integer()->notNull(),
            'position_id' => $this->integer(),
            'date_birth' => $this->date()->notNull(),
            'date_receipt' => $this->date()->notNull(),
            'status' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk_user_position',
            'users', 'position_id',
            'positions', 'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_position', 'users');
        $this->dropTable('users');
    }
}
