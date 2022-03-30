<?php

/**
 *  Send Form class to the user email with attachment file
 */

class SendForm {

	private $data;
	private $file;
	public $email;
//	public $additional_headers;
	private $errors = [];

//	private static $data_fields = ['username'];
//	private static $file_fields = ['file'];

	public function __construct($post_data, $file_data, $email)
	{
		$this->data = $post_data;
		$this->file = $file_data;
		$this->email = $email;
	}

	public function sendmail()
	{
		$this->pre_sendmail();;
		return $this->errors;
	}

	public function pre_sendmail() {


		//SEND Mail
		if (mail($this->email, $subject, "", $headers)) {
			$this->addErrors('mail', 'mail send ... OK');
		} else {
			$this->addErrors('mail', 'mail send ... ERROR!');
		}
	}

	private function addErrors($key, $val)
	{
		$this->errors[$key] = $val;
	}

}