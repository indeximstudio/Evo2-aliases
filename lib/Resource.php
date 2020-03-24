<?php

namespace Indeximstudio\Aliases\lib;

use EvolutionCMS\Main\Components\Aliases\models\ResourceModel;

class Resource extends Controller
{
    protected function getAliasesFromDB(): array
    {
        return ResourceModel::getIDsByAliases();
    }
}
