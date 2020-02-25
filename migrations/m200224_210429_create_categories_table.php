<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m200224_210429_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
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
        $this->dropTable('categories');
    }

    private function insertData()
    {
        $this->insert('categories', [
            'id' => 1,
            'title' => 'Охрана труда',
        ]);
        $this->insert('categories', [
            'id' => 2,
            'title' => 'Промышленная безопасность',
        ]);
        $this->insert('categories', [
            'id' => 3,
            'title' => 'Пожарная безопасность',
        ]);
        $this->insert('categories', [
            'id' => 4,
            'title' => 'Безопасность дорожного движения',
        ]);
        $this->insert('categories', [
            'id' => 5,
            'title' => 'Безопасность движения',
        ]);
    }
}
