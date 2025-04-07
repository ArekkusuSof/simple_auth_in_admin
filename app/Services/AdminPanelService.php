<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AdminPanelService
{
    public static function getAllNameTables()
    {
        $results = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");

        return array_map(fn($row) => $row->name, $results);
    }

    public static function getTableColumns($table)
    {
        $cols = DB::select("PRAGMA table_info($table)");

        return array_map(fn($c) => $c->name, $cols);
    }
}
