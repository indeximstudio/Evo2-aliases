<?php

namespace Indeximstudio\Aliases\Controllers;

use Indeximstudio\Aliases\Exceptions\{EmptyResourceListException, EmptyTemplateListException};
use Indeximstudio\Aliases\Models\{Resource, Template};

class Alias
{
    /**
     * Возвращает массив шаблонов сайта
     *
     * @return array
     * @throws EmptyTemplateListException
     */
    public static function getTemplateList(): array
    {
        $templateList = Template::get([Template::ID, Template::TEMPLATEALIAS . ' as ' . Resource::ALIAS])->toArray();
        if ($templateList === null) {
            throw new EmptyTemplateListException();
        }

        return self::prepareDataForView($templateList);
    }

    /**
     * Возвращает массив ресурсов сайта
     *
     * @return array
     * @throws EmptyResourceListException
     */
    public static function getResourceList(): array
    {
        $templateList = Resource::get([Resource::ID, Resource::ALIAS])->toArray();
        if ($templateList === null) {
            throw new EmptyResourceListException();
        }

        return self::prepareDataForView($templateList);
    }

    /**
     * Подготавливает массив данных из базы к виду alias => id
     *
     * @param array $data
     * @return array
     */
    private static function prepareDataForView(array $data): array
    {
        $result = [];
        array_walk($data, static function ($item) use (&$result) {
            $result[$item[Resource::ALIAS]] = $item[Resource::ID];
        });

        return $result;
    }
}
