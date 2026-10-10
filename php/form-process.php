<?php

$errorMSG = "";
$formType = $_POST["form_type"] ?? "contact";

if (!in_array($formType, ["contact", "rsvp"], true)) {
    http_response_code(400);
    echo "Invalid form type.";
    exit;
}

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match("/[\r\n]/", $email)) {
        $errorMSG .= "A valid email is required ";
    }
}

if ($formType === "rsvp") {
    if (empty($_POST["guest"]) || !in_array($_POST["guest"], ["1", "2", "3", "4", "5"], true)) {
        $errorMSG .= "Please select a valid guest count. ";
    } else {
        $guest = $_POST["guest"];
    }

    if (empty($_POST["event"]) || !in_array($_POST["event"], ["yes", "no"], true)) {
        $errorMSG .= "Please select whether you can attend. ";
    } else {
        $event = $_POST["event"];
    }
}


// MESSAGE
$message = trim($_POST["message"] ?? "");
if ($formType === "contact" && $message === "") {
    $errorMSG .= "Message is required. ";
}


// Stop before building or sending an email when required fields are invalid.
if ($errorMSG !== "") {
    echo $errorMSG;
    exit;
}

$EmailTo = "armanmia7@gmail.com";
$Subject = $formType === "rsvp" ? "Wedding RSVP Received" : "New Wedding Website Message";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
if ($formType === "rsvp") {
    $Body .= "Guests: ";
    $Body .= $guest;
    $Body .= "\n";
    $Body .= "Attending: ";
    $Body .= $event;
    $Body .= "\n";
}
$Body .= "Message: ";
$Body .= $message !== "" ? $message : "(none)";
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>