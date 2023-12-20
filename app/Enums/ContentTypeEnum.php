<?php

namespace App\Enums;

use App\Traits\EnumValues;

enum ContentTypeEnum: string
{
    use EnumValues;

    case ARTICLE = 'article';
    case PAGE = 'page';
}
