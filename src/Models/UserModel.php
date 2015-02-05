<?php
/**
 * This model handles all logic related to users.
 *
 * @property string $login
 * @property string $password
 * @property Post[] $posts
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class UserModel extends BaseModel
{
    /**
     * Returns corresponding table name.
     *
     * @codeCoverageIgnore
     *
     * @return string
     * @since 0.1.0
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * Before-save hook.
     *
     * @codeCoverageIgnore
     *
     * @return bool
     * @since 0.1.0
     */
    public function beforeSave()
    {
        parent::beforeSave();
        if ($this->getIsNewRecord()) {
            $this->password = StringHashProcessor::generate($this->password);
        }
        return true;
    }

    /**
     * Specifies relations.
     *
     * @codeCoverageIgnore
     *
     * @return array
     * @since 0.1.0
     */
    public function relations()
    {
        return array(
            'posts' => array(self::HAS_MANY, 'Post', 'user_id',),
        );
    }

    /**
     * Defines validation rules.
     *
     * @codeCoverageIgnore
     *
     * @return array
     * @since 0.1.0
     */
    public function rules()
    {
        return array(
            array(
                array('login',),
                'string',
                'min' => 3,
                'max' => 64,
                'allowEmpty' => false,
            ),
            array(
                array('password',),
                'string',
                'min' => 3,
                'allowEmpty' => false
            )
        );
    }

    /**
     * Returns attribute labels.
     *
     * @codeCoverageIgnore
     *
     * @return string[]
     * @since 0.1.0
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
        );
    }
}
