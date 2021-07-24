<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseRepository implements RepositoryInterface
{
    /**
     * @var JsonResource
     */
    protected $resource;

    /**
     * @var Model
     */
    protected $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    function getAll($options)
    {
        $query = $this->model::query();
        $limit = null;
        if (isset($options['limit']) && is_numeric($options['limit'])) {
            $query = $query->limit($options['limit']);
            $limit = intval($options['limit']);
        }
        if (isset($options['offset']) && is_numeric($options['offset'])) {
            $query = $query->offset($options['offset']);
        }

        $sort = (isset($options['sort']) && in_array($options['sort'], ['asc', 'desc'])) ? $options['sort'] : "asc";

        if (isset($options['order']) && $this->checkColumn($options['order'])) {
            $query = $query->orderBy($options['order'], $sort);
        }

        if (isset($options['limit'])) unset($options['limit']);
        if (isset($options['offset'])) unset($options['offset']);
        if (isset($options['order'])) unset($options['order']);
        if (isset($options['sort'])) unset($options['sort']);

        $count_query = $this->model::query();

        foreach ($options as $key => $option) {
            if ($this->checkColumn($key)) {
                if ($this->checkSearchable($key)) {
                    $query = $query->where($key, "LIKE", '%' . $option . '%');
                    $count_query = $count_query->where($key, "LIKE", '%' . $option . '%');
                } else {
                    $query = $query->where($key, $option);
                    $count_query = $count_query->where($key, $option);
                }
            }
        }

        $count = $count_query->count();

        return [
            'items' => $this->resource::collection($query->get()),
            'count' => $limit ? ($count > $limit ? $limit : $count) : $count,
        ];
    }

    function get($id)
    {
        return new $this->resource($this->model::findOrFail($id));
    }

    function add($data)
    {
        return $this->model::create($data);
    }

    function update($id, $data)
    {
        return $this->get($id)->update($data);
    }

    function delete($id)
    {
        return $this->get($id)->delete();
    }

    private function checkColumn($col)
    {
        return \Schema::hasColumn(app($this->model)->getTable(), $col) ? true : abort(422, $col . " Not found");
    }

    private function checkSearchable($col)
    {
        if (!defined($this->model . "::searchable")) {
            return false;
        }
        return in_array($col, $this->model::searchable);
    }
}
