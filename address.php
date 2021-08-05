<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class informationAddress
{
    private string $email;
    private string $street;
    private string $streetNumber;
    private string $city;
    private string $zipcode;

    public function __construct(string $email, string $street, string $streetNumber, string $city, string $zipcode)
    {
        $this->email = $email;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->zipcode = $zipcode;

    }

    public function getAddress()
    {
         echo "Your email : {$this->email}. <br>";
         echo "Your address : {$this->street} {$this->streetNumber} {$this->city} {$this->zipcode}";
    }
}

 