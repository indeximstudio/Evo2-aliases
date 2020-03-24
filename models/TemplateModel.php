<?php

namespace Indeximstudio\Aliases\lib;

abstract class TemplateModel
{
    const TABLE = 'site_templates';

    /**
     * @return array
     */
    public static function getIDsByAliases(): array
    {
        $evo = evolutionCMS();
        $out = [];

        $res = $evo->db->query("
            SELECT 
                   `id`, `templatealias`
            FROM 
                 {$evo->db->getFullTableName(self::TABLE)}
        ");
        while ($row = $evo->db->getRow($res)) {
            $out[$row['templatealias']] = $row['id'];
        }

        return $out;
    }
}
