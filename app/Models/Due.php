<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Due extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function customer() :BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function sale() :BelongsTo {
        return $this->belongsTo(Sale::class);
    }

}
