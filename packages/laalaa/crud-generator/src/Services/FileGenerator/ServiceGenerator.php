<?php

namespace LaaLaa\CrudGenerator\Services\FileGenerator;

use LaaLaa\CrudGenerator\Abstracts\ServiceGeneratorAbstract;

class ServiceGenerator extends ServiceGeneratorAbstract
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function createFile()
    {
        $file = fopen('app/Services/' . $this->_serviceName . '.php', 'w');
        $txt = '<?php' . "\n";
        $txt .= 'namespace App\Services;' . "\n\n";
        $txt .= 'use App\\' . $this->_model . ';' . "\n\n";
        $txt .= 'class ' . $this->_serviceName . "\n";
        $txt .= '{' . "\n";
        $txt .= $this->_createGetAllMethod();
        $txt .= "\n\n";
        $txt .= $this->_createGetOneMethod();
        $txt .= "\n\n";
        $txt .= $this->_createCreateMethod();
        $txt .= "\n\n";
        $txt .= $this->_createUpdateMethod();
        $txt .= "\n\n";
        $txt .= $this->_createDeleteMethod();
        $txt .= "\n\n";
        $txt .= '}';

        fwrite($file, $txt);
        fclose($file);
    }
}
