<?php

namespace Application\Models;


abstract class BaseEntity
{

    public function __construct($attributes = null)
    {
        if ($attributes) {
            $this->fill($attributes);
        }
    }

    public function fill(array $vars)
    {
        $has = get_object_vars($this);
        foreach ($has as $name => $oldValue) {
            $this->$name = array_key_exists($name, $vars) ? $vars[$name] : null;
        }
    }

    public function toArray($exclude = [])
    {
        return get_object_vars($this);
    }

    public function attributes()
    {
        $attributes = $this->toArray();

        array_walk($attributes, function (&$element) {
            $element = ($element === null) ? 'null' : $element;
        });

        return $attributes;
    }
}