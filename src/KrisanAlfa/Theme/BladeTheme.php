<?php namespace KrisanAlfa\Theme;

use Bono\App;
use Bono\Theme\Theme;
use KrisanAlfa\Blade\BonoBlade;

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
     * View instance
     *
     * @var KrisanAlfa\Blade\BonoBlade
     */
    protected $view = null;

    /**
     * View paths cache
     * @var array
     */
    protected $viewPaths;

    /**
     * Reference object to application instance
     * @var Bono\App
     */
    protected $app;

    /**
     * Constructor
     *
     * @param array $options Theme options
     */
    public function __construct(array $options = array())
    {
        // prepare default options
        $defaultOptions = array(
            'cachePath' => '../cache',
        );
        $options = array_merge($defaultOptions, $options);

        // call parent constructor
        parent::__construct($options);

        // set blade-theme module dir as one of base directory
        $directory = explode(DIRECTORY_SEPARATOR.'src', __DIR__);
        $directory = reset($directory);
        $this->addBaseDirectory($directory, 5);

        $this->app = App::getInstance();
    }

    /**
     * Get partial template
     *
     * @param string $template
     * @param array  $data
     *
     * @return string
     */
    public function partial($template, array $data = array())
    {
        $app      = $this->app;
        $template = explode('/', $template);
        $template = implode('.', $template) ?: null;

        $app->view->replace($data);

        return $app->view->make($template, $data)->render();
    }

    /**
     * Resolve template name
     *
     * @param string $template
     *
     * @return string
     */
    public function resolve($template, $view = null)
    {
        return $this->getView()->resolve(str_replace('/', '.', $template));
    }

    /**
     * Get specific view of this theme, I use Blade View Engine
     *
     * @return KrisanAlfa\Blade\BonoBlade
     */
    public function getView()
    {
        if (is_null($this->view)) {
            if (!is_dir($this->options['cachePath'])) {
                mkdir($this->options['cachePath'], 0755, true);
            }

            $this->view = new BonoBlade($this->getViewPaths(), $this->options['cachePath']);
        }

        return $this->view;
    }

    // /**
    //  * Create our cachePath for Blade Compiler
    //  *
    //  * @throw Exception When we cannot create cache path, and the cache path doesn't exist
    //  *
    //  * @return void
    //  */
    // protected function makeCachePath($cachePath)
    // {
    //     try {
    //         mkdir($cachePath, 0755);
    //     } catch (Exception $e) {
    //         $this->app->error($e);
    //     }
    // }

    /**
     * Get view paths, where template and other view component resides
     *
     * @return void
     */
    protected function getViewPaths()
    {
        if (is_null($this->viewPaths)) {
            // $ours = $this->defaultConfig('templates.path', (array) $this->app->config('app.templates.path'));
            // $theme = $this->arrayFlatten($this->baseDirectories);

            // $this->viewPaths = array_merge_recursive($ours, $theme);
            $this->viewPaths = $this->arrayFlatten($this->baseDirectories);
        }

        return $this->viewPaths;
    }

    // /**
    //  * Set and create our cache path for optimizing blade compiling
    //  *
    //  * @return void
    //  */
    // protected function setCachePath()
    // {
    //     $cachePath = $this->defaultConfig('cache.path', '../cache');

    //     if (! is_dir($cachePath)) {
    //         $this->makeCachePath($cachePath);
    //     }

    //     return $cachePath;
    // }

    // /**
    //  * Set our basic layout
    //  *
    //  * @return void
    //  */
    // protected function setLayout()
    // {
    //     return $this->defaultConfig('layout', 'layout');
    // }

    // /**
    //  * Get default option
    //  * @param string $key     The key in our options
    //  * @param mixed  $default Default if key didn't found
    //  *
    //  * @return mixed
    //  */
    // protected function defaultConfig($key, $default)
    // {
    //     if (isset($this->options[$key])) {
    //         return $this->options[$key];
    //     } else {
    //         return $default;
    //     }
    // }

    /**
     * A helper to flatten array
     *
     * @param array $array The array you want to flattened
     *
     * @return array The flattened array
     */
    protected function arrayFlatten($array)
    {
        $flattenedArray = array();

        array_walk_recursive($array, function ($x) use (&$flattenedArray) {
            $flattenedArray[] = $x;
        });

        return $flattenedArray;
    }
}
