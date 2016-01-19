<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/8/8
 * Time: 9:22
 */

function html_options($arr)
{

    $options = $out = "";
    $selected = $arr['selected'];

    if ($arr['options'])
    {
        $options = (array)$arr['options'];
    }
    elseif ($arr['output'])
    {
        if ($arr['values'])
        {
            foreach ($arr['output'] AS $key => $val)
            {
                $options["{$arr[values][$key]}"] = $val;
            }
        }
        else
        {
            $options = array_values((array)$arr['output']);
        }
    }
    if ($options)
    {
        foreach ($options AS $key => $val)
        {
            $out .= ( $key == $selected ? "<option value=\"$key\" selected>$val</option>" : "<option value=\"$key\">$val</option>");
        }
    }

    return $out;
}
