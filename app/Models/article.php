<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class article extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'title', 'thumbnailimg', 'place', 'content'];

    protected static function boot()
    {
        parent::boot();
        static::updating(function($model){
            if($model->isDirty('thumbnailimg') &&($model->getOriginal('thumbnailimg')!== null)){
                Storage::disk('public')->delete($model->getOriginal('thumbnailimg'));
            }
        });
    }
}
