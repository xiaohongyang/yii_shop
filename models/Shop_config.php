<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/30
 * Time: 11:05
 */

namespace app\models;


use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Shop_config extends ActiveRecord{


    /**
     * @param null $keyColumn
     * @return array
     */
    public function getList( $keyColumn=null )
    {

        $sql = $this->find();

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $sql,
            ]

        );

        $data = $dataProvider->getModels();

        foreach ($data as &$_v) {

            $copyModel = clone($_v);
            $_v = $_v->toArray();
            $_v['getModel'] = $copyModel;
        }

        //重新设置数组key值
        if ($keyColumn != null && in_array($keyColumn, ['id', 'code']) ) {

            $result = array();
            foreach ($data as $_k=>$_v) {

                $result[$_v[$keyColumn]] = $_v;
            }

            $data = $result;
        }

        return $data;
    }


    public function getListtree()
    {

        $data = $this->getList();

        $listTree = list_to_tree($data, 'id', 'parent_id');

    }


}