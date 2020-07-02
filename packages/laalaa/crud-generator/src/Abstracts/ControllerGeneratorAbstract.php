<?php

namespace LaaLaa\CrudGenerator\Abstracts;

// use LaaLaa\CrudGenerator\Interfaces\FileGeneratorInterface;

abstract class ControllerGeneratorAbstract
{
    protected $_controllerName;
    protected $_serviceName;
    protected $_model;
  
    public function __construct($model)
    {
        $this->_model = $model;
        $this->_controllerName = $model . 'Controller';
        $this->_serviceName = $model . 'Service';
    }

    protected function _createGetAllMethod(): string
    {
        $methodName = 'get' . $this->_model . 's';
        $model = strtolower($this->_model) . 's';

        $txt = 'public function ' . $methodName . '(Request $request) {' . "\n";
        $txt .= 'try {' . "\n";
        $txt .= '$' . strtolower($this->_serviceName) . ' = new ' . $this->_serviceName . ';' . "\n";
        $txt .= '$' . $model . ' = $' . strtolower($this->_serviceName) . '->' . $methodName . '();' . "\n\n";
        $txt .= 'return HttpResponse::success($'. $model .');';
        $txt .= "\n" . '} catch(\Exception $e) {' . "\n";
        $txt .= 'return HttpResponse::error($e->getMessage());' . "\n";
        $txt .= '}' . "\n";
        $txt .= "\n" . '}';

        return $txt;
    }

    protected function _createGetOneMethod(): string
    {
        $methodName = 'get' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '(Request $request) {' . "\n";
        $txt .= 'try {' . "\n";
        $txt .= '$' . strtolower($this->_serviceName) . ' = new ' . $this->_serviceName . ';' . "\n";
        $txt .= '$' . $model . ' = $' . strtolower($this->_serviceName) . '->' . $methodName . '();' . "\n\n";
        $txt .= 'return HttpResponse::success($'. $model .');';
        $txt .= "\n" . '} catch(\Exception $e) {' . "\n";
        $txt .= 'return HttpResponse::error($e->getMessage());' . "\n";
        $txt .= '}' . "\n";
        $txt .= "\n" . '}';

        return $txt;
    }

    protected function _createCreateMethod(): string
    {
        $methodName = 'create' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '(Request $request) {' . "\n";
        $txt .= 'try {' . "\n";
        $txt .= '$' . strtolower($this->_serviceName) . ' = new ' . $this->_serviceName . ';' . "\n";
        $txt .= '$' . $model . ' = $' . strtolower($this->_serviceName) . '->' . $methodName . '();' . "\n\n";
        $txt .= 'return HttpResponse::success($'. $model .');';
        $txt .= "\n" . '} catch(\Exception $e) {' . "\n";
        $txt .= 'return HttpResponse::error($e->getMessage());' . "\n";
        $txt .= '}' . "\n";
        $txt .= "\n" . '}';

        return $txt;
    }

    protected function _createUpdateMethod(): string
    {
        $methodName = 'update' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '(Request $request) {' . "\n";
        $txt .= 'try {' . "\n";
        $txt .= '$' . strtolower($this->_serviceName) . ' = new ' . $this->_serviceName . ';' . "\n";
        $txt .= '$' . $model . ' = $' . strtolower($this->_serviceName) . '->' . $methodName . '();' . "\n\n";
        $txt .= 'return HttpResponse::success($'. $model .');';
        $txt .= "\n" . '} catch(\Exception $e) {' . "\n";
        $txt .= 'return HttpResponse::error($e->getMessage());' . "\n";
        $txt .= '}' . "\n";
        $txt .= "\n" . '}';

        return $txt;
    }

    protected function _createDeleteMethod(): string
    {
        $methodName = 'delete' . $this->_model;
        $model = strtolower($this->_model);

        $txt = 'public function ' . $methodName . '(Request $request) {' . "\n";
        $txt .= 'try {' . "\n";
        $txt .= '$' . strtolower($this->_serviceName) . ' = new ' . $this->_serviceName . ';' . "\n";
        $txt .= '$' . $model . ' = $' . strtolower($this->_serviceName) . '->' . $methodName . '();' . "\n\n";
        $txt .= 'return HttpResponse::success($'. $model .');';
        $txt .= "\n" . '} catch(\Exception $e) {' . "\n";
        $txt .= 'return HttpResponse::error($e->getMessage());' . "\n";
        $txt .= '}' . "\n";
        $txt .= "\n" . '}';

        return $txt;
    }
}
