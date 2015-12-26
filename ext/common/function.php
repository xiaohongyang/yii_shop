<?php




//跳转扩展
use yii\web\Response;

include_once "../ext/jumpage/jumpage.php";

include_once "../ext/conf/conf.php" ;



/**
 * Author: 清风明月 258082291@qq.com
 * User: Administrator
 * Date: 14-8-1
 * Time: 下午1:06
 */
/**
 * 格式化输出
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function p($str, $pos=0) {
    $pos = $pos ? 'phpPrintDefineFixed' : '';
    if(is_null($str) OR is_bool($str)) {
        var_dump($str);
    } else {
        echo '<pre class="phpPrintDefine '.$pos.'">'.print_r($str,1).'</pre>';
    }
}


/**
 * retun Yii::$app->user
 *
 * @return mixed|\yii\web\User
 */
function user()
{
    return Yii::$app->user;
}


/**
 * 操作错误跳转的快捷方法
 *
 * @access protected
 * @param string $message 错误信息
 * @param string $jumpUrl 页面跳转地址
 * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
 * @return void
 */
function jump_error($message = '', $jumpUrl = '', $ajax = false, $timeWait=null)
{

    $jump = new ext\jumpage\jumpage();

    if (!is_null($timeWait)) {

        $jump->setErrorWait($timeWait);
    }

    $jump->error($message, $jumpUrl, $ajax ) ;
}

/**
 * 操作成功跳转的快捷方法
 * @access protected
 * @param string $message 提示信息
 * @param string $jumpUrl 页面跳转地址
 * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
 * @return void
 */
function jump_success($message = '', $jumpUrl = '', $ajax = false, $timeWait=null)
{
    $jump = new ext\jumpage\jumpage();

    if (!is_null($timeWait)) {

        $jump->setSuccessWait($timeWait);
    }

    $jump->success($message , $jumpUrl, $ajax );

}


/**
 * Translates a message to the specified language.
 *
 * This is a shortcut method of [[\yii\i18n\I18N::translate()]].
 *
 * The translation will be conducted according to the message category and the target language will be used.
 *
 * You can add parameters to a translation message that will be substituted with the corresponding value after
 * translation. The format for this is to use curly brackets around the parameter name as you can see in the following example:
 *
 * ```php
 * $username = 'Alexander';
 * echo \Yii::t('app', 'Hello, {username}!', ['username' => $username]);
 * ```
 *
 * Further formatting of message parameters is supported using the [PHP intl extensions](http://www.php.net/manual/en/intro.intl.php)
 * message formatter. See [[\yii\i18n\I18N::translate()]] for more details.
 *
 * @param string $category the message category.
 * @param string $message the message to be translated.
 * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
 * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
 * [[\yii\base\Application::language|application language]] will be used.
 * @return string the translated message.
 */
function t($category=null, $message=null, $params = [], $language = null)
{
    if ($message === null) {

        $message = $category;
        $category = 'app';

        return \Yii::t($category, $message, $params, $language);
    } else {

        return \Yii::t($category, $message, $params, $language);
    }
}


/**
 * return string by multi-translative world joined
 *
 * @param $category
 * @param array $message
 * @param string $joinChars
 * @param string $endChars
 * @return string
 */
function t_arr($category, array $message, $joinChars="", $endChars="")
{

    $string = "";
    if (is_array($message) && count($message)) {
        foreach ($message as $_k => $_v) {
            $thisString = t($category, $_v);

            $string = $string==""?$thisString : $string.$joinChars.$thisString;
        }
    }
    return $string.$endChars;

}

/**
 * 获取汉字的拼音
 * @param $_String
 * @param string $_Code
 * @return mixed
 */
