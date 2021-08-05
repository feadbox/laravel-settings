<?php

namespace Feadbox\Settings\Eloquent\Traits;

use Feadbox\Settings\Models\Setting;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSettings
{
    public function settings(): MorphMany
    {
        return $this->morphMany(Setting::class, 'settingable');
    }
}
