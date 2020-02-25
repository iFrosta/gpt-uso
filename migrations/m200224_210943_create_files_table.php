<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files`.
 */
class m200224_210943_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->comment('Наименование'),
            'date_in' => $this->date()->comment('Дата ввода в действие'),
            'number' => $this->integer()->comment('Номер документа'),
            'created_at' => $this->integer()->comment('Дата добавления'),
            'updated_at' => $this->integer()->comment('Дата изменения'),
            'category_id' => $this->integer()->comment('Категория документа'),
            'path' => $this->string()->comment('Путь к файлу'),
        ]);

        $this->addForeignKey(
            'fk_file_category',
            'files', 'category_id',
            'categories', 'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_file_category', 'files');
        $this->dropTable('files');
    }
}
