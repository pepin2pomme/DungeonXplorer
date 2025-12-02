<?php

// models/Chapter.php

class Chapter
{
    private $id;
    private $title;
    private $description;
    private $image; 
    private $choices;

    public function __construct($id, $title, $description, $choices)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->choices = $choices;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getChoices()
    {
        return $this->choices;
    }
}
