<?php

namespace app\models;

use app\models\User;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $ordernumber
 * @property int $created_by
 * @property int $written_by
 * @property int $edited_by
 * @property int $service_id
 * @property int $type_id
 * @property int $urgency_id
 * @property string $deadline
 * @property int $spacing_id
 * @property int $pages_id
 * @property int $level_id
 * @property int $subject_id
 * @property int $style_id
 * @property int $sources_id
 * @property int $language_id
 * @property int $pagesummary
 * @property int $plagreport
 * @property int $initialdraft
 * @property string $topic
 * @property string $instructions
 * @property int $qualitycheck
 * @property int $topwriter
 * @property string $phone
 * @property string $promocode
 * @property double $amount
 * @property int $cancelled
 * @property string $created_at
 *
 * @property Message[] $messages
 * @property Sources $service
 * @property Language $language
 * @property User $createdBy
 * @property User $writtenBy
 * @property User $editedBy
 * @property Type $type
 * @property Urgency $urgency
 * @property Pages $pages
 * @property Level $level
 * @property Subject $subject
 * @property Style $style
 * @property Sources $sources
 * @property Spacing $spacing
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'cancelled', 'ordernumber', 'created_by', 'written_by', 'edited_by',  'type_id', 'urgency_id', 'spacing_id', 'pages_id', 'level_id', 'subject_id', 'style_id', 'sources_id', 'language_id', 'pagesummary', 'plagreport', 'initialdraft', 'qualitycheck', 'topwriter'], 'integer'],
            [['topic', 'instructions','spacing_id', 'pages_id','service_id','type_id', 'urgency_id', 'level_id', 'subject_id', 'style_id', 'sources_id',], 'required'],
            [['instructions'], 'string'],
            [['created_at'], 'safe'],
            [['active','paid', 'completed','disputed','approved','rejected', 'editing','revision', 'available', 'confirmed', ],'boolean'],
            [['topic'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 255],
            [['amount'], 'number'],
            [['promocode'], 'string', 'max' => 100],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['written_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['written_by' => 'id']],
            [['edited_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['edited_by' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sources::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['urgency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Urgency::className(), 'targetAttribute' => ['urgency_id' => 'id']],
            [['pages_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['pages_id' => 'id']],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['style_id'], 'exist', 'skipOnError' => true, 'targetClass' => Style::className(), 'targetAttribute' => ['style_id' => 'id']],
            [['sources_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sources::className(), 'targetAttribute' => ['sources_id' => 'id']],
            [['spacing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spacing::className(), 'targetAttribute' => ['spacing_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ordernumber' => 'Ordernumber',
            'created_by' => 'Client',
            'written_by' => 'Writer',
            'edited_by' => 'Editor',
            'service_id' => 'Service',
            'type_id' => 'Type',
            'urgency_id' => 'Urgency',
            'deadline' => 'Deadline',
            'spacing_id' => 'Spacing',
            'pages_id' => 'Pages',
            'level_id' => 'Level',
            'subject_id' => 'Subject',
            'style_id' => 'Style',
            'sources_id' => 'Sources',
            'language_id' => 'Language',
            'pagesummary' => 'Pagesummary',
            'plagreport' => 'Plagreport',
            'initialdraft' => 'Initialdraft',
            'topic' => 'Topic',
            'instructions' => 'Instructions',
            'qualitycheck' => 'Qualitycheck',
            'topwriter' => 'Topwriter',
            'phone' => 'Phone',
            'promocode' => 'Promocode',
            'amount' => 'Amount',
            'cancelled' => 'Cancelled',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['order_number' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrittenBy()
    {
        return $this->hasOne(User::className(), ['id' => 'written_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'edited_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrgency()
    {
        return $this->hasOne(Urgency::className(), ['id' => 'urgency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasOne(Pages::className(), ['id' => 'pages_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStyle()
    {
        return $this->hasOne(Style::className(), ['id' => 'style_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSources()
    {
        return $this->hasOne(Sources::className(), ['id' => 'sources_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpacing()
    {
        return $this->hasOne(Spacing::className(), ['id' => 'spacing_id']);
    }

    /**
     * @inheritdoc
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }
}
