<?php

namespace plugins\carousel\controller;

use cmf\controller\PluginRestBaseController;
use plugins\carousel\model\CarouselModel;

class ApiIndexController extends PluginRestBaseController
{
    public function upload()
    {
        return json(_upload());
    }

    public function getAllCarousel()
    {
        $items = (new CarouselModel())->where("status", 1)->order("sort, id")->select()->append(["image_url"]);
        return json(_array(["data" => $items]));
    }
}