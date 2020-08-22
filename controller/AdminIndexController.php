<?php

namespace plugins\carousel\controller;

use cmf\controller\PluginAdminBaseController;

class AdminIndexController extends PluginAdminBaseController
{
    /**
     * @adminMenu(
     *     "name" => "轮播图模块",
     *     "parent" => "admin/Plugin/default",
     *     "display" => true,
     *     "hasView" => true,
     *     "order" => 1000,
     * )
     */
    public function index()
    {
        $this->redirect(cmf_plugin_url("Carousel://admin_carousel/index"));
    }
}