<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;

trait HasDynamicRelationships
{
    public function dynamicRelationship($name)
    {
        $relations = config('relationships');

        if (isset($relations[$name])) {
            $relation = $relations[$name];

            $type = $relation['type'];
            $model = $relation['model'];
            $foreign_key = $relation['foreign_key'];
            $local_key = $relation['local_key'];

            // Checking if the relationship type is 'belongsToMany'or nott and handling it accordingly
            if ($type === 'belongsToMany') {
                $pivot_table = $relation['pivot_table'];
                $related_key = $relation['related_key'];
                $related_local_key = $relation['related_local_key'];

                return $this->$type($model, $pivot_table, $foreign_key, $related_key, $local_key, $related_local_key);
            } else {
                // For other types (e.g., hasMany, belongsTo, hasOne)
                return $this->$type($model, $foreign_key, $local_key);
            }
        }

        throw new \Exception("Relationship '{$name}' not defined in configuration.");
    }
}



