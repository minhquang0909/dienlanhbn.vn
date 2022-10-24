<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\ProductCategory;
use yii\db\ActiveQuery;

class ProductCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere(['status' => ProductCategory::STATUS_ACTIVE]);
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%product_category}}.parent_id IS NULL');

        return $this;
    }
}
