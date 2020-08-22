<?php

namespace plugins\carousel;

use cmf\lib\Plugin;

class CarouselPlugin extends Plugin
{
    public $info = [
        'name' => 'Carousel',
        'title' => '轮播图模块',
        'author' => '徐灵峰',
        'version' => '1.0.0',
        'description' => '轮播图模块',
        'status' => 1
    ];

    public $hasAdmin = 1;

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }
}