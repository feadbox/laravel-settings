<?php

use Feadbox\Settings\Services\SettingService;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('setting')) {
    function setting(string|array $key, mixed $default = null, ?Model $model = null)
    {
        if (is_array($key)) {
            $saved = [];

            foreach ($key as $key => $value) {
                $saved[] = app(SettingService::class)->set($key, $value, $model);
            }

            return $saved;
        }

        return app(SettingService::class)->get($key, $default, $model);
    }
}
