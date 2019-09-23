<?php

namespace App\core;

class Container
{
    private $items;

    public function set($name, $item, $params = [])
    {

        if (is_callable($item)) {
            $this->items[$name] = call_user_func($item, $params);
        }
    }

    public function get($name)
    {
        return $this->items[$name];
    }
}
