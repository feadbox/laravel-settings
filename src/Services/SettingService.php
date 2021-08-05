<?php

namespace Feadbox\Settings\Services;

use Feadbox\Settings\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SettingService
{
    public function set(string $key, mixed $value, ?Model $model = null): Setting
    {
        $search = ['key' => $key];
        $insert = ['value' => $value];

        if ($model) {
            return $model->settings()->firstOrCreate($search, $insert);
        }

        return Setting::firstOrCreate($search, $insert);
    }

    public function get(string $key, mixed $default = null, ?Model $model = null)
    {
        return $this->getModel($key, $model)?->value ?: $default;
    }

    public function getModel(string $key, ?Model $model = null): ?Setting
    {
        if ($model) {
            return $model->settings()->where('key', $key)->first();
        }

        return Setting::where('key', $key)->first();
    }
}
