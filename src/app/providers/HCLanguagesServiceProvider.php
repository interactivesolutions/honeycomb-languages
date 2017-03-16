<?php

namespace interactivesolutions\honeycomblanguages\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCLanguagesServiceProvider extends HCBaseServiceProvider
{
    /**
     * Register commands
     *
     * @var array
     */
    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycomblanguages\app\http\controllers';
}


