<?php
//Kyle Sinhart
//Abagale Shope
//Ruiwen Fu
//addUser connects to the SQL database and adds the information from register.php
include_once('db_connect.php');

print_r($_POST);

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phonenum = $_POST['phonenum'];

$passW = $_POST['password'];
$passW = md5($passW);
//$passH = password_hash($passW, PASSWORD_DEFAULT);
$key = $name . $email . date('mY');
$key = md5($key);

$add1 = "INSERT INTO customer VALUE(" . $id . ", '" . $name . "', '". $passW . "', " . $phonenum . ", '" . $email . "', 15, 100, 0, '" . $key . "');";

$result1 = $db->query($add1);
//$result2 = $db->query($add2);

if($result1 != FALSE){// && $result2 != FALSE){
  print "<p>new user named " . $name . " has been added.</p>";



  // confirmation email
  $e_email = "reset@bulletorder.com";
  $e_name = "Account Services"; //$from
  $c_link = 'http://www.cs.gettysburg.edu/~furu01/bullet/confirm.php?email='. $email . '&key=' . $key;
  $e_content = "You have successfully signed up for Speed Bullet. Click the following link to confirm your account.\n" . $c_link;
  $to = $email;
  $subject = "Confirm your account on bulletorder!";

  $header = "From: $e_name <$e_email>\r\n";
  $result = mail($to, $subject, $e_content, $header);

  if ($result == FALSE){
    echo "<p> A confirmation Email was not sent, Invalid user info.</p\n>";
    $url = 'http://www.cs.gettysburg.edu/~furu01/bullet/register.php';
    header( "Location: $url" );

  }
  else {
    echo "<p> A confirmation Email was sent, please check your email.</p\n>";
  }
}
else{
  echo "<p> Invalid user account.</p\n>";
  $url = 'http://www.cs.gettysburg.edu/~furu01/bullet/register.php?success=-1';
  header( "Location: $url" );
}

// print $add1;
//print $add2;



?>
