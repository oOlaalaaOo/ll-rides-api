<?php

namespace LaaLaa\CrudGenerator\Abstracts;

// use LaaLaa\CrudGenerator\Interfaces\FileGeneratorInterface;

abstract class ServiceGeneratorAbstract 
{
    public $_serviceName;
    public $_model;

    public function __construct($model)
    {
        $this->_model = $model;
        $this->_serviceName = $model . 'Service';
    }

    protected function _createGetAllMethod()
    {
        $methodName = 'get' . $this->_model . 's';
        $model = strtolower($this->_model) . 's';

        $txt = 'public function ' . $methodName . '($params = [], $page = null, $perPage = 10, $orderBy = "id", $orderType = "asc") {' . "\n";
        $txt .= '$' . $model . ' = ';
        $txt .= $this->_model . '::when(!is_null($page), function ($query) use ($page, $perPage) {
                        return $query->paginate($perPage, ["*"], $pageName = "page", $page);
                    })
                    ->orderBy($orderBy, $orderType)
                    ->get();';
        $txt .= '\Log::info("shop:get-shops " . json_encode($' . $model . '));' . "\n";
        $txt .= 'return ' . $model . ';';
        $txt .= "\n" . '}';

        return $txt;
    }

    protected function _createGetOneMethod()
    {
        $methodName = 'get' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '($params = [], $orderBy = "id", $orderType = "asc") {' . "\n";
        $txt .= '$' . $model . ' = ';
        $txt .= $this->_model . '::orderBy($orderBy, $orderType)
                    ->first();';
        $txt .= '\Log::info("shop:get-shop " . json_encode($' . $model . '));' . "\n";
        $txt .= 'return ' . $model . ';';
        $txt .= "\n" . '}';

        return $txt;
    }

    protected function _createCreateMethod()
    {
        $methodName = 'create' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '($params = []) {' . "\n";
        $txt .= '$' . strtolower($model) . ' = new ' . $methodName . ';' . "\n";
        $txt .= "\n" . '}';

        return $txt;
    }

    public function _createUpdateMethod()
    {
        $methodName = 'update' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '($params = [], $id) {' . "\n";
        $txt .= '$' . strtolower($model) . ' = ' . $methodName . '::findOrFail($id);' . "\n";
        $txt .= "\n" . '}';

        return $txt;
    }

    protected function _createDeleteMethod()
    {
        $methodName = 'delete' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '($id) {' . "\n";
        $txt .= 'if (\is_null($id)) {
            throw new Exception("id is not specified", 1);
        }' . "\n\n";
        $txt .= 'return ' . $model . '::where("id", $id)->delete();';
        $txt .= "\n" . '}';

        return $txt;
    }
}
