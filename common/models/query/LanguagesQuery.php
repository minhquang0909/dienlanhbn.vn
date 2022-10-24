<?php

namespace common\models\query;

use common\models\Languages;
/**
 * This is the ActiveQuery class for [[\common\models\Languages]].
 *
 * @see \common\models\Languages
 */
class LanguagesQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]='.Languages::STATUS_ACTIVE.'');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Languages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Languages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
