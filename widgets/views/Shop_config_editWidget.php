<?php
use app\modules\adminshop\models\Language;
use app\widgets\AjaxFileUploadWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UrlManager;

$url = Url::to('adminshop/shop_config/upload', true);

$language = new Language();
$lang_list = $language->get_lang_list();



foreach ($group['vars'] as $_k=>$var) {
?>



    <div class="form-body " >

        <div class="form-group">
            <div class="col-md-3 control-label">
                <?php if($var['desc']): ?>
                    <a href="javascript:showNotice('notice<?=$var['code']?>');"

                       class="tooltips" data-placement="top" data-original-title="<?=$var['desc']?>">
                        <img src="<?=Url::to('@ecshopImg/notice.gif')?>" width="16" height="16" border="0" alt="<?=$lang['form_notice']?>" /></a>
                <?php endif ?>
                <?=$var['name']?>:
            </div>
            <div class="col-md-9">
                <div class="input-group">
<!--                    <span class="input-group-addon">-->
<!--                        <i class="fa fa-envelope"></i>-->
<!--                    </span>-->
<!--                    <input type="email" class="form-control" placeholder="Email Address">-->
                    <?php
                    $str = '';
                    switch ($var['type']) {
                        case 'text':
                            $str = <<<STD
                            <input name="value[{$var['id']}]" type="text" value="{$var['value']}"  size="40" class="form-control" />
STD;
                            break;
                        case 'password':
                            $str = <<<STD
                            <input name="value[{$var['id']}]" type="password" value="{$var['value']}" size="40" class="form-control" />
STD;
                            break;
                        case 'textarea':
                            $str = <<<STD
                            <textarea name="value[{$var['id']}]" cols="40" rows="5" class="form-control" >{$var['value']}</textarea>
STD;
                            break;
                        case 'select':

                            $str = "<div class='icheck-inline'>";

                            foreach ($var['store_options'] as $k => $opt) {

                                $str_itm = <<<STD
                                    <label for="value_{$var['id']}_{$k}">

                                    <input type="radio" name="value[{$var['id']}]" id="value_{$var['id']}_{$k}"
                                    value="{$opt}" class="icheck"  data-radio="iradio_square-grey"
STD;

                                if($var['value'] == $opt)
                                    $str_itm .= 'checked="true"';

                                if($var['code'] == 'rewrite')
                                    $str_itm .= 'onclick="return ReWriterConfirm(this);"';

                                if($var['code'] == 'smtp_ssl' && $opt == 1)
                                    $str_itm .= 'onclick="return confirm(\''.$lang['smtp_ssl_confirm'].'\');"';

                                if($var['code'] == 'enable_gzip' and $opt == 1)
                                    $str_itm .= 'onclick="return confirm(\''.$lang['gzip_confirm'].'\');"';

                                if( $var['code'] == 'retain_original_img' and $opt == 0)
                                    $str_itm .= 'onclick="return confirm(\''.$lang['retain_original_confirm'].'\');"';

                                $str_itm .= '>';
                                $str_itm .= ' '.$var['display_options'][$k]. '   </label>';

                                $str .= $str_itm;
                            }

                            $str.="</div>";

                            break;
                        case 'options':

                            $options = $lang['cfg_range'][$var['code']];
                            $values = $var['value'];

                            $optionHtml = html_options(['options'=>$options, 'selected'=>$values]);

                            $str = <<<STD
                            <select name="value[{$var['id']}]" id="value_{$var['id']}_{$key}" class="form-control">
                                {$optionHtml}
                            </select>
STD;
                            break;
                        case 'file':
                            $uploadUrl = Url::to('adminshop/shop_config/upload', true);
                            $img = Url::to($var['store_dir'].$var['value'], true);

                            $str = <<<STD
                            <input id="{$var['code']}"
                                    name="UploadForm[{$var['code']}]"
                                    point-class="UploadForm-{$var['code']}" type="file"
                                    point-img="img-UploadForm-{$var['code']}"
                                    data-url="{$uploadUrl}"
                                    data-id ="{$var['id']}"
                                    class="ajax_upload form-control"
                                    />
                            <input type='hidden' name="UploadForm[{$var['code']}]" class="UploadForm-{$var['code']}"  />
                            <input type='hidden' name="value[{$var['id']}]" value="{$var['value']}" class="UploadForm-{$var['code']}"  />
                            <img src="{$img}" id="img-UploadForm-{$var['code']}" class="none" style="width:50px; height:50px;" />
                            <span class="{$var['code']}append"></span>
STD;
                            /*if (($var['code'] == "shop_logo" or $var['code'] == "no_picture" or
                                    $var['code'] == "watermark" or $var['code'] == "shop_slagon" or
                                    $var['code'] == "wap_logo") and $var['value']
                            ) {
                                $str .= <<<STD
                                <a href="?act=del&code={$var['code']}">
                                    <img src="images/no.gif" alt="Delete" border="0" />
                                </a>
                                <img src="images/yes.gif" border="0" onmouseover="showImg('{$var['code']}_layer', 'show')"
                                                                    onmouseout="showImg('{$var['code']}_layer', 'hide')" />
                                <div id="{$var['code']}_layer" style="position:absolute; width:100px; height:100px; z-index:1; visibility:hidden" border="1">
                                    <img src="{$var['value']}" border="0" />
                                </div>
    STD;

                            } else if($var['value'] != "") {
                                $str .= <<<STD
                                    <img src="images/yes.gif" alt="yes" />
    STD;
                            } else {
                                $str .= <<<STD
                                <img src="images/no.gif" alt="no" />
    STD;
                            }*/

                            break;
                        case 'manual':

                            switch ($var['code']) {
                                case 'shop_country':
                                    $str = <<<STD
                                    <select name="value[{$var['id']}]" id="selCountries" onchange="region.changed(this, 1, 'selProvinces')" class="form-control">
                                        <option value=''>{$lang['select_please']}</option>
STD;
                                    foreach ($countries as $item=>$region){

                                        $selected = $region['region_id'] == $cfg['shop_country'] ? 'selected' : '';
                                        $str .= <<<STD
                                        <option value="{$region['region_id']}" >{$region['region_name']}</option>
STD;

                                    }
                                    $str .= '</select>';
                                    break;
                                case 'shop_province':

                                    $str = <<<STD
                                    <select name="value[{$var['id']}]" id="selProvinces" onchange="region.changed(this, 2, 'selCities')" class="form-control">
                                        <option value=''>{$lang['select_please']}</option>
STD;
                                    foreach ($provinces as $item => $region){

                                        $selected = $region['region_id'] == $cfg['shop_province']?'selected':'';
                                        $str .= <<<STD
                                    <option value="{$region['region_id']}" {$selected}>{$region['region_name']}</option>
STD;
                                    }
                                    $str .='</select>';

                                    break;
                                case 'shop_city':

                                    $str = <<<STD
                                    <select name="value[{$var['id']}]" id="selCities" class="form-control">
                                        <option value=''>{$lang['select_please']}</option>

STD;
                                    foreach ($cities as  $item=>$region){

                                        $selected = $region['region_id'] == $cfg['shop_city']? 'selected' : '';

                                        $str .= <<<STD

                                    <option value="{$region['region_id']}" {$selected} >{$region['region_name']}</option>
STD;

                                    }

                                    $str .= '</select>';


                                    break;
                                case 'lang':

                                    $options = $lang_list;
                                    $values = $var['value'];
                                    $optionHtml = html_options(['options'=>$options, 'selected' => $values]);

                                    $str = <<<STD
                                    <select name="value[{$var['id']}]" class="form-control">
                                        {$optionHtml}
                                    </select>
STD;
                                    break;
                                case 'invoice_type':

                                    $rateArr = unserialize($var['value']);

                                    $str = <<<STD
                                    <table>
                                        <tr>
                                            <th scope="col">{$lang['invoice_type']}</th>
                                            <th scope="col">{$lang['invoice_rate']}</th>
                                        </tr>
                                        <tr>
                                            <td><input name="invoice_type[0]" type="text" value="{$rateArr['type'][0]}" /></td>
                                            <td><input name="invoice_rate[0]" type="text" value="{$rateArr['rate'][0]}" /></td>
                                        </tr>
                                        <tr>
                                            <td><input name="invoice_type[1]" type="text" value="{$rateArr['type'][1]}" /></td>
                                            <td><input name="invoice_rate[1]" type="text" value="{$rateArr['rate'][1]}" /></td>
                                        </tr>
                                        <tr>
                                            <td><input name="invoice_type[2]" type="text" value="{$rateArr['type'][2]}" /></td>
                                            <td><input name="invoice_rate[2]" type="text" value="{$rateArr['rate'][2]}" /></td>
                                        </tr>
                                    </table>
STD;
                                    break;
                            }
                            break;
                        default:
                            $str = '未定义这个';
                            break;
                    }
                    echo $str;
                    ?>
                </div>
            </div>
        </div>



        <?php if($var['desc']):?>
        <div class="form-group">
            <div class="col-xs-offset-3">
                <span class="notice-span" <?= $help_open ? 'style="display:block"' : 'style="display:none"' ?>
                      id="notice<?=$var['code']?>"><?=nl2br($var['desc'])?></span>
            </div>
        </div>
        <?php endif?>
    </div>
<?php
    }
?>

<script type="text/javascript">

</script>


