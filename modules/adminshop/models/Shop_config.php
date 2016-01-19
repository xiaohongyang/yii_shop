<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/31
 * Time: 17:52
 */

namespace app\modules\adminshop\models;


use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\db\ActiveRecord;

class Shop_config extends ActiveRecord{

    /**
     * @param null $keyColumn 'id'|'code'
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

    /**
     * 获得设置信息
     *
     * @param null $groups  需要获得的设置组
     * @param null $excludes 不需要获得的设置组
     * @return array
     */
    public function get_settings($groups=null, $excludes=null)
    {
        global $db, $ecs, $_LANG;


        /* 取出全部数据：分组和变量 */

        $query = $this->find();

        $query->andWhere("type<>'hidden'");

        if (!empty($groups)) {
            foreach ($groups AS $key => $val) {
                $query->andWhere(['id' => $val, 'parent_id' => $val]);
            }
        }
        if (!empty($excludes)) {
            foreach ($excludes AS $key => $val) {
                $query->andWhere('parent_id <>' . $val .' and id <>' . $val);
            }
        }

        //排序
        $query->orderBy(['parent_id'=>SORT_ASC]);
        $query->addOrderBy(['sort_order' => SORT_ASC]);
        $query->addOrderBy(['id' => SORT_ASC]);

        //获取数组
        $command = $query->createCommand();
        $list = $command->queryAll();


        $sql = $query->createCommand()->getRawSql();




        /* 整理数据 */
        $group_list = array();
        foreach ($list AS $key => $item)
        {
            $pid = $item['parent_id'];
            $item['name'] = isset($_LANG['cfg_name'][$item['code']]) ? $_LANG['cfg_name'][$item['code']] : $item['code'];
            $item['desc'] = isset($_LANG['cfg_desc'][$item['code']]) ? $_LANG['cfg_desc'][$item['code']] : '';

            if ($item['code'] == 'sms_shop_mobile')
            {
                $item['url'] = 1;
            }
            if ($pid == 0)
            {
                //分组
                if ($item['type'] == 'group')
                {
                    $group_list[$item['id']] = $item;
                }
            }
            else
            {
                //变量
                if (isset($group_list[$pid]))
                {
                    if ($item['store_range'])
                    {
                        $item['store_options'] = explode(',', $item['store_range']);

                        foreach ($item['store_options'] AS $k => $v)
                        {
                            $item['display_options'][$k] = isset($_LANG['cfg_range'][$item['code']][$v]) ?
                                $_LANG['cfg_range'][$item['code']][$v] : $v;
                        }
                    }
                    $group_list[$pid]['vars'][] = $item;
                }
            }

        }

        return $group_list;
    }



