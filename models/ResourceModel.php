<?php

namespace Indeximstudio\Aliases\lib;

abstract class ResourceModel
{
    const TABLE = 'site_content';

    /**
     * @return array
     */
    public static function getIDsByAliases(): array
    {
        $evo = evolutionCMS();
        $out = [];

        $res = $evo->db->query("
            SELECT 
                   `id`, `alias`
            FROM 
                 {$evo->db->getFullTableName(self::TABLE)}
            WHERE 1
        ");


        while ($row = $evo->db->getRow($res)) {
            $out[$row['alias']] = $row['id'];
        }

        return $out;
    }
}
