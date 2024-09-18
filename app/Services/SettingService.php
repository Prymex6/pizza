<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingService
{

    private $iteration = 0, $last_key = '';

    public function update($settings, $code)
    {
        Setting::where('code', $code)->delete();

        ksort($settings);

        foreach ($settings ?? [] as $key => $value) {
            if (!empty($value) && is_array($value)) $value = json_encode($value);

            $ekey = explode_after_last_underscore($key);
            $end_key = end($ekey);

            $first_key = array_values($ekey);
            $first_key = array_shift($first_key);
            $first_key = Str::singular($first_key);

            if ($end_key == 'image') {
                if (!empty($value) && $value->isFile()) {
                    $path = $value->store($code, 'public');
                    $value = $path;
                }

                unset($settings[$first_key . '_path']);
            }

            if ($end_key == 'path') {
                if (empty($settings[$first_key . '_image'])) {
                    if (empty($value)) {
                        $value = null;
                    }
                    $key = $first_key . '_image';
                }
            }

            $setting = [
                'code'  => $code,
                'key' => $this->generateKey($key),
                'value' => $value,
            ];

            Setting::create($setting);
        }
        $this->removeImage($code);

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

    private function removeImage($code)
    {
        $images = [];
        foreach (settings()[$code] as $key => $value) {
            $images[] = setting($code . '.' . $key . '_image') ?? null;
        }

        $files = Storage::disk('public')->files($code);
        foreach ($files as $file) {
            if (!in_array($file, $images)) {
                Storage::disk('public')->delete($file);
            }
        }
    }
}
