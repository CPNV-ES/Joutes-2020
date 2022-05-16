<?php

namespace App;

class Student
{
    public $lastname;
    public $firstname;
    public $class;
    public $state;

    public function __construct($lastname, $firstname, $class, $state)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->class = $class;
        $this->state = $state;
    }
}
