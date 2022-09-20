<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $name
 * @property string|null $image_id
 * @property string|null $body
 * @property int|null $price
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $image;
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'price'], 'integer'],
            [['body'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image_id'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'body' => 'Body',
            'price' => 'Price',
            'image_id' => "Image ID",
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductQuery(get_called_class());
    }

    /**
     * override save methodd
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        $isInsert = $this->isNewRecord;
        $image_id = Yii::$app->security->generateRandomString(8);
        $imagePath = Yii::getAlias('@frontend/web/storage/images/'.$image_id.'.jpg');
        if($isInsert){
            $this->image_id = $image_id;
        }
        $saved = parent::save($runValidation, $attributeNames);

        if(!$saved){
            return false;
        }
        if($isInsert){
            if(!is_dir(dirname($imagePath))){
                FileHelper::createDirectory(dirname($imagePath));
            }
            $this->image->saveAs($imagePath);
        }

        return true;
    }
    
}
