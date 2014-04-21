<?php

/**
 * Blade Theme
 *
 * MIT LICENSE
 *
 * Copyright (c) 2013 PT Sagara Xinix Solusitama
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category  Theme
 * @package   BladeTheme
 * @author    Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/xinix-technology/bono/master/LICENSE MIT
 * @link      https://github.com/krisanalfa/bonoblade
 */
namespace KrisanAlfa\Theme;

use Bono\App;

/**
 * A Blade Theme for Bono Theme
 *
 * @category  Theme
 * @package   BladeTheme
 * @author    Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/xinix-technology/bono/master/LICENSE MIT
 * @link      https://github.com/krisanalfa/bonoblade
 */
class BladeTheme extends \Bono\Theme\Theme
{
    protected $extension = '.blade.php';

    /**
     * [__construct description]
     *
     * @param [type] $config [description]
     */
    public function __construct($config)
    {
        parent::__construct($config);

        $directory = explode(DIRECTORY_SEPARATOR.'src', __DIR__);
        $directory = reset($directory);

        $this->addBaseDirectory($directory, 5);

        $this->resolveAssetPath('css');
        $this->resolveAssetPath('fonts');
        $this->resolveAssetPath('img');
        $this->resolveAssetPath('js');
    }

    public function getBaseDirectory()
    {
        return $this->baseDirectories;
    }

    /**
     * [resolve description]
     *
     * @param [type] $template [description]
     * @param [type] $view     [description]
     *
     * @return [type] [description]
     */
    public function resolve($template, $view = null)
    {
        $segments = explode('/', $template);
        $page = end($segments);

        foreach ($this->baseDirectories as $dirs) {
            foreach ($dirs as $dir) {
                if ($tpl = $this->tryTemplate(
                    $dir . DIRECTORY_SEPARATOR . 'templates',
                    $template.$this->extension,
                    $view
                )) {
                    return $tpl;
                }
            }
        }
    }

    /**
     * [tryTemplate description]
     *
     * @param [type] $dir      [description]
     * @param [type] $template [description]
     * @param [type] $view     [description]
     *
     * @return [type] [description]
     */
    public function tryTemplate($dir, $template, $view)
    {
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);

        if (is_readable($dir.DIRECTORY_SEPARATOR.$template)) {
            $template = explode($this->extension, $template);
            $template = reset($template);

            if (isset($view)) {
                $view->setTemplatesDirectory($dir);
            }

            return $template;
        }
    }

    /**
     * Get a partial
     *
     * @param string $template Partial template string name
     * @param mixed  $data     The data that would be passed to partial content
     *
     * @return KrisanAlfa\Blade\BonoBlade
     */
    public function partial($template, $data)
    {
        $app      = App::getInstance();
        $template = explode('/', $template);
        $template = implode('.', $template) ?: null;

        if (! $template) {
            $app->error(new \RuntimeException('Partial view cannot renderred, because the template is NULL'));
        }

        $app->view->replace($data);

        $retVal = $app->view->make($template, $data);

        try {
            $retVal->__toString();
        } catch (\RuntimeException $e) {
            $app->error($e);
        }

        return $retVal;
    }
}
