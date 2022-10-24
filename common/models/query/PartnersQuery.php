<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[Partners]].
 *
 * @see Partners
 */
class PartnersQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->where('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return Partners[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Partners|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
