<?php

class BMI
{
    public float $weight;
    public float $height;

    function __construct($weight, $height)
    {
        $this->weight = $weight;
        $this->height = $height;
    }

    function ValueBMI()
    {
        $bodyWeight = $this->weight;
        $bodyHeight = $this->height / 100;

        $formulaHeight = $bodyHeight * $bodyHeight;
        $resultHeight = number_format($formulaHeight, 2, '.', '');

        $result = $bodyWeight / $resultHeight;
        $finalResult = number_format($result, 1, '.', '');

        return $finalResult;
    }

    function StatusBMI($mass)
    {
        if ($mass >= 30.0) {
            $status = "Kegemukan (Obesitas)";
        } elseif ($mass >= 25.0 && $mass <= 29.9) {
            $status = "Kelebihan berat badan";
        } elseif ($mass >= 18.5 && $mass <= 24.9) {
            $status = "Normal (Ideal)";
        } elseif ($mass <= 18.4) {
            $status = "Kekurangan berat badan";
        }

        return $status;
    }
}
