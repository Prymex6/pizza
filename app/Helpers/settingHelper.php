<?php

use App\Models\Setting;
use Illuminate\Support\Str;

function settings($ignore = [])
{
    $settings = [];

    if (empty($codeKey)) {
        foreach (Setting::all() as $setting) {

            $skey = explode_after_last_underscore($setting['key']);
            $firstkey = array_values($skey);
            $firstkey = array_shift($skey);

            if (!empty($ignore) && in_array($firstkey, $ignore)) continue;

            $settings[$setting['code']][$firstkey] = $setting['value'] ? true : false;
        }

        return collect($settings);
    }
}

function setting($codeKey = null, $explode = false)
{

    if (strpos($codeKey, '.') == false) {
        $results = Setting::where('code', $codeKey)
            ->value('value');

        return isset($results);
    }

    [$code, $key] = explode('.', $codeKey);


    $result = Setting::where('code', $code)
        ->where('key', $key)
        ->value('value');

    if (in_array($code, ['promotions'])) {
        $model = explode('_', $key);
        $model = end($model);

        if (in_array($model, ['categories', 'dishes'])) {
            $elements = json_decode($result, true);

            if ($explode) {
                return explodeData($elements, ucfirst($model));
            } else {
                return $elements ? (array)$elements : [];
            }
        }
    }

    $position = strpos($key, '_');
    if (empty($result) && $position !== false && $position <= 0) {
        $result = Setting::where('code', $code)
            ->where('key', 'like', '%' . $key)
            ->first();

        return [preg_replace('/\d/', '', $result['key']) => preg_replace('/\D/', '', $result['key'])];
    }

    if (empty($result) && strpos($key, '_') == false) {
        $results = Setting::where('code', $code)
            ->where('key', 'like', $key . '_%')
            ->value('value');

        return isset($results);
    }

    return $result;
}

function explodeData($elements, $model)
{
    $models = [
        'Dish'      => \App\Models\Dish::class,
        'Category'  => \App\Models\Category::class,
    ];

    $model = Str::singular($model);
    if (!empty($elements)) {

        if (is_array($elements)) {
            $results = [];

            foreach ($elements as $element) {
                $results[] = app($models[$model])->find($element)->value('name')->get();
            }

            return $results;
        } elseif ($elements) {
            return app($models[$model])->find($elements)->value('name');
        }

        return [$elements];
    }

    return [];
}

function explode_after_last_underscore($string)
{
    if (strlen($string) > 0) {
        $last_underscore_position = strrpos($string, '_');
        if ($last_underscore_position !== false) {
            return [
                substr($string, 0, $last_underscore_position),
                substr($string, $last_underscore_position + 1)
            ];
        } else {
            return [$string];
        }
    } else {
        return [];
    }
}
