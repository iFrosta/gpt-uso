<?php

use yii\db\Migration;

/**
 * Handles the creation of table `activities`.
 */
class m191223_044010_create_activities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activities', [
            'id' => $this->primaryKey()->comment('Порядковый номер'),
            'title' => $this->string()->notNull()->comment('Название события'),
            'date_start' => $this->string()->comment('Дата начала'),
            'date_end' => $this->string()->comment('Дата окончания'),
            'user_id' => $this->integer()->comment('Создатель события'),
            'description' => $this->text()->comment('Описание события'),
            'repeat' => $this->boolean()->comment('Может ли повторяться'),
            'blocked' => $this->boolean()->comment('Блокирует ли даты'),
            'created_at' => $this->integer()->comment('Дата создания'),
            'updated_at' => $this->integer()->comment('Дата обновления'),
        ]);

        // создание реляционной связи на пользователей
        $this->addForeignKey(
            'fk_activity_user',
            'activities', 'user_id',
            'users', 'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_activity_user', 'activities');
        $this->dropTable('activities');
    }
}
