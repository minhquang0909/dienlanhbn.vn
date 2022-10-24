<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\ServiceCategory;
use yii\db\ActiveQuery;

class ServiceCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere(['status' => ServiceCategory::STATUS_ACTIVE]);
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%service_category}}.parent_id IS NULL');

        return $this;
    }
}
