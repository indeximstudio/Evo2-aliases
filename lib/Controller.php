<?php

namespace Indeximstudio\Aliases\lib;

abstract class Controller implements WhichReturnAnIdentifier
{
    /** @var int */
    const VERY_LARGE_NUMBER = 999999999999;

    /** @var int[]|array */
    protected $aliases = [];

    public function __construct(?array $aliases)
    {
        array_walk($aliases, function ($alias) {
            $this->aliases[$alias] = static::VERY_LARGE_NUMBER;
        });

        $this->loadDataIntoSession();

        return $this->getAliasesFromSession();
    }

    abstract protected function getAliasesFromDB(): array;

    public function getIDs(): string
    {
        return is_array($this->aliases)
            ? implode(',', $this->aliases)
            : (string)$this->aliases;
    }

    public function getAll(): array
    {
        return $_SESSION['sn.aliases'][static::class];
    }

    /**
     * @return $this
     */
    protected function getAliasesFromSession()
    {
        array_walk(
            array_uintersect(array_keys($this->aliases), array_keys($_SESSION['sn.aliases'][static::class]), 'strcasecmp'),
            function ($alias) {
                $this->aliases[$alias] = $_SESSION['sn.aliases'][static::class][$alias];
            }
        );

        return $this;
    }

    private function loadDataIntoSession()
    {
        if (!isset($_SESSION['sn.aliases'][static::class])) {
            $_SESSION['sn.aliases'][static::class] = $this->getAliasesFromDB();
        }
    }
}
