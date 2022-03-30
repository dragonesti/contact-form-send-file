<?php

/**
 *  Send Form class to the user email with attachment file
 */

class SendForm {

	private $data;
	private $file;
	public $email;
	private $errors = [];

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

		$fromemail = $this->email;
		$subject="Uploaded file attachment";
		$email_message = '<h2>Contact with attachment Submitted by</h2>'. $this->data['username'];
		$email_message.="Please find the attachment below";
		$semi_rand = md5(uniqid(time()));
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

		$headers = "From: ".$fromemail;
		$headers .= "\nMIME-Version: 1.0\n" .
		            "Content-Type: multipart/mixed;\n" .
		            " boundary=\"{$mime_boundary}\"";
		$strFilesName = $this->file['file']["name"];
		$strContent   = chunk_split( base64_encode( file_get_contents( $this->file["file"]["tmp_name"] ) ) );
		$email_message .= "This is a multi-part message in MIME format.\n\n" .
			                  "--{$mime_boundary}\n" .
			                  "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
			                  "Content-Transfer-Encoding: 7bit\n\n" .
			                  $email_message .= "\n\n";
		$email_message .= "--{$mime_boundary}\n" .
			                  "Content-Type: application/octet-stream;\n" .
			                  " name=\"{$strFilesName}\"\n" .
			                  //"Content-Disposition: attachment;\n" .
			                  //" filename=\"{$fileatt_name}\"\n" .
			                  "Content-Transfer-Encoding: base64\n\n" .
			                  $strContent .= "\n\n" . "--{$mime_boundary}--\n";

		if (mail($this->email, $subject, $email_message, $headers)) {
			$this->addErrors('mail', 'mail send ... OK');
		}
		else {
			$this->addErrors('mail', 'mail send ... ERROR!');
		}
	}

	private function addErrors($key, $val)
	{
		$this->errors[$key] = $val;
	}

}