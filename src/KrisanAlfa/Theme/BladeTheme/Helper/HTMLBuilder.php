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
class HTMLBuilder
{
    /**
     * [attributes description]
     *
     * @param  [type] $attributes [description]
     * @param  [type] $type       [description]
     *
     * @return [type]             [description]
     */
    public function attributes($attributes, $type = null)
    {
        $html = array();

        $attributes = array_merge($attributes, array('value' => null));

        foreach ((array) $attributes as $key => $value) {
            $element = self::attributeElement($key, $value);

            if (! is_null($element)) $html[] = $element;
        }

        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    /**
     * [attributeElement description]
     *
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     *
     * @return [type]        [description]
     */
    protected function attributeElement($key, $value)
    {
        if (is_numeric($key)) $key = $value;

        if (! is_null($value)) return $key.'="'.e($value).'"';
    }
}
