<?php

namespace KrisanAlfa\Theme\BladeTheme\Helper;

/**
 * Create a form of entry bind by a model
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     BladeTheme
 */
class Form
{
    /**
     * [$schema description]
     *
     * @var [type]
     */
    protected $schema;

    /**
     * [$data description]
     *
     * @var [type]
     */
    protected $data;

    /**
     * [create description]
     *
     * @param  [type] $arg [description]
     *
     * @return [type]      [description]
     */
    public static function create($arg = null)
    {
        return new static($arg);
    }

    /**
     * [__construct description]
     *
     * @param [type] $arg [description]
     */
    public function __construct($arg = null)
    {

        if (is_array($arg)) {
            $this->schema = $arg;
        } else {
            $name = (is_string($arg)) ? $arg : f('controller.name');
            $this->schema = \Norm::factory($name)->schema();
        }

        $this->data = \App::getInstance()->request->post();
    }

    /**
     * [of description]
     *
     * @param  [type] $data [description]
     *
     * @return [type]       [description]
     */
    public function of($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * [show description]
     *
     * @param  array  $options [description]
     *
     * @return [type]          [description]
     */
    public function show($options = array())
    {
        $options = array_merge(array( 'readonly' => false ), $options);

        $html = '';
        foreach ($this->schema as $key => $field) {
            $html .= '<div class="row field field-'.$key.'">'."\n";
            $html .= $this->label($key);
            $html .= $options['readonly'] ? $this->readonly($key) : $this->input($key);
            $html .= '</div>'."\n\n";
        }
        return $html;
    }

    /**
     * [label description]
     *
     * @param  [type] $key [description]
     *
     * @return [type]      [description]
     */
    public function label($key)
    {
        return $this->schema[$key]->label()."\n";
    }

    /**
     * [input description]
     *
     * @param  [type] $key [description]
     *
     * @return [type]      [description]
     */
    public function input($key)
    {
        return $this->schema[$key]->input(@$this->data[$key])."\n";
    }

    /**
     * [readonly description]
     *
     * @param  [type] $key [description]
     *
     * @return [type]      [description]
     */
    public function readonly($key)
    {
        return $this->schema[$key]->set('readonly', true)->input(@$this->data[$key])."\n";
    }
}
