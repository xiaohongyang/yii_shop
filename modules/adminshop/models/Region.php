<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/8/4
 * Time: 17:55
 */

namespace app\modules\adminshop\models;


use yii\db\ActiveRecord;

class Region extends ActiveRecord{



    public function get_regions($type = 0, $parent = 0)
    {

        /*$sql = 'SELECT region_id, region_name FROM ' . $GLOBALS['ecs']->table('region') .
            " WHERE region_type = '$type' AND parent_id = '$parent'";*/


        $query = $this->find();
        $query->andWhere( ['region_type' => $type] );
        $query->andWhere( ['parent_id' => $parent] );

        $command = $query->createCommand();
        $rs = $command->queryAll();

        return $rs;
    }

}