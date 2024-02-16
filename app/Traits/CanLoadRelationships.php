<?php

namespace App\Traits;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

trait CanLoadRelationships
{
  public function loadRelationships(
    Model|QueryBuilder|EloquentBuilder $for,
    ?array $relations = null
  ): Model|QueryBuilder|EloquentBuilder {
    $relations = $relations ?? $this->relations ?? [];
    foreach ($relations as $relation) {
      $for->when(
        $this->shouldIncludeRelation($relation),
        function ($q) use ($relation, $for) {
          if (($for instanceof Model)) {
            $for->load($relation);
          } else {
            if ($relation === Config::get('variables.VENUERATING')) {
              $q->withAvg($relation, 'rating_id')->orderBy('venue_rating_avg_rating_id', 'desc');
            }
            $q->with($relation);
          }
        }
      );
    }
    return $for;
  }

  protected function shouldIncludeRelation(string $relation): bool
  {
    $include = request()->query('include');
    $relations = array_map('trim', explode(',', $include));
    if (!$include) {
      return false;
    }

    return in_array($relation, $relations);
  }
}
