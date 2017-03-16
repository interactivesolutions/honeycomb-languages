<?php

namespace interactivesolutions\honeycomblanguages\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCLanguagesServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycomblanguages\app\http\controllers';
}


