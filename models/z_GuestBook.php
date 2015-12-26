<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/1
 * Time: 17:40
 */

namespace app\models;



use app\modules\admin\models\BaseModel;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

class GuestBook extends BaseModel{

    public function behaviors()
    {
        return [
          [
              'class'   =>  TimestampBehavior::className(),
              'attributes'  =>  [
                  ActiveRecord::EVENT_BEFORE_INSERT  =>  ['add_time',    'up_time'],
                  ActiveRecord::EVENT_BEFORE_UPDATE  =>  ['add_time',    'up_time'],
              ]
          ]
        ];
    }

    public function create_data($data){

        $obj = new GuestBook;
        $obj->attributes = $data;
        return $obj->save();
    }

    public function update_data($data=[]){

        $obj = GuestBook::find()->where(['id'=>3])->one() ;


        $obj->save(false, ['up_time']);
        var_dump($obj->up_time);

    }

    public function update_data_count(){

        $obj = GuestBook::findOne(3);
        $this->_update_data_count($obj, ['up_time','add_time'], [1,5]);

    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname'], 'required'],
            [['nickname'], 'unique'],
            [['id'], 'integer']
        ];
    }

    public function attributeLables()
    {
        return [
            'id'    =>  'id',
            'nickname'  =>  '昵称',
            'add_time'  =>  '评论时间',
            'up_time'   =>  '更新时间'
        ];
    }


    public function getOneRow($id)
    {
        if ($model = $this->findOne($id) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException("数据不存在!");
        }
    }

    public function getListRow($searchParam)
    {

        $query = GuestBook::find();

        $query->andFilterWhere([
           '>', 'id', 0
        ]);

        $totalCount = $query->count();



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $totalCount = $dataProvider->totalCount;

        $page = new Pagination([
            'totalCount'    =>  $totalCount,
            'pageSize'      =>  2
        ]);

        $dataList = $query->offset($page->offset)->limit($page->limit)->all();


        return $page;

//        $query = GuestBook::find();
//
//        $dataProvider =  new ActiveDataProvider(
//            ['query' =>  $query]
//        );
//
//
//        return $dataProvider;

    }

}