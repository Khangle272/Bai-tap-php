<?php
namespace students;

class Person
{
    protected $name;
    protected $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getInfo()
    {
        return "Tên: {$this->name} - Tuổi: {$this->age}";
    }
}
?>