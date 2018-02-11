<?php

// Replace this with your own email address
$siteOwnersEmail = 'bmdumoulin10@gmail.com';


if($_POST) {

  $email = 'gunderja@gmail.com';
  $name_one = trim(stripslashes($_POST['contactName']));
  $name_two = trim(stripslashes($_POST['contactName2']));
  $rsvp = trim(stripslashes($_POST['rsvp']));
  $dinner_one = trim(stripslashes($_POST['dinner1']));
  $dinner_two = trim(stripslashes($_POST['dinner2']));
  $subject = "Online Wedding RSVP";

  // Check Guest 1 Name
	if (strlen($name_one) < 2) {
		$error['name_one'] = "Please enter a name for Guest 1.";
	}
  // Check RSVP
  if (.$rsvp == 'None') {
    $error['rsvp'] = "Please choose an RSVP response.";
  }
	// If No Guest 2
  if ($name_two == '' || strlen($name_two) < 2) {
    $name_two = "None";
    $dinner_two = "None";
  }

  // Set Message
  $message .= "Email from: " . $name_one . "<br />";
  // Not Attending
  if (.$rsvp == 'No') {
    $message .= "Unfortuanately I/We will not be able to attend your wedding. Thank you for the invite. <br />";
    $message .= "Guest 1: " . $name_one . "<br />";
    $message .= "Guest 1 Dinner: " . $dinner_one . "<br />";
    $message .= "Guest 2: " . $name_two . "<br />";
    $message .= "Guest21 Dinner: " . $dinner_two . "<br />";
  // Attending
  } else {
    $message .= "I/We am/are beyond excited to attend your wedding. We cannot wait to celebrate with you. <br />";
    $message .= "Guest 1: " . $name_one . "<br />";
    $message .= "Guest 1 Dinner: " . $dinner_one . "<br />";
    $message .= "Guest 2: " . $name_two . "<br />";
    $message .= "Guest 2 Dinner: " . $dinner_two . "<br />";
  }
  $message .= "<br /> ----- <br /> This email was sent from your Wedding site's RSVP form. For further questions regarding the Guest, reach out to them directly as a reply to this email will not reach them.<br />";

   // Set From: header
  $from =  $siteOwnersEmail;

  // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


   if (!$error) {

      ini_set("sendmail_from", $siteOwnersEmail); // for windows server
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Something went wrong. Please try again."; }

	} # end if - no validation error

	else {

		$response = (isset($error['name_one'])) ? $error['name_one'] . "<br /> \n" : null;
		$response .= (isset($error['rsvp'])) ? $error['rsvp'] . "<br /> \n" : null;

		echo $response;

	} # end if - there was a validation error

}

?>
