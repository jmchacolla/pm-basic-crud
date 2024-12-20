<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PmTable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pm_table';
    protected $primaryKey = 'id';
    protected $attributes = [
        'status' => 'active',
        //'uuid' => Str::uuid()->toString()
    ];

    protected $fillable = [
        'uuid', 'name', 'description', 'code', 'status'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
    use HasFactory;
}
