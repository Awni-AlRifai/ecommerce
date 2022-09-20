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
     * {@inheritdoc}
     * Overrides the method save in order to save an image
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        // check if the record is new
        $isInsert = $this->isNewRecord;

        $image_id = Yii::$app->security->generateRandomString(8);
        $imagePath = Yii::getAlias('@frontend/web/storage/images/' . $image_id . '.jpg');

        // set image_id to use it for the name of the saved file
        if ($isInsert) {
            $this->image_id = $image_id;
        }

        $saved = parent::save($runValidation, $attributeNames);

        if (!$saved) {
            return false;
        }
        // save image
        if ($isInsert) {
            if (!is_dir(dirname($imagePath))) {

                // create a new directoy if it does not exists
                // the storage directory is added to the .gitignore in order to have
                // a clean storage when deploying
                FileHelper::createDirectory(dirname($imagePath));
            }

            $this->image->saveAs($imagePath);
        }

        return true;
    }

    /**
     * gets the image link related to a product.
     */
    public function getImageLink()
    {

        return  Yii::$app->params['frontendUrl'] . "storage/images/{$this->image_id}.jpg";
    }
}
