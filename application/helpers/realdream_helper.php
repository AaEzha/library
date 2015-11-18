<?php
	function send_email($name, $email, $status, $category){
		error_reporting(E_STRICT);

		date_default_timezone_set('Asia/Jakarta');

		require_once('class.phpmailer.php');

		$mail             = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		// $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host 	  = "ssl://smtp.googlemail.com";
		$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
		$mail->Username   = "julynugroho@gmail.com"; // SMTP account username
		$mail->Password   = "22jazuli1991";        // SMTP account password
		$mail->SetFrom('julynugroho@gmail.com', 'Admin Amel');
		$mail->AddReplyTo('julynugroho@gmail.com',"Admin Amel");
		$mail->Subject    = "AMEL Info";
		$mail->AltBody    = ""; // optional, comment out and test
		if ($status=="waiting"){
			$msg = "Terima Kasih telah mendaftar ".$category.", silahkan lengkapi persyaratan yang telah diajukan dan mohon abaikan jika sudah melengkapi persyaratan.";
		} else if ($status=="process") {
			$msg = "Terima Kasih telah melengkapi persyaratan yang telah diajukan. Permintaan untuk pendaftaran ".$category." sedang diproses. Mohon menunggu.";
		} else if ($status=="done") {
			$msg = "Permintaan pendaftaran ".$category." anda sudah selesai, silahkan datang ke unit Learning Center untuk pengambilan sertifikat.<br>As Soon As Possible. Terima Kasih.";
		} else if ($status=="reject") {
			$msg = "Permintaan pendaftaran ".$category." anda kami tolak karena satu dan lain hal.<br>Terima Kasih.";
		}
		$body = "Dear Engineer ".$name.",
			<br>
			".$msg."
			<br>
			<br>
			<br>
			Best Regard
			<br>
			Admin Amel
			<br>
			<br>
			Yuniar Putri";
		$mail->MsgHTML($body);
		// $email = "jazulinugroho22@gmail.com";
		$mail->AddAddress($email, $name);

		if(!$mail->Send()) {
		  return false;
		} else {
		  return true;
		}
	}
	function test(){

	}

	function tanggal($tgl){
		$tanggal = explode(" ", $tgl);
		return $tanggal[0];
	}
	
	function desc_table($tbl)
	{
	
		$data = ($this->db->query("DESC $tbl")->result_array());
		
		for($i=0; $i<count($data); $i++){
			
			$data2 = (explode('(',$data[$i]['Type']));
			if(isset($data2[1]))
			$data[$i]['_length'] = substr($data2[1],0,strlen($data2[1])-1)*1 ;
			else
			$data[$i]['_length'] = 1;
			
			$data2="";
		}
		
		
		foreach($data as $val){
			$data2[($val['Field'])] = $val;
		}
		return $data2;
		
	}
	
	function base64_url_encode($input) {
	 return strtr(base64_encode($input), '+/=', '-_,');
	}

	function base64_url_decode($input) {
	 return base64_decode(strtr($input, '-_,', '+/='));
	}
	
	
	function mail_test(){
	
					
			require_once('phpmailer/class.phpmailer.php');

			include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
			
			$mail             = new PHPMailer();

			$body             = "test211 ".date("Ymd H:i:s");
			$body             = @eregi_replace("[\]",'',$body);

			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "mail.yourdomain.com"; // SMTP server
			$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
													   // 1 = errors and messages
													   // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "e.realdream@gmail.com";  // GMAIL username
			$mail->Password   = "realdreampwd";            // GMAIL password

			$mail->SetFrom('name@yourdomain.com', 'First Last');

			$mail->AddReplyTo("name@yourdomain.com","First Last");

			$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

			$mail->MsgHTML($body);

			$address = "andyrienauld@gmail.com";
			$mail->AddAddress($address, "John Doe");

			// $mail->AddAttachment("images/phpmailer.gif");      // attachment
			// $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
			echo "<pre>";
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  echo "Message sent!";
			}
				
					
		
	
	}
	
		
	function base_domain(){
		$host = $_SERVER['HTTP_HOST'];
		preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
		return "http://".$matches[0]."/";
	}


?>