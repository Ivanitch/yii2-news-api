<?php

namespace core\entities;

class Meta
{
    public $title;
    public $keywords;
    public $description;

    public function __construct($title, $keywords, $description)
    {
        $this->title = $title;
        $this->keywords = $keywords;
        $this->description = $description;
    }
}