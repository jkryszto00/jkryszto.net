<?php

namespace App\Models;

use App\Enums\ContentStatusEnum;
use App\Enums\ContentTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => ContentTypeEnum::class,
        'status' => ContentStatusEnum::class
    ];
}
