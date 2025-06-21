<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['id'];

    public function geojson_polygons()
    {
        $polygons = $this
            ->select(DB::raw('
                polygons.id,
                st_asgeojson(polygons.geom) as geom,
                polygons.name,
                polygons.description,
                st_area(polygons.geom, true) as luas_m2,
                st_area(polygons.geom, true)/1000000 as luas_km2,
                st_area(polygons.geom, true)/10000 as luas_hektar,
                polygons.image,
                polygons.created_at,
                polygons.updated_at,
                polygons.user_id,
                users.name as user_created
            '))
            ->leftJoin('users', 'users.id', '=', 'polygons.user_id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'luas_m2' => $p->luas_m2,
                    'luas_km2' => $p->luas_km2,
                    'luas_hektar' => $p->luas_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'user_created' => $p->user_created,
                    'user_id' => $p->user_id,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

    public function geojson_polygon($id)
    {
        $polygons = $this
            ->select(DB::raw('
                polygons.id,
                st_asgeojson(polygons.geom) as geom,
                polygons.name,
                polygons.description,
                st_area(polygons.geom, true) as luas_m2,
                st_area(polygons.geom, true)/1000000 as luas_km2,
                st_area(polygons.geom, true)/10000 as luas_hektar,
                polygons.image,
                polygons.created_at,
                polygons.updated_at,
                polygons.user_id,
                users.name as user_created
            '))
            ->leftJoin('users', 'users.id', '=', 'polygons.user_id')
            ->where('polygons.id', $id)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'luas_m2' => $p->luas_m2,
                    'luas_km2' => $p->luas_km2,
                    'luas_hektar' => $p->luas_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'user_created' => $p->user_created,
                    'user_id' => $p->user_id,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
