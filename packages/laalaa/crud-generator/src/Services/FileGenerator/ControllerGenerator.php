<?php

namespace LaaLaa\CrudGenerator\Services\FileGenerator;

use LaaLaa\CrudGenerator\Abstracts\ControllerGeneratorAbstract;

class ControllerGenerator extends ControllerGeneratorAbstract
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function createFile()
    {
        $file = fopen('app/Http/Controllers/' . $this->_controllerName . '.php', 'w');
        $txt = "<?php \n";
        $txt .= 'namespace App\Http\Controllers;' . "\n\n";
        $txt .= 'use Illuminate\Http\Request;' . "\n";
        $txt .= 'use App\Http\Controllers\Controller;' . "\n";
        $txt .= 'use App\Services\HttpResponseService as HttpResponse;' . "\n";
        $txt .= 'use App\Services\\' . $this->_serviceName . ';' . "\n\n";
        $txt .= 'class ' . $this->_controllerName . ' extends Controller' . "\n";
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
        $txt .= '}' . "\n";

        fwrite($file, $txt);
        fclose($file);
    }
}
