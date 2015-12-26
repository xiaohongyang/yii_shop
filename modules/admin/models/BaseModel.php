<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/5
 * Time: 9:26
 */

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord{

    /**
     * update count column
     * @param ActiveRecord $oneData
     * @param $filedArray     update column array
     * @param $step           update count number or update count number array
     * e.g
            $obj = GuestBook::findOne(3);
            $this->_update_data_count($obj, ['up_time'], 1);
     */
    public function _update_data_count(ActiveRecord $oneData, $filedArray , $step){

        $arr = array();

        if (is_array($filedArray) && count($filedArray)) {
            foreach($filedArray as $_k => $_v){
                $arr[$_v] = is_array($step)?$step[$_k]:$step;
            }
        }

        $oneData->updateCounters($arr);

    }



    private $_listAndPage = [];

    public function setListAndPage($lists, $pagination)
    {
        $this->_listAndPage = [
            'lists' =>  $lists,
            'pagination' =>  $pagination
        ];
    }
    public function getListAndPage()
    {
        return $this->_listAndPage;
    }

    private $_dataProviderAndPagination = [];
    /**
     * @return array
     */
    public function getDataProviderAndPagination()
    {
        return $this->_dataProviderAndPagination;
    }/**
     * @param array $dataProviderAndPagination
     */
    public function setDataProviderAndPagination($dataProvider, $pagination)
    {
        $this->_dataProviderAndPagination = [
            'dataProvider'  =>  $dataProvider,
            'pagination'    =>  $pagination
        ];
    }
}