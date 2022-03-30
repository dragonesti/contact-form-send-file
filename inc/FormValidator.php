<?php

/**
 *  Class validate fields from form: username and file
 */

class FormValidator
{
    private $data;
    private $file;
    private $errors = [];
    private static $data_fields = ['username'];
    private static $file_fields = ['file'];

    public function __construct($post_data, $file_data)
    {
        $this->data = $post_data;
        $this->file = $file_data;
    }

    public function validateForm()
    {
//    echo '<pre>';
//    var_dump($this->file['file']);
//    echo '</pre>';
//    echo '<pre>';
//    var_dump($this->data['username']);
//    echo '</pre>';

        $this->validateUser();
        $this->validateFile();
        return $this->errors;
    }

    private function validateUser()
    {
        $val = trim($this->data['username']);
        if (empty($val)) {
            $this->addErrors('username', 'username cannot be empty');
        } else {
            if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
                $this->addErrors('username', 'username must be 6-12 char & alphanumeric ');
            }
        }
    }

    private function validateFile()
    {
        $file_new = $this->file['file'];
        if ($file_new['error'] !== 0) {
            $this->addErrors('file', 'Please add file to send');
        } else {
            $ext = pathinfo($file_new['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            /* The size, in bytes, of the uploaded file. Below is set 3MB*/
            if (($file_new['size'] > 3 * 1024 * 1024)) {
                $this->addErrors('file', 'File is too large');
            } /* Check the upload file extension */
            elseif (!in_array($ext, ['png', 'jpg', 'svg', 'gif', 'jpeg'])) {
                $this->addErrors('file', 'Only images are allowed to upload');
            }
        }
    }

    private function addErrors($key, $val)
    {
        $this->errors[$key] = $val;
    }
}