<?php

namespace LaaLaa\CrudGenerator\Interfaces;

Interface FileGeneratorInterface {
  public function _createGetAllMethod();
  public function _createGetOneMethod();
  public function _createCreateMethod();
  public function _createUpdateMethod();
  public function _createDeleteMethod();
}