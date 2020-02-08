<?php

use yii\db\Migration;

/**
 * Handles the creation of table `positions`.
 */
class m191218_083526_create_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('positions', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);

        $this->insertData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('positions');
    }

    private function insertData()
    {
        $this->insert('positions', [
            'id' => 1,
            'title' => 'Составитель поездов',
        ]);
        $this->insert('positions', [
            'id' => 2,
            'title' => 'Приёмосдатчик груза и багажа',
        ]);
        $this->insert('positions', [
            'id' => 3,
            'title' => 'Оператор при дежурном по станции',
        ]);
        $this->insert('positions', [
            'id' => 4,
            'title' => 'Дежурный по станции',
        ]);
        $this->insert('positions', [
            'id' => 5,
            'title' => 'Старший диспетчер',
        ]);
        $this->insert('positions', [
            'id' => 6,
            'title' => 'Мастер УП',
        ]);
        $this->insert('positions', [
            'id' => 7,
            'title' => 'Начальник СП и МР',
        ]);
        $this->insert('positions', [
            'id' => 8,
            'title' => 'Начальник ОП и МР',
        ]);
        $this->insert('positions', [
            'id' => 9,
            'title' => 'Начальник УП',
        ]);
        $this->insert('positions', [
            'id' => 10,
            'title' => 'Ведущий инженер',
        ]);
        $this->insert('positions', [
            'id' => 11,
            'title' => 'Инженер 1-ой категории',
        ]);
        $this->insert('positions', [
            'id' => 12,
            'title' => 'Инженер 2-ой категории',
        ]);
        $this->insert('positions', [
            'id' => 13,
            'title' => 'Общие',
        ]);
    }
}
