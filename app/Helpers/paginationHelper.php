<?php

namespace App\Helpers;

class PaginationHelper
{
    public static function paginate($query, $perPage = 10)
    {
        $data = $query->paginate($perPage);

        return [
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ]
        ];
    }
}