function pin_yin($_String, $_Code='UTF8'){
    //fn:获取拼音
    //GBK页面可改为gb2312，其他随意填写为UTF8
    $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha".
        "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|".
        "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er".
        "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui".
        "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang".
        "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang".
        "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue".
        "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne".
        "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen".
        "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang".
        "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|".
        "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|".
        "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu".
        "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you".
        "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|".
        "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";
    $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990".
        "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725".
        "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263".
        "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003".
        "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697".
        "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211".
        "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922".
        "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468".
        "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664".
        "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407".
        "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959".
        "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652".
        "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369".
        "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128".
        "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914".
        "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645".
        "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149".
        "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087".
        "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658".
        "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340".
        "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888".
        "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585".
        "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847".
        "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055".
        "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780".
        "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274".
        "|-10270|-10262|-10260|-10256|-10254";
    $_TDataKey   = explode('|', $_DataKey);
    $_TDataValue = explode('|', $_DataValue);
    $_Data = array_combine($_TDataKey, $_TDataValue);
    arsort($_Data);
    reset($_Data);
    if($_Code!= 'gb2312') $_String = _U2_Utf8_Gb($_String);
    $_Res = '';
    for($i=0; $i<strlen($_String); $i++) {
        $_P = ord(substr($_String, $i, 1));
        if($_P>160) {
            $_Q = ord(substr($_String, ++$i, 1)); $_P = $_P*256 + $_Q - 65536;
        }
        $_Res .= _pin_yin($_P, $_Data);
    }
    return preg_replace("/[^a-z0-9]*/", '', $_Res);
}
function _pin_yin($_Num, $_Data){
    //fn:获取拼音
    if($_Num>0 && $_Num<160 ){
        return chr($_Num);
    }elseif($_Num<-20319 || $_Num>-10247){
        return '';
    }else{
        foreach($_Data as $k=>$v){ if($v<=$_Num) break; }
        return $k;
    }
}
function _U2_Utf8_Gb($_C){
    //fn:字符转换
    $_String = '';
    if($_C < 0x80){
        $_String .= $_C;
    }elseif($_C < 0x800) {
        $_String .= chr(0xC0 | $_C>>6);
        $_String .= chr(0x80 | $_C & 0x3F);
    }elseif($_C < 0x10000){
        $_String .= chr(0xE0 | $_C>>12);
        $_String .= chr(0x80 | $_C>>6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    }elseif($_C < 0x200000) {
        $_String .= chr(0xF0 | $_C>>18);
        $_String .= chr(0x80 | $_C>>12 & 0x3F);
        $_String .= chr(0x80 | $_C>>6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    }
    return iconv('UTF-8', 'GB2312', $_String);
}


/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk='id',$pid = 'pid',$child = '_child',$root=0) {
    // 创建Tree


    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list,$field, $sortby='asc') {
    if(is_array($list)){
        $refer = $resultSet = array();
        foreach ($list as $i => $data)
            $refer[$i] = &$data[$field];
        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc':// 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ( $refer as $key=> $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}

/**
 * 在数据列表中搜索
 * @access public
 * @param array $list 数据列表
 * @param mixed $condition 查询条件
 * 支持 array('name'=>$value) 或者 name=$value
 * @return array
 */
function list_search($list,$condition) {
    if(is_string($condition))
        parse_str($condition,$condition);
    // 返回的结果集合
    $resultSet = array();
    foreach ($list as $key=>$data){
        $find   =   false;
        foreach ($condition as $field=>$value){
            if(isset($data[$field])) {
                if(0 === strpos($value,'/')) {
                    $find   =   preg_match($value,$data[$field]);
                }elseif($data[$field]==$value){
                    $find = true;
                }
            }
        }
        if($find)
            $resultSet[]     =   &$list[$key];
    }
    return $resultSet;
}

/**
 * 多维数组转换为一维数组
 *
 * @param $array            原数组
 * @param null $child       子数组key值
 * @param array $columnFix  要添加标志的colomn值
 * @param null $level       level层级
 * e.g: multiArray2LinearArray($multiArray, null, ['category_name', '----']);
 *
 * @return array|mixed
 */
function    multiArray2LinearArray(&$array, $child=null, array $columnFix=[null, null],  $level = null)
{
    global $result;

    is_null($child) && $child = '_child';
    $column = $columnFix[0];
    $fix = $columnFix[1];
    is_null($level) && $level = 1;

    empty($result) && $result = [];

    if (is_array($array) && count($array)) {

        foreach ($array as &$item) {
            if (!is_null($column) && !is_null($fix) && $item[$column] )
                $item[$column] = '|'.str_repeat($fix, $level).$item[$column];

            $result[] = $item;
            if (!empty($item[$child]) && count($item[$child])) {
                multiArray2LinearArray($item[$child], $child, $columnFix, ++$level);
                $level--;
            }
        }
    }
    return $result;

}

function renderJson($status=null, $message=null, $data=array(), $url = null)
{
    \Yii::$app->response->format = Response::FORMAT_JSON;

    if (!is_null($status) && $message) {
        \Yii::$app->response->data = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'url' => $url
        ];
    } else {
        \Yii::$app->response->data = $status;
    }

}

function returnJson($status=null, $message=null, $data=array(), $url = null)
{

    if (!is_null($status) && $message) {
         $data =[
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'url' => $url
        ];
    } else {
        $data = $status;
    }

    echo json_encode($data);

}

function getImageHost()
{
    return Yii::$app->params['host']['img_host'];
}