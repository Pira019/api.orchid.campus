<?php
namespace App\Service;

use Illuminate\Support\Facades\Schema;

class ServiceRessource
{

    protected $model;
    public function create($data)
    {
        return $this->model::create($data);
    }
    //save and arrays of column names and values
    public function insert(array $data)
    {
        return $this->model::insert($data);
    }
    protected function insertOrIgnore(array $data)
    {
        return $this->model::insertOrIgnore($data);
    }

    public function update($data, $value, $columnName = "id")
    {

        // Filter out the columns that don't exist in the table
        $validColumns = array_filter($data, function ($column) {
            return Schema::hasColumn('country_steps', $column);
        }, ARRAY_FILTER_USE_KEY);

        //value where to compare and update
        return $this->model::where($columnName, $value)->update($validColumns);
    }

    public function updateOne($data, $valueToCompare, $columnNameToCompare = "id")
    {
        return $this->model::where($columnNameToCompare, $valueToCompare)->update($data);
    }

}
