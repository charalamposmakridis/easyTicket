<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    protected $fillable=[
        'assigned_to','user_id','title','description','status','priority'
    ];

    // N/N
    public function categories():BelongsToMany{
        return $this->belongsToMany(Category::class);
    }

    // 1/N
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    // 1/N
    public function agent():BelongsTo{
        return $this->belongsTo(User::class,'assigned_to');
    }
}
