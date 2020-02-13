<?php

use yii\db\Migration;

/**
 * Handles the creation of table `results`.
 */
class m200208_175352_create_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('results', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->comment('Номер теста'),
            'user_id' => $this->integer()->comment('Создатель события'),
            'date_test' => $this->string()->comment('Дата тестирования'),
            'attempts' => $this->integer()->comment('Количество попыток'),
            'quantity' => $this->integer()->comment('Количество баллов'),
            'status' => $this->boolean()->defaultValue(0)->comment('Результат'),
        ]);

//        $this->createIndex('user_id', 'results', 'user_id');
//        $this->createIndex('test_name', 'results', 'test_name');

        // создание реляционной связи на пользователей
        $this->addForeignKey(
            'fk_result_user',
            'results', 'user_id',
            'users', 'id',
            'cascade'
        );
        $this->addForeignKey(
            'fk_result_test',
            'results', 'test_id',
            'tests', 'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_result_user', 'results');
        $this->dropForeignKey('fk_result_test', 'results');
        $this->dropTable('results');
    }
}
