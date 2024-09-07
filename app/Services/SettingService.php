<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Setting;

class SettingService
{

    private $iteration = 0, $last_key = '';

    public function update($settings, $code)
    {
        Setting::where('code', $code)->delete();

        foreach ($settings ?? [] as $key => $value) {
            if (!empty($value) && is_array($value)) $value = json_encode($value);

            $setting = [
                'code'  => $code,
                'key' => $this->generateKey($key),
                'value' => $value,
            ];

            Setting::create($setting);
        }

        return true;
    }

    private function generateKey($key)
    {
        $ekey = explode_after_last_underscore($key);

        $end_key = end($ekey);
        $first_key = array_values($ekey);

        $first_key = array_shift($first_key);
        $first_key = Str::singular($first_key);

        if (preg_match('/\d/', $first_key)) {
            if ($this->last_key != $first_key) {
                $this->iteration++;
            }
        }

        $this->last_key = $first_key;

        $org_first_key = $first_key;
        $first_key = preg_replace('/\d/', '', $first_key);

        if (strpos($key, '_')) {
            if (preg_match('/\d/', $org_first_key)) {
                return $first_key . $this->iteration . '_' . $end_key;
            }

            return $first_key . '_' . $end_key;
        }

        return $end_key;
    }
}