    public function load_config()
    {
        $arr = array();


        /*$sql = 'SELECT code, value FROM ' . $GLOBALS['ecs']->table('shop_config') . ' WHERE parent_id > 0';
        $res = $GLOBALS['db']->getAll($sql);*/

        $query = $this->find();
        $query->andWhere( "parent_id > 0" );
        $command = $query->createCommand();
        $res = $command->queryAll();

        foreach ($res AS $row)
        {
            $arr[$row['code']] = $row['value'];
        }

        /* 对数值型设置处理 */
        $arr['watermark_alpha']      = intval($arr['watermark_alpha']);
        $arr['market_price_rate']    = floatval($arr['market_price_rate']);
        $arr['integral_scale']       = floatval($arr['integral_scale']);
        //$arr['integral_percent']     = floatval($arr['integral_percent']);
        $arr['cache_time']           = intval($arr['cache_time']);
        $arr['thumb_width']          = intval($arr['thumb_width']);
        $arr['thumb_height']         = intval($arr['thumb_height']);
        $arr['image_width']          = intval($arr['image_width']);
        $arr['image_height']         = intval($arr['image_height']);
        $arr['best_number']          = !empty($arr['best_number']) && intval($arr['best_number']) > 0 ? intval($arr['best_number'])     : 3;
        $arr['new_number']           = !empty($arr['new_number']) && intval($arr['new_number']) > 0 ? intval($arr['new_number'])      : 3;
        $arr['hot_number']           = !empty($arr['hot_number']) && intval($arr['hot_number']) > 0 ? intval($arr['hot_number'])      : 3;
        $arr['promote_number']       = !empty($arr['promote_number']) && intval($arr['promote_number']) > 0 ? intval($arr['promote_number'])  : 3;
        $arr['top_number']           = intval($arr['top_number'])      > 0 ? intval($arr['top_number'])      : 10;
        $arr['history_number']       = intval($arr['history_number'])  > 0 ? intval($arr['history_number'])  : 5;
        $arr['comments_number']      = intval($arr['comments_number']) > 0 ? intval($arr['comments_number']) : 5;
        $arr['article_number']       = intval($arr['article_number'])  > 0 ? intval($arr['article_number'])  : 5;
        $arr['page_size']            = intval($arr['page_size'])       > 0 ? intval($arr['page_size'])       : 10;
        $arr['bought_goods']         = intval($arr['bought_goods']);
        $arr['goods_name_length']    = intval($arr['goods_name_length']);
        $arr['top10_time']           = intval($arr['top10_time']);
        $arr['goods_gallery_number'] = intval($arr['goods_gallery_number']) ? intval($arr['goods_gallery_number']) : 5;
        $arr['no_picture']           = !empty($arr['no_picture']) ? str_replace('../', './', $arr['no_picture']) : 'images/no_picture.gif'; // 修改默认商品图片的路径
        $arr['qq']                   = !empty($arr['qq']) ? $arr['qq'] : '';
        $arr['ww']                   = !empty($arr['ww']) ? $arr['ww'] : '';
        $arr['default_storage']      = isset($arr['default_storage']) ? intval($arr['default_storage']) : 1;
        $arr['min_goods_amount']     = isset($arr['min_goods_amount']) ? floatval($arr['min_goods_amount']) : 0;
        $arr['one_step_buy']         = empty($arr['one_step_buy']) ? 0 : 1;
        $arr['invoice_type']         = empty($arr['invoice_type']) ? array('type' => array(), 'rate' => array()) : unserialize($arr['invoice_type']);
        $arr['show_order_type']      = isset($arr['show_order_type']) ? $arr['show_order_type'] : 0;    // 显示方式默认为列表方式
        $arr['help_open']            = isset($arr['help_open']) ? $arr['help_open'] : 1;    // 显示方式默认为列表方式

        if (!isset($GLOBALS['_CFG']['ecs_version']))
        {
            /* 如果没有版本号则默认为1.0.0 */
            $GLOBALS['_CFG']['ecs_version'] = 'v1.0.0';
        }

        //限定语言项
        $lang_array = array('zh_cn', 'zh_tw', 'en_us');
        if (empty($arr['lang']) || !in_array($arr['lang'], $lang_array))
        {
            $arr['lang'] = 'zh_cn'; // 默认语言为简体中文
        }

        if (empty($arr['integrate_code']))
        {
            $arr['integrate_code'] = 'ecshop'; // 默认的会员整合插件为 ecshop
        }


        return $arr;
    }

    /**
     * //处理表单提交
     * @param $post
     */
    public function postDataHandle($post){

        $valueArr = $post['value'];

        $uploadArr = $post['UploadForm'];
        $invoiceTypeValue = array(
            'type' => $post['invoice_type'],
            'rate' => $post['invoice_rate']
        );

        $uploadForm = new Uploadform( );
        $uploadForm->setFileTableName( Uploadform::TABLE_NAME_SHOP_CONFIG );

        //更新上传文件缓存表
        foreach ($uploadArr as $k=>$file_name) {

            $column_value = null;
            if ( $file_name && $column_value = array_search($file_name, $valueArr) ) {

                $uploadId = Uploadform::getIdByFileName($file_name, Uploadform::TABLE_NAME_SHOP_CONFIG);
                $uploadForm->updateColumnValue($uploadId, $column_value);
            }
        }

        //保存Shop_config表
        foreach( $valueArr as $id=>$value ){

            $modle = $this->findOne($id);
            if($modle->value == $value)
                continue;

            //图片路径
            if(in_array($value, array_values($uploadArr) ))
                $modle->store_dir = $uploadForm->getDir();

            $modle->value = $value;
            $modle->save();
        }

        //保存税率
        $dataInvoiceType = $modle->findOne(['code' => 'invoice_type']);
        $invoiceTypeValue = serialize( $invoiceTypeValue );
        if( $dataInvoiceType->value != $invoiceTypeValue ){

            $dataInvoiceType->value = $invoiceTypeValue;
            $dataInvoiceType->save();
        }

    }

}