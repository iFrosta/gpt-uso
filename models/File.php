<?php


namespace app\models;

use app\controllers\FileUploadBehavior;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class File
 * @package app\models
 *
 * @property int $id
 * @property string $title
 * @property int $date_in
 * @property int $number
 * @property int $created_at
 * @property int updated_at
 * @property int $category_id
 * @property string $path
 *
 * @property-read Category $category
 */
class File extends ActiveRecord
{

//    public function behaviors()
//    {
//        return [TimestampBehavior::class,];
//    }

 public function behaviors()
  {
      return [
         TimestampBehavior::class,
         [
           'class' => FileUploadBehavior::class,
           'storagePath' => '@storage',
           'uploadPath' => '/uploads/images',
           'attributes' => ['path'],
//           'callback' => function (string $filename) {...},
         ],
      ];
  }

    public function attributeLabels()
    {
        return [
            'id' => '#',
            'title' => 'Наименование',
            'date_in' => 'Дата ввода в действие',
            'number' => 'Номер документа',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата последнего изменения',
            'category_id' => 'Категория документа',
            'path' => 'Путь к файлу',
        ];
    }

    public static function tableName()
    {
        return 'files';
    }

    public function rules()
    {
        return [
            [['title', 'date_in', 'number', 'category_id'], 'required'],
            [['title'], 'string'],
            [['number', 'category_id'], 'integer'],
            [['title'], 'string', 'min' => 5],
            [['path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf'],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }


}