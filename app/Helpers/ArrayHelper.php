<?php

function flattenArray($array)
{
    $result = [];
    foreach ($array as $value) {
        $result[$value['dish_id'] . ($value['size_id'] ? '_' . $value['size_id'] : '')] = [
            'quantity'  =>  $value['quantity'],
        ];
    }
    return $result;
}
