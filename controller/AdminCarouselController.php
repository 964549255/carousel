<?php

namespace plugins\carousel\controller;

use cmf\controller\PluginAdminBaseController;
use plugins\carousel\model\CarouselModel;

class AdminCarouselController extends PluginAdminBaseController
{
    /**
     * @adminMenu(
     *     "name" => "轮播图列表",
     *     "parent" => "AdminIndex/index",
     *     "display" => true,
     *     "hasView" => true,
     *     "order" => 1000,
     * )
     */
    public function index()
    {
        $search = input("get.search/a");
        $query = input("get.");
        $where = [];
        if (!empty($search["key"]) && !empty($search["value"])) {
            switch ($search["key"]) {
                case 1:
                    $where["name"] = ["LIKE", "%{$search['value']}%"];
                    break;
                case 2:
                    $where["link"] = ["LIKE", "%{$search['value']}%"];
                    break;
            }
        }
        if (!empty($search["status"])) {
            $where["status"] = $search["status"];
        }
        $data["where"] = $where;
        $data["order"] = "sort, id";
        $data["page"] = input("get.page");
        $items = CarouselModel::pages($data)["data"];
        return $this->fetch("", [
            "items" => $items,
            "pages" => $items->appends($query)->render(),
            "search" => $search
        ]);
    }

    public function trash()
    {
        $search = input("get.search/a");
        $query = input("get.");
        $where = [];
        if (!empty($search["key"]) && !empty($search["value"])) {
            switch ($search["key"]) {
                case 1:
                    $where["name"] = ["LIKE", "%{$search['value']}%"];
                    break;
                case 2:
                    $where["link"] = ["LIKE", "%{$search['value']}%"];
                    break;
            }
        }
        if (!empty($search["status"])) {
            $where["status"] = $search["status"];
        }
        $data["where"] = $where;
        $data["order"] = "delete_time desc, id";
        $data["page"] = input("get.page");
        $items = CarouselModel::pages($data, true)["data"];
        return $this->fetch("", [
            "items" => $items,
            "pages" => $items->appends($query)->render(),
            "search" => $search
        ]);
    }

    public function add()
    {
        $data = input("post.");
        if (!empty($data)) {
            return json(CarouselModel::add($data));
        } else {
            return $this->fetch();
        }
    }

    public function edit()
    {
        $id = input("get.id");
        $data = input("post.");
        if (!empty($data)) {
            $data["id"] = $id;
            return json(CarouselModel::edit($data));
        } else {
            $item = (new CarouselModel())->where("id", $id)->find();
            return $this->fetch("", [
                "item" => $item
            ]);
        }
    }

    public function input()
    {
        $data = input("post.");
        return json(CarouselModel::input($data));
    }

    public function status()
    {
        $data = input("post.");
        return json(CarouselModel::status($data));
    }

    public function sort()
    {
        $data = input("post.");
        return json(CarouselModel::sort($data));
    }

    public function remove()
    {
        $data = input("post.");
        return json(CarouselModel::remove($data));
    }

    public function removeAll()
    {
        $data = input("post.");
        return json(CarouselModel::removeAll($data));
    }

    public function removeTrue()
    {
        $data = input("post.");
        return json(CarouselModel::remove($data, true));
    }

    public function removeAllTrue()
    {
        $data = input("post.");
        return json(CarouselModel::removeAll($data, true));
    }

    public function recover()
    {
        $data = input("post.");
        return json(CarouselModel::recover($data));
    }

    public function recoverAll()
    {
        $data = input("post.");
        return json(CarouselModel::recoverAll($data));
    }
}