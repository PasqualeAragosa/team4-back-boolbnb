<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class View extends Model
{
    use HasFactory;

    /**
     * The views that belongsto the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function properties(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
