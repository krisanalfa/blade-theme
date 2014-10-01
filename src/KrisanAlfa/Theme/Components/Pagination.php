<?php namespace KrisanAlfa\Theme\Components;

use Bono\App;
use Bono\Helper\URL;

class Pagination
{
    protected static $instances = null;

    protected $app     = null;

    protected $current = null;

    protected $entries = null;

    protected $limit   = null;

    protected $links   = array();

    protected $partialTemplate = 'components/paginator';

    public function __construct($entries)
    {
        $this->entries = $entries;
        $this->app     = App::getInstance();

        $configCollection = $this->app->config('norm.collections');

        if (isset($configCollection['default'])) {
            if (isset($configCollection['default']['limit'])) {
                $this->limit = $configCollection['default']['limit'];
            }
        }

        $this->baseUrl = URL::current();
    }

    public static function create($entries)
    {
        $Class = get_called_class();

        if (is_null(static::$instances[$Class])) {
            static::$instances = new $Class($entries);
        }

        return static::$instances;
    }

    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;

        return $this;
    }

    public function paginate()
    {
        $limit = $this->limit;

        if (is_null($limit)) {
            return;
        }

        $all     = $this->entries->count();
        $average = round($all / $limit, 0, PHP_ROUND_HALF_UP);

        if ($average == 1) {
            return;
        }

        $skip    = $this->app->request->get('!skip');

        for ($i = 0; $i < $average; $i++) {
            $isCurrent       = ($skip == ($i*$limit));
            $this->links[$i] = array(
                'uri'        => '?!skip='.($i*$limit),
                'isCurrent'  => $isCurrent,
            );

            if ($isCurrent) {
                $this->current = $i;
            }
        }

        return $this->app->theme->partial($this->getPartialTemplate(), array(
            'links'   => $this->links,
            'baseUrl' => $this->baseUrl,
            'current' => $this->current,
            'app'     => $this->app,
        ));
    }

    protected function getPartialTemplate()
    {
        return $this->partialTemplate;
    }

    public function setPartialTemplate($partial)
    {
        $this->partialTemplate = $partial;

        return $this;
    }
}
