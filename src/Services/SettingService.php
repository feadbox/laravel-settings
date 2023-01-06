<?php

namespace Feadbox\Settings\Services;

use Feadbox\Settings\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SettingService
{
    public function set(string $key, mixed $value, mixed $model = false): Setting
    {
        $search = ['key' => $key];
        $insert = ['value' => $value];

        if ($model !== false) {
            return $model->settings()->updateOrCreate($search, $insert);
        }

        return Setting::updateOrCreate($search, $insert);
    }

    public function get(string $key, mixed $default = null, mixed $model = false)
    {
        if ($item = $this->getModel($key, $model)) {
            return $item->value;
        }

        return $default;
    }

    public function getModel(string $key, mixed $model = false): ?Setting
    {
        if ($model === false) {
            return Setting::query()
                ->where('key', $key)
                ->whereNull('settingable_id')
                ->whereNull('settingable_type')
                ->first();
        }

        if ($model) {
            return $model->settings()->where('key', $key)->first();
        }

        return null;
    }
}
