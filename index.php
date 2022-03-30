<?php
require ('inc/FormValidator.php');
require ('inc/SendForm.php');
if (isset($_POST['submit'])) {
    $validation = new FormValidator($_POST, $_FILES);
    $errors = $validation->validateForm();
    if (empty($errors)) {
	    $sendform = new SendForm( $_POST, $_FILES, 'mov@mov.pl' );
	    $errors   = $sendform->sendmail();
	    if ( ( $errors['mail'] = 'mail send ... OK' ) ) {
		    unset( $_FILES );
		    unset( $_POST );
	    }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Send file form</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <section id="contact__section">
        <h1 class="contact__form--header">Send file</h1>
        <hr class="dec">
        <span class="msh">
            <?php
                if (isset($errors)) {
                    print_r ($errors);
                }
                echo '<br>';
//                if (isset($errors_sendmail)) {
//                    print_r ($errors_sendmail);
//                }
            ?>
        </span>
        <hr class="dec">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >
            <input name="username" type="text" placeholder="Write your name" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"/>
            <br><input name="file" type="file"  />
            <br><button type="submit" name="submit"> Send </button>
        </form>
    </section>
</body>
</html>