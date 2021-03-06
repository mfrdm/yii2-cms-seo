<?php

namespace infoweb\seo\models;

use Yii;

/**
 * This is the model class for table "seo_lang".
 *
 * @property string $seo_id
 * @property string $language
 * @property string $title
 * @property string $description
 */
class SeoLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            // Only required for existing records
            [['seo_id'], 'required', 'when' => function($model) {
                return !$model->isNewRecord;
            }],
            // Trim
            [['title', 'description', 'keywords'], 'trim'],
            [['seo_id'], 'integer'],
            [['language'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 255],
            [['seo_id', 'language'], 'unique', 'targetAttribute' => ['seo_id', 'language'], 'message' => Yii::t('infoweb/seo', 'The combination of Seo ID and Language has already been taken.')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seo_id' => Yii::t('infoweb/seo', 'Seo ID'),
            'language' => Yii::t('app', 'Language'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('infoweb/seo', 'Keywords'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['id' => 'seo_id']);
    }
}