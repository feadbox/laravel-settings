<?php

namespace Feadbox\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public function settingable(): MorphTo
    {
        return $this->morphTo();
    }
}
