<?php
namespace App\Http\Controllers\Concerns;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait Searchable
{
    /**
     * Searchable
     * @param Query $query
     * @param string $nameColumn
     * @param string $nameRequest
     *
     * @return Query
     */
    public function whereRawSearch($query, string $nameColumn, string $nameRequest, $is_or = false)
    {
      $keyword = str_replace(' ','', request($nameRequest));
      if (!empty($is_or)){
        return $query->orWhere(DB::raw("replace($nameColumn, ' ','')"), 'LIKE', "%{$keyword}%");
      }
      return $query->where(DB::raw("replace($nameColumn, ' ','')"), 'LIKE', "%{$keyword}%");
    }
}