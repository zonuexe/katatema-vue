<?php

final class Item
{
    private $name;
    private $desc;

    public function __construct(array $source)
    {
        $this->name = isset($source['name']) ? $source['name'] : '';
        $this->desc = isset($source['desc']) ? $source['desc'] : '';
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'desc' => $this->desc,
        ];
    }
}
