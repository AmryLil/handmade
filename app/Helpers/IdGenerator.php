<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IdGenerator
{
  /**
   * Generate a unique ID for a model
   *
   * @param Model $model The model to generate ID for
   * @param string $prefix The prefix for the ID (e.g. 'USR', 'TRX')
   * @param int $length The length of the numeric part of the ID
   * @return string The generated ID
   */
  public static function generateId(Model $model, string $prefix, int $length = 8): string
  {
    // Get the table name
    $table = $model->getTable();

    // Get the primary key field name
    $primaryKey = $model->getKeyName();

    // Generate the date part (YYYYMMDD)
    $date = date('Ymd');

    // Format for the numeric part with leading zeros
    $format = "%0{$length}d";

    // Try to find the latest ID for this model
    // Use the correct primary key
    $lastId = DB::table($table)
      ->orderBy($primaryKey, 'desc')
      ->limit(1)
      ->value($primaryKey);

    // Extract the numeric part from the last ID if it exists
    $lastNum = 0;
    if ($lastId) {
      // Extract just the numeric part (the last $length characters)
      $numericPart = substr($lastId, -$length);
      if (is_numeric($numericPart)) {
        $lastNum = (int) $numericPart;
      }
    }

    // Increment and format with leading zeros
    $nextNum = sprintf($format, $lastNum + 1);

    // Concatenate the parts to form the new ID
    return $prefix . $date . $nextNum;
  }
}
