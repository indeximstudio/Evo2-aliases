<?php

namespace Indeximstudio\Aliases\Models;

use EvolutionCMS\Main\Configs\ModelConfig;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Template
 *
 * @property integer id
 * @property string templatealias
 * @package EvolutionCMS\Main\Components\Aliases\models
 */
class Template extends Model
{
    public const ID = 'id';
    public const TEMPLATEALIAS = 'templatealias';

    protected $table = 'site_templates';

    protected $casts = [
        self::ID => ModelConfig::CASTS_INTEGER,
        self::TEMPLATEALIAS => ModelConfig::CASTS_STRING
    ];
}