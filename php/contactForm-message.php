<?php
  /*flesh out the body of the email*/
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];
  $timestp = date("F j, Y, g:i a");

  $EmailTo = "martinparry94@googlemail.com";
  $Subject = "Quiz System Message";

  $Body .= "Name: \t";
  $Body .= $name;
  $Body .= "\n";

  $Body .= "Email: \t";
  $Body .= $email;
  $Body .= "\n";

  $Body .= "Message: \n";
  $Body .= $message;
  $Body .= "\n \n";

  $Body .= $timestp;

  /*send mail*/
  $success = mail($EmailTo, $Subject, $Body);

  /*report if successful or not*/
  if($success) {
    echo "success";
  } else {
    echo "invalid";
  }
?>
