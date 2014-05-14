<?php

namespace KrisanAlfa\Theme\BladeTheme\Helper;

use Norm\Norm;
use Bono\App;

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
     * Norm schema
     *
     * @var \Norm\Schema
     */
    protected $schema;

    /**
     * Data from controller that would be passed to the view
     *
     * @var mixed
     */
    protected $data;

    /**
     * Create a new form staticaly
     *
     * @param  mixed $arg The function arguments
     *
     * @return KrisanAlfa\Theme\BladeTheme\Helper\Form
     */
    public static function create($arg = null)
    {
        return new static($arg);
    }

    /**
     * Class constructor
     *
     * @param mixed $arg The function arguments
     *
     * @return void
     */
    public function __construct($arg = null)
    {

        if (is_array($arg)) {
            $this->schema = $arg;
        } else {
            $name         = (is_string($arg)) ? $arg : f('controller.name');
            $this->schema = Norm::factory($name)->schema();
        }

        $this->data = App::getInstance()->request->post();
    }

    /**
     * Create a form binded to a model
     *
     * @param Norm\Cursor $data Entry
     *
     * @return KrisanAlfa\Theme\BladeTheme\Helper\Form
     */
    public function of($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * [show description]
     *
     * @param array  $options Options you want to create this form
     *
     * @return string HTML string of form
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
     * Get label of a form
     *
     * @param string $key Attribute of entry
     *
     * @return string
     */
    public function label($key)
    {
        return $this->schema[$key]->label()."\n";
    }

    /**
     * Create an input form
     *
     * @param string $key Attribute of entry
     *
     * @return string HTML string of input form
     */
    public function input($key)
    {
        return $this->schema[$key]->presetInput(@$this->data[$key])."\n";
    }

    /**
     * Create a readonly field, well known for read only operation
     *
     * @param string $key Attribute of entry
     *
     * @return string HTML string of input form
     */
    public function readonly($key)
    {
        return $this->schema[$key]->presetReadonly(@$this->data[$key])."\n";
    }
}
