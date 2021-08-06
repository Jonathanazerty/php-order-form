<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'Product.php';
require 'Address.php';

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<pre>';
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
    echo '</pre>';
}

whatIsHappening();

// TODO: provide some products (you may overwrite the example)
$products = [
    new Product ('Happy goofy mood 🤪', 1000),
    new Product ('Happy serious mood 😀', 700),
    new Product ('Diva attitude mood 💁🏽‍♀️', 100),
    new Product ('Childish mood 👶', 500),
    new Product ('Basic neutral mood 😐', 10)
];

// $Goofy = new Product ('Happy goofy mood 🤪', 1000);
// $Serious = new Product ('Happy serious mood 😀', 700);
// $Diva = new Product ('Diva attitude mood 💁🏽‍♀️', 100);
// $Childish = new Product ('Childish mood 👶', 500);
// $Basic = new Product ('Basic neutral mood 😐', 10);

// $Goofy -> getProducts();
// $Serious -> getProducts();
// $Diva -> getProducts();
// $Childish -> getProducts();
// $Basic -> getProducts();


$totalValue = 0;

function validate()
{
    // This function will send a list of invalid fields back
    $errors = [];

    if (empty($_POST['email'])){
        $errors[] = 'email';
        $_SESSION['email'] = $_POST['email'];
    }

    if (empty($_POST['street'])){
        $errors[] = 'street';
        $_SESSION['street'] = $_POST['street'];
    }

    if (empty($_POST['streetnumber'])){
        $errors[] = 'streetnumber';
        $_SESSION['streetnumber'] = $_POST['streetnumber'];
    }

    if (empty($_POST['city'])){
        $errors[] = 'city';
        $_SESSION['city'] = $_POST['city'];
    }

    if (empty($_POST['zipcode']) or !is_numeric($_POST['zipcode'])) {
        $errors[] = 'zipcode';
        $_SESSION['zipcode'] = $_POST['zipcode'];
    }

    if (empty($_POST['moods'])) {
        $errors[] = 'mood';
    }

    return $errors;
}

function handleForm($products)
{    
    $newCustomer = new Address ($_POST['email'], $_POST['street'], $_POST['streetnumber'], $_POST['zipcode'], $_POST['city']);
    $newCustomer -> getAddress();

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        $message = '';
        foreach ($invalidFields as $invalidField) {
            $message .= "You forgot your {$invalidField}" . "<br>";
        };

        return [
            'errors' => true,
            'message' => $message
        ];
    } else {
        // TODO: handle successful submission
            // TODO: form related tasks (step 1)
        $selectedProducts = array_keys($_POST['moods']);
        $purchasedNames = [];
        foreach($selectedProducts as $key => $selectedProduct) {
            array_push($purchasedNames, $products[$selectedProduct]->name);
    };

        $message = 'Your email : ' . $_POST['email'] . '<br>';
        $message .= 'Your address : ' . $_POST['street'] . ' ' . $_POST['streetnumber'] . ', ' . $_POST['zipcode'] . ' ' . $_POST['city'] . '<br>';
        $message .= 'You ordered the following mood(s) : ' . implode(',', $purchasedNames) . '<br>';
        $message .= $_POST['email'] . ', your address has been saved on the browser until the browser is closed.';

        return [
            'errors' => false,
            'message' => $message
        ];
    }
}

// TODO: replace this if by an actual check
$formSubmitted = !empty($_POST);
$result = [];
if ($formSubmitted) {
    $result = handleForm($products);
}

require 'form-view.php';