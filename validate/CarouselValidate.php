<?php

namespace plugins\carousel\validate;

use think\Validate;

class CarouselValidate extends Validate
{
    protected $rule = [
        "id" => "require",
        "ids" => "require",
        "image" => "require",
        "status" => "require",
        "sort" => "require"
    ];

    protected $message = [
        "id.require" => "轮播图编号 为空",
        "ids.require" => "轮播图编号 为空",
        "image.require" => "轮播图图片 为空",
        "status.require" => "轮播图状态 为空",
        "sort.require" => "轮播图排序 为空"
    ];

    protected $scene = [
        "id" => ["id"],
        "ids" => ["ids"],
        "add" => ["image"],
        "edit" => ["id", "image"],
        "status" => ["id", "status"],
        "sort" => ["id", "sort"]
    ];
}