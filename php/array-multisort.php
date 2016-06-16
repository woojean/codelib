<?php
function multiSort()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}


//  ========================== demo ==================================
$goodsList = [
    [
        'id' => 1,
        'brand_id' => 5,
        'price' => 2,
        'name' => '商品1'
    ],
    [
        'id' => 2,
        'brand_id' => 5,
        'price' => 12,
        'name' => '商品2'
    ],
    [
        'id' => 3,
        'brand_id' => 15,
        'price' => 2,
        'name' => '商品3'
    ],
    [
        'id' => 4,
        'brand_id' => 15,
        'price' => 12,
        'name' => '商品4'
    ],
];

// 先按brand_id从小到大排序，对于brand_id相同的商品，按price从大到小排序
var_dump(multiSort($goodsList, 'brand_id', SORT_ASC, 'price', SORT_DESC));