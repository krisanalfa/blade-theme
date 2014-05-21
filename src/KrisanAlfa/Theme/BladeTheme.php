<?php namespace KrisanAlfa\Theme;

use Bono\App;
use Bono\Theme\Theme;
use RuntimeException;

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
class BladeTheme extends Theme
{
    protected $extension = '.blade.php';

    /**
     * Add base directory to the view base directory array and resolve asset files
     *
     * @param array $config BladeTheme configuration
     */
    public function __construct($config)
    {
        parent::__construct($config);

        $directory = explode(DIRECTORY_SEPARATOR.'src', __DIR__);
        $directory = reset($directory);

        $this->addBaseDirectory($directory, 3);

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
     * Resolve template path based on baseDirectory array
     *
     * @param string $template Template to resolve
     * @param mixed  $view     View engine
     *
     * @return string Template to render
     */
    public function resolve($template, $view = null)
    {
        $segments = explode('/', $template);
        $page     = end($segments);

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
     * Try to find template inside baseDirectory array
     *
     * @param string $dir      Which directory that will be tested
     * @param string $template The template that expected resides in directory
     * @param string $view     View engine
     *
     * @return string [description]
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
     * @return KrisanAlfa\Blade\BonoBlade::template
     */
    public function partial($template, $data)
    {
        $app      = App::getInstance();
        $template = explode('/', $template);
        $template = implode('.', $template) ?: null;

        $app->view->replace($data);

        $retVal = $app->view->make($template, $data);

        try {
            $retVal->__toString();
        } catch (RuntimeException $e) {
            $app->error($e);
        }

        return (string) $retVal;
    }
}
