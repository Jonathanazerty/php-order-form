<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class informationAddress
{
    private string $email;
    private string $street;
    private float $streetNumber;
    private string $city;
    private float $zipcode;

    public function __construct(string $email, string $street, float $streetNumber, string $city, float $zipcode)
    {
        $this->email = $email;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->zipcode = $zipcode;

    }

    // public function getInfo()
    // {
         
    // }
}

 