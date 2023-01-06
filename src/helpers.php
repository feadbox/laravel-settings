<?php

use Feadbox\Settings\Services\SettingService;

if (!function_exists('setting')) {
    function setting(string|array $key, mixed $default = null, mixed $model = false)
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
