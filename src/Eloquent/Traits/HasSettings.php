<?php

namespace Feadbox\Settings\Eloquents\Traits;

use Feadbox\Settings\Models\Setting;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSettings
{
    public function settings(): MorphMany
    {
        return $this->morphMany(Setting::class, 'settingable');
    }
}
