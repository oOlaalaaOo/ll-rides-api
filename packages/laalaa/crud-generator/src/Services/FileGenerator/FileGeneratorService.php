<?php

namespace LaaLaa\CrudGenerator\Services\FileGenerator;

use LaaLaa\CrudGenerator\Services\FileGenerator\ControllerGenerator;
use LaaLaa\CrudGenerator\Services\FileGenerator\ServiceGenerator;

class FileGeneratorService
{
    private $_model;

    public function __construct($model)
    {
        $this->_model = $model;
    }

    public function generateAllFiles()
    {
        $serviceGenerator = new ServiceGenerator($this->_model);
        $controllerGenerator = new ControllerGenerator($this->_model);

        $serviceGenerator->createFile();
        $controllerGenerator->createFile();
    }
}
