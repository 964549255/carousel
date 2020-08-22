<?php

namespace plugins\carousel\model;

use plugins\carousel\validate\CarouselValidate;
use think\Model;
use traits\model\SoftDelete;

class CarouselModel extends Model
{
    use SoftDelete;

    protected $autoWriteTimestamp = true;

    protected function getDeleteTimeAttr($value)
    {
        return !empty($value) ? date("Y-m-d H:i:s", $value) : "";
    }

    protected function getImageUrlAttr($value, $data)
    {
        return !empty($data["image"]) ? DOMAIN . $data["image"] : "";
    }

    protected function getStatusTextAttr($value, $data)
    {
        $text = [
            1 => "启用",
            2 => "禁用"
        ];
        return $text[$data["status"]];
    }

    public static function pages($data, $trash = false)
    {
        $where = !empty($data["where"]) ? $data["where"] : "";
        $field = !empty($data["field"]) ? $data["field"] : "*";
        $order = !empty($data["order"]) ? $data["order"] : "id";
        $rows = !empty($data["rows"]) ? $data["rows"] : 10;
        $page = !empty($data["page"]) ? $data["page"] : 1;
        if ($trash) {
            $items = CarouselModel::onlyTrashed()->where($where)->field($field)->order($order)->paginate([
                "list_rows" => $rows,
                "page" => $page
            ]);
        } else {
            $items = (new CarouselModel())->where($where)->field($field)->order($order)->paginate([
                "list_rows" => $rows,
                "page" => $page
            ]);
        }
        return _array(["data" => $items]);
    }

    public static function add($data)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("add")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        CarouselModel::create($data, true);
        return _array();
    }

    public static function edit($data)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("edit")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        CarouselModel::update($data, ["id" => $data["id"]], true);
        return _array();
    }

    public static function input($data)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("id")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        CarouselModel::update($data, ["id" => $data["id"]], true);
        return _array();
    }

    public static function status($data)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("status")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        CarouselModel::update($data, ["id" => $data["id"]], true);
        return _array();
    }

    public static function sort($data)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("sort")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        CarouselModel::update($data, ["id" => $data["id"]], true);
        return _array();
    }

    public static function remove($data, $force = false)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("id")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        CarouselModel::destroy($data["id"], $force);
        return _array();
    }

    public static function removeAll($data, $force = false)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("ids")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        foreach ($data["ids"] as $id) {
            CarouselModel::destroy($id, $force);
        }
        return _array();
    }

    public static function recover($data)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("id")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        CarouselModel::update(["delete_time" => null], ["id" => $data["id"]], true);
        return _array();
    }

    public static function recoverAll($data)
    {
        $validate = new CarouselValidate();
        if (!$validate->scene("ids")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        foreach ($data["ids"] as $id) {
            CarouselModel::update(["delete_time" => null], ["id" => $id], true);
        }
        return _array();
    }
}