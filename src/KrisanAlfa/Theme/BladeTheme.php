<?php namespace KrisanAlfa\Theme;

use Bono\App;
use Bono\Theme\Theme;
use ErrorException;

/**
 * A Blade Theme for Bono Theme
 *
 * @category  Theme
 * @package   BladeTheme
 * @author    Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/xinix-technology/bono/master/LICENSE MIT
 * @link      https://github.com/krisanalfa/blade-theme
 */
class BladeTheme extends Theme
{
    /**
     * Extension of blade template engine
     *
     * @var string
     */
    protected $extension = '.blade.php';

    /**
     * Get base directory of the template
     *
     * @return array
     */
    public function getBaseDirectory()
    {
        return $this->baseDirectories;
    }

    /**
     * Get partial template
     *
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public function partial($template, $data)
    {
        $app      = App::getInstance();
        $template = explode('/', $template);
        $template = implode('.', $template) ?: null;

        $app->view->replace($data);

        try {
            return $app->view->make($template, $data)->render();
        } catch (ErrorException $e) {
            $app->error($e);
        }
    }

    /**
     * Resolve template name
     *
     * @param  string $template
     * @return string
     */
    public function resolve($template)
    {
        return str_replace('/', '.', $template);
    }
}
