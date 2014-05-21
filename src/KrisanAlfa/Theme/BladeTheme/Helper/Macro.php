<?php namespace KrisanAlfa\Theme\BladeTheme\Helper;

use Norm\Norm;
use Bono\App;

/**
 * Macro helper to build form as fast as possible
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     BladeTheme
 */
class Macro
{
    /**
     * [input description]
     *
     * @param  [type] $type       [description]
     * @param  [type] $name       [description]
     * @param  [type] $value      [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function input($type, $name, $value, array $attributes = array())
    {
        return '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.HTMLBuilder::attributes($attributes).' />';
    }

    /**
     * [textArea description]
     *
     * @param  [type] $name       [description]
     * @param  [type] $value      [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function textArea($name, $value, array $attributes = array())
    {
        return '<textarea name="'.$name.'" value="'.$value.'" '.HTMLBuilder::attributes($attributes).'></textarea>';
    }

    /**
     * [password description]
     *
     * @param  [type] $name       [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function password($name, array $attributes = array())
    {
        return '<input type="password" name="'.$name.'" '.HTMLBuilder::attributes($attributes).' />';
    }

    /**
     * [inputText description]
     *
     * @param  [type] $name       [description]
     * @param  [type] $value      [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function inputText($name, $value, array $attributes = array())
    {
        return self::input('text', $name, $value, $attributes);
    }

    /**
     * [inputEmail description]
     *
     * @param  [type] $name       [description]
     * @param  [type] $value      [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function inputEmail($name, $value, array $attributes = array())
    {
        return self::input('email', $name, $value, $attributes);
    }

    /**
     * [inputNumber description]
     *
     * @param  [type] $name       [description]
     * @param  [type] $value      [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function inputNumber($name, $value, array $attributes = array())
    {
        return self::input('number', $name, $value, $attributes);
    }

    /**
     * [inputDate description]
     *
     * @param  [type] $name       [description]
     * @param  [type] $value      [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function inputDate($name, $value, array $attributes = array())
    {
        $obj = array();
        $obj['name'] = $name;

        return App::getInstance()->theme->partial('_schema.datepicker', array(
            'value' => $value,
            'entry' => null,
            'self' => $obj
        ));
    }

    /**
     * [dropDown description]
     *
     * @param  [type] $name       [description]
     * @param  [type] $value      [description]
     * @param  [type] $collection [description]
     * @param  array  $attributes [description]
     *
     * @return [type]             [description]
     */
    public static function dropDown($name, $value, $collection, array $attributes = array())
    {
        $html = '<select name='.$name.'>';
        $html .= '<option value="">&mdash;</option>';

        if (count($collection) > 0) {
            foreach($collection as $model) {

                $html .= '<option value="'. $model['$id'] .'" ';

                if ($model['$id'] === $value) {
                    $html .= 'selected ';
                }

                $html .= '>';

                $html .= $model['name'];
            }
            $html .= '</option>';
        }

        $html .= '</select>';

        return $html;
    }

    /**
     * [dropDownCollection description]
     *
     * @param  [type] $name           [description]
     * @param  [type] $value          [description]
     * @param  [type] $collectionName [description]
     * @param  array  $attributes     [description]
     *
     * @return [type]                 [description]
     */
    public static function dropDownCollection($name, $value, $collectionName, array $attributes = array())
    {
        $_collection = Norm::factory($collectionName)->find();
        $collection = array();

        foreach ($_collection as $_model) {
            $collection[] = $_model->toArray();
        }

        return self::dropDown($name, $value, $collection, $attributes);
    }
}
