<?php

class Patient
{
    public int $id;
    public String $code;
    public String $name;
    public String $placeOfBirth;
    public String $dateOfBirth;
    public String $email;
    public String $gender;

    function __construct($id, $code, $name, $placeOfBirth, $dateOfBirth, $email, $gender)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->placeOfBirth = $placeOfBirth;
        $this->dateOfBirth = $dateOfBirth;
        $this->email = $email;
        $this->gender = $gender;
    }
}