<?php
    require_once('inc/upload_file.php');
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
        <h1 class="contact__form--header">Send file form</h1>
        <hr class="dec">
        <span class="msh">
            <?php
                if (isset($message)) {
                    echo $message;
                }
            ?>
        </span>
        <hr class="dec">
        <form id="data" method="post" enctype="multipart/form-data" action="">
            <input name="text" type="name" id="name" placeholder="Write your name"/>
            <br><input name="file" type="file" id="file"/>
            <br><button name="send">Send </button>
        </form>
    </section>
</body>
</html>