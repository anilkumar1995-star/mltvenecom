<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TableHelpers
{
    /**
     * Apply common search and filters to a query.
     */
    public static function applyTableLogic(Builder $query, Request $request, array $searchableColumns, array $filterableColumns)
    {
        // 1. Apply Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    if (str_contains($column, '.')) {
                        // Handle relationship search like 'user.name'
                        $parts = explode('.', $column);
                        $relation = $parts[0];
                        $relColumn = $parts[1];
                        $q->orWhereHas($relation, function ($relQ) use ($relColumn, $search) {
                                        $relQ->where($relColumn, 'like', "%{$search}%");
                                    }
                                    );
                                }
                                else {
                                    $q->orWhere($column, 'like', "%{$search}%");
                                }
                            }
                        });
        }

        // 2. Apply Advanced Filters
        if ($request->filled('filter_columns')) {
            $columns = $request->input('filter_columns', []);
            $operators = $request->input('filter_operators', []);
            $values = $request->input('filter_values', []);

            foreach ($columns as $i => $column) {
                if (!empty($column) && isset($values[$i]) && $values[$i] !== '') {
                    $operator = $operators[$i] ?? '=';
                    $value = $values[$i];

                    if (in_array($column, $filterableColumns)) {
                        if ($operator === 'like') {
                            $query->where($column, 'like', "%{$value}%");
                        }
                        else {
                            $query->where($column, $operator, $value);
                        }
                    }
                }
            }
        }

        return $query;
    }

    /**
     * Get per_page limit.
     */
    public static function getPerPage(Request $request, $default = 10)
    {
        return $request->input('per_page', $default);
    }

    /**
     * Common Bulk Delete Logic
     */
    public static function performBulkDelete(Request $request, string $modelClass, string $name = 'items')
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => "No $name selected."], 400);
        }

        try {
            $modelClass::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => "Selected $name deleted successfully."]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error deleting $name: " . $e->getMessage()], 500);
        }
    }

    /**
     * Common Single Delete Logic (for AJAX)
     */
    public static function performDelete($idOrModel, string $modelClass, string $name = 'item')
    {
        try {
            $item = is_object($idOrModel) ? $idOrModel : $modelClass::findOrFail($idOrModel);
            $item->delete();
            return response()->json(['success' => true, 'message' => ucfirst("$name deleted successfully.")]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error deleting $name: " . $e->getMessage()], 500);
        }
    }
}
