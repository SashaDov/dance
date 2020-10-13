<?php

namespace App\services;

use App\form\Form;

class FormGetter
{
    protected $source;
    protected $supplier;

    public function __construct($supplier, $source)
    {
        $this->source = $source;
        $this->supplier = $supplier;
    }

    public function getData()
    {
        $form = new Form();
        if ($this->source === 'api') {
            $obj = new ApiParser();
            $data = $obj->parse($this->supplier->getId());
            $form->type = $data->type;
            $form->price = $data->price;
        }


        return $form;
    }
}