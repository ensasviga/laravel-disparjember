<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class aboutjember extends Model
{
    use HasFactory;
    protected $fillable = ['title','thumbnail1','thumbnail2','thumbnail3','content'];

    protected static function boot()
    {
        parent::boot();
        static::updating(function($model){
            if($model->isDirty('thumbnail1') &&($model->getOriginal('thumbnail1')!== null)){
                Storage::disk('public')->delete($model->getOriginal('thumbnail1'));
            }

            if($model->isDirty('thumbnail2') &&($model->getOriginal('thumbnail2')!== null)){
                Storage::disk('public')->delete($model->getOriginal('thumbnail2'));
            }

            if($model->isDirty('thumbnail3') &&($model->getOriginal('thumbnail3')!== null)){
                Storage::disk('public')->delete($model->getOriginal('thumbnail3'));
            }
        });
    }
}
