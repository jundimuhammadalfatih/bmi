<?php

class BMIPatient
{
    public int $id;
    public BMI $bmi;
    public String $date;
    public Patient $patient;

    function __construct($id, $bmi, $date, $patient)
    {
        $this->id = $id;
        $this->bmi = $bmi;
        $this->date = $date;
        $this->patient = $patient;
    }
}
