<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[Partners]].
 *
 * @see Partners
 */
class Supplier extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return Supplier[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Supplier|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
