<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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
    ['name' => 'Happy goofy mood 🤪', 'price' => 1000],
    ['name' => 'Happy serious mood 😀', 'price' => 700],
    ['name' => 'Diva attitude mood 💁🏽‍♀️', 'price' => 100],
    ['name' => 'Childish mood 👶', 'price' => 500],
    ['name' => 'Basic neutral mood 😐', 'price' => 10]
];


$totalValue = 0;

function validate()
{
    // This function will send a list of invalid fields back
    $errors = [];

    if (empty($_POST['email'])){
        $errors[] = 'email';
    }

    if (empty($_POST['street'])){
        $errors[] = 'street';
    }

    if (empty($_POST['streetnumber'])){
        $errors[] = 'streetnumber';
    }

    if (empty($_POST['city'])){
        $errors[] = 'city';
    }

    if (empty($_POST['zipcode'])){
        $errors[] = 'zipcode';
    }

    return $errors;
}

function handleForm($products)
{
    /*
    if (isset ($_POST['email']) && isset($_POST['street']) && isset($_POST['streetnumber']) && isset($_POST['city']) && isset($_POST['zipcode'])) {

        // create variables
        $email = $_POST['email'];
        $street = $_POST['street'];
        $streetnumber = $_POST['streetnumber'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];
        

        //show information
        echo '<div class="alert alert-success">'.'Thank you! We received the following information from you: <br>'. $email .'<br>'. $street. '<br>' . $streetnumber . '<br>' . $city . '<br>' . $zipcode . '<br>' . implode(',', $purchasedNames).'</div>' ;
    }
    else {
        echo '<div class="alert alert-danger">'.' Please fill in the form correctly. Thank you!'.'</div>';
    }
    */
    
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
        $selectedProducts = array_keys($_POST['products']);
        $purchasedNames = [];
        foreach($selectedProducts as $key => $selectedProduct) {
            array_push($purchasedNames, $products[$selectedProduct]['name']);
    };

        $message = 'Your email : ' . $_POST['email'] . '<br>';
        $message .= 'Your address : ' . $_POST['street'] . ' ' . $_POST['streetnumber'] . ', ' . $_POST['zipcode'] . ' ' . $_POST['city'] . '<br>';
        $message .= 'You ordered the following moods : ' . implode(',', $purchasedNames);

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