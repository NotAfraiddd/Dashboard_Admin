<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Support\Facades\Config;

trait Paginatable
{
    /**
     * Pagination
     * @param int perPageMax
     * @param int perPageMin
     *
     * @return int per_page
     */
    public function getPerPage(int $perPageMax = 100, int $perPageMin = 1)
    {
        $perPage = request('per_page', Config::get('models.per_page'));
        return min(max($perPage, $perPageMin), $perPageMax);
    }
}
