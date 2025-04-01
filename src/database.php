<?php
include_once "./bootstrap.php";

/**
 * @param DB $db
 * @param string $email
 * @return array
 */
function getCustomerByEmail(DB $db, string $email){
    if (!isset($db)){
        return [];
    }
    $result = $db->fetch("SELECT * FROM customers WHERE email = ?", [$email]);
    if (count($result) > 0){
        return $result[0];
    } else {
        return [];
    }
}

$db = new DB();
// Create data
for ($i = 0; $i < 3; $i++){
    $identifier = time();
    $db->insert(
        "INSERT INTO customers(name, email) VALUES(?, ?)",
        [strval($identifier), strval($identifier) . "@gmail.com"]
    );
    sleep(2);
}

// Fetch all customers
$customers = $db->fetch("SELECT * FROM customers");
Logger::Log("There are total of " . strval(count($customers)) . " customers in total:");
// Print header
Logger::Log("ID\tName\t\tEmail\t\t\tCreated at");
// Print body
foreach($customers as $index=>$customer){
    Logger::Log($customer["id"] . "\t" . $customer["name"] . "\t" . $customer["email"] . "\t" . $customer["created_at"]);
}

// Fetch customer with specified email
$email = "samsmith@gmail.com";
Logger::Log();
Logger::Log("Result for customer with email $email:");
$customer = getCustomerByEmail($db, $email);
if (count($customer) > 0){
    // Print header
    Logger::Log("ID\tName\t\tEmail\t\t\tCreated at");
    // Print body
    Logger::Log($customer["id"] . "\t" . $customer["name"] . "\t" . $customer["email"] . "\t" . $customer["created_at"]);
}

$db->close();