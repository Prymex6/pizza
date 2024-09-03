<?php

function flattenArray($array)
{
    $result = [];
    foreach ($array as $subArray) {
        foreach ($subArray as $key => $value) {
            $result[$key] = $value; // Dodaj elementy do dwuwymiarowej tablicy
        }
    }
    return $result;
}
