<?php

namespace Indeximstudio\Aliases\lib;

use EvolutionCMS\Main\Components\Aliases\models\TemplateModel;

class Template extends Controller
{
    protected function getAliasesFromDB(): array
    {
        return TemplateModel::getIDsByAliases();
    }
}
