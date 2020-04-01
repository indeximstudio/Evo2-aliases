<?php

namespace Indeximstudio\Aliases\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resource
 *
 * @property integer id
 * @property string alias
 * @package EvolutionCMS\Main\Components\Aliases\models
 */
class Resource extends Model
{
    public const ID = 'id';
    public const ALIAS = 'alias';

    protected $table = 'site_content';

    protected $casts = [
        self::ID => 'integer',
        self::ALIAS => 'string'
    ];
}