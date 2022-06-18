<?php

namespace App\Dtos;

class ProductDTO
{
   private $entity;

   public static function make($model)
   {
       return new self($model);
   }

   public function __construct($model)
   {
       $this->entity = (object) $model->toArray();
   }

   public function __get($name)
   {
       return $this->entity->{$name};
   }
}