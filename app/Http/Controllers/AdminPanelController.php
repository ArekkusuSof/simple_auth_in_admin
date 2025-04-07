<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\AdminPanelService;

class AdminPanelController extends Controller
{
    public function index(Request $request, $table = null)
    {
        $data = null;
        $columns = [];

        DB::getDriverName() === 'sqlite'
                ? $tables = AdminPanelService::getAllNameTables()
                : abort(403, 'Only SQLite is supported.');

        if (!Auth::check() || Auth::user()->role_id != 2) abort(403);

        if ($table && in_array($table, $tables)) {
            $data = DB::table($table)->get();

            if ($data->isEmpty()) $columns = AdminPanelService::getTableColumns($table);

        } else {
            $table = null;
        }

        return view('admin-panel', compact('tables', 'table', 'data', 'columns'));
    }

    public function edit(Request $request, $table, $id)
    {
        $tables = AdminPanelService::getAllNameTables();

        if (!Auth::check() || Auth::user()->role_id != 2) abort(403);

        if (!in_array($table, $tables)) abort(403, 'Access denied.');

        $record = DB::table($table)->where('id', $id)->first();

        if (!$record) abort(404, 'Record not found.');

        return view('admin-edit', compact('table', 'record'));
    }

    public function update(Request $request, $table, $id)
    {
        $tables = AdminPanelService::getAllNameTables();

        if (!in_array($table, $tables)) abort(403, 'Access denied.');

        $data = $request->except(['_token', '_method']);

        DB::table($table)->where('id', $id)->update($data);

        return redirect()->route('admin', ['table' => $table])->with('success', 'Record updated.');
    }

    public function destroy($table, $id)
    {
        $tables = AdminPanelService::getAllNameTables();

        if (!in_array($table, $tables)) abort(403, 'Access denied.');

        DB::table($table)->where('id', $id)->delete();

        return redirect()->route('admin', ['table' => $table])->with('success', 'Record deleted.');
    }
}
