<?php

namespace Indeximstudio\Aliases\controllers;

use EvolutionCMS\Main\Components\Aliases\exception\ControllerNotFoundException;
use EvolutionCMS\Main\Components\SnippetResult\constants\OutputModes;
use EvolutionCMS\Main\Components\SnippetResult\controllers\SnippetResult;
use EvolutionCMS\Main\Components\SnippetResult\exceptions\InvalidOutputModeException;
use EvolutionCMS\Main\Components\Aliases\lib\Resource;
use EvolutionCMS\Main\Components\Aliases\lib\Template;
use ReflectionException;

class Controller
{
    /** @var SnippetResult */
    private $SnippetResult;
    /** @var Resource */
    private $ModeController;

    public function __construct()
    {
        $this->SnippetResult = new SnippetResult;
    }

    public function getID($params)
    {
        /**
         * @var int $mode
         * @var string $type {resource|template}
         * @var string $delimiter
         * @var string $aliases
         */
        $this->SnippetResult->process_info = $params;
        extract($params, EXTR_SKIP);
        $mode = (int)$mode ?: OutputModes::HTML_OUTPUT_MODE;
        $type = $type ?: '';
        $delimiter = $delimiter ?: ',';
        $aliases = $aliases ?: null;
        /** @var string|array|null $aliases */
        $aliases = is_string($aliases)
            ? array_map('trim', explode($delimiter, $aliases))
            : $aliases;

        try {
            $this->SnippetResult->setOutputMode($mode);

            switch ($type) {
                case 'resource':
                    $this->ModeController = new Resource($aliases);
                    break;
                case 'template':
                    $this->ModeController = new Template($aliases);
                    break;
                default:
                    throw new ControllerNotFoundException(
                        sprintf("A controller with an alias '%s' does not exist!", $aliases)
                    );
            }

            $this->SnippetResult->setResult(true, $this->ModeController->getIDs());
        } catch (InvalidOutputModeException
        | ControllerNotFoundException
        | ReflectionException $e
        ) {
            $this->SnippetResult->setResult(false, null, $e->getCode(), $e->getMessage());
        }

        switch ($mode) {
            case OutputModes::HTML_OUTPUT_MODE:
            case OutputModes::JSON_OUTPUT_MODE:
                return (string)$this->SnippetResult;

            default:
                return $this->SnippetResult;
        }
    }

    /**
     * @param $params
     * @return array|null
     */
    public function getAll($params): ?array
    {
        // todo исправить под Evo 2.0 не передаются Aliases
        if (empty($params['type']) || empty($params['aliases'])) {
            return null;
        }
        $this->getID($params);

        return $this->ModeController->getAll();
    }
}
