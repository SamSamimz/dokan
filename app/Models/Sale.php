<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function product() :BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function customer() :BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function due() :HasOne {
        return $this->hasOne(Due::class);
    }

}
