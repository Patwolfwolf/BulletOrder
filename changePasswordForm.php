<?php
include_once("db_connect.php");
if(isset($_GET['link']) && !empty($_GET['link'])){
	$reset_link = mysql_escape_string($_GET['link']);
	print $reset_link;
}
$op = $_GET['op'];
if ($op == 'update') {
	// if(isset($_GET['link']) && !empty($_GET['link'])){
	// 	$reset_link = mysql_escape_string($_GET['link']);
	// }
	changePassword($_POST, $reset_link);
}

//Abby Shope

function changePassword($data, $reset_link) {

	global $db;
	$email = $data['email'];
	$newPassword1 = $data['newPassword1'];
	$newPassword2 = $data['newPassword2'];

	if ($newPassword1 != $newPassword2) {
		print "new passwords do not match";
	}	//TODO location!!!
	else {
		$pass_return = "SELECT * FROM customer WHERE email='" . $email . "' AND reset='" . $reset_link . "';";
		print $pass_return;
		$result = $db->query($pass_return);
		if ($result == FALSE) {
			print "error, could not update password";
		}
		else {
			$pass = $result->fetch();
			$user_id = $pass['id'];
			$update_password = "UPDATE customer SET password=MD5('" . $newPassword1 . "'), reset = '1' WHERE id=$user_id;";

			if ($db->query($update_password) != FALSE) {
				print "password updated successfully";
			}
			else {
				print "password could not be updated";
			}
		}
	}
}
?>

<HTML>
	<HEAD>

		<TITLE>Change Password</TITLE>

		<META name="viewport" content="width=device-width, initial-scale=1">

			<LINK rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
				<LINK rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">

					<SCRIPT src="js/jquery-1.11.3.min.js"> </SCRIPT>
					<SCRIPT src="js/bootstrap.min.js">     </SCRIPT>

					<STYLE type="text/css">
					/*for all paragraphs*/

					p {
						padding: 100px;
						background: #002F6C;
						color: white;
						font-family: arial;
						text-align: center;
					}

					p.gray {
						padding: 50px;
						font-size: 25px;
						font-weight: bold;
						text-align: center;
						background: #dbdfe5;
						font-family: arial;
					}

					h1 {
						text-align: center;
						color: #002F6C;
						font-family: arial;
					}


					body {
						text-align: center;
						font-family: arial;
					}

					input {
						margin-bottom: 8px;
					}

					form {changePasswordForm.php?op=update&link=". $reset_link
						background: #002F6C;
						font-family: arial;
						color: black;
						font-weight: bold;
						padding: 250px;

					}

					</STYLE>

				</HEAD>

				<BODY>
					<H1> Update Password </H1>

					<DIV class="container">

						<DIV class="row">
							<DIV class="col-md-8">
								<FORM method='POST' action=<?php echo "changePasswordForm.php?op=update&link=". $reset_link?> <!--?op=update-->
									<INPUT type='text' name='email' placeholder='Enter email'/> <BR />
									<INPUT type='password' name="newPassword1" placeholder='New Password'/> <BR />
									<INPUT type='password' name='newPassword2' placeholder='Re-enter New Password' /> <BR />
									<BR />
									<INPUT type='submit' value='Update Password!' />
								</FORM>
							</DIV>
							<DIV class="col-md-4"><P class="gray" >CS360 Spring 2018</P></DIV>
						</DIV> <!-- closes row 1 -->

					</DIV> <!-- closes container -->

				</BODY>
			</HTML>
