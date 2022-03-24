<?php

//echo (int)ini_get('post_max_size');
//echo (int)ini_get('upload_max_filesize');
//
//if (((int)ini_get('post_max_size')) > 1) {
//    echo 'cos';
//}

if (isset($_POST['send']) && (($_FILES['file']['error']===0)) ) {
    $message = '';
    if ((isset($_FILES['file']))) {
        $upload_file = $_FILES['file'];
        $ext = pathinfo($upload_file['name'], PATHINFO_EXTENSION);
        $ext = strtolower($ext);

        /* The size, in bytes, of the uploaded file. Below is set 3MB*/
        if (($upload_file['size'] > 3 * 1024 * 1024)) {
            $message = "File is too large";
        }
        /* Check the upload file extension */
        elseif (!in_array($ext, [ 'png','jpg', 'svg', 'gif', 'jpeg'])) {
            $message = "Only images are allowed to upload";
        }
        else {
            move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $_FILES['file']['name']);
            $message = "Your file is uploaded";
        }
    }
    else {
        $message = "Please add file to send";
    }
}

else {
    $message = "Please write your name add file to send";
}