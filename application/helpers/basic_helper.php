<?php
function  languageLoad($lang){	
	$language = isset($lang)&& !empty($lang)?$lang:'english';
	$CI = & get_instance();
	if($language=="french"){
		$CI->lang->load('french_lang', 'french');
	}else if($language=="arabic"){
		$CI->lang->load('arabic_lang', 'arabic');
	}else if($language=="english"){
		$CI->lang->load('english_lang', 'english');
	}else if($language=="spanish"){
		$CI->lang->load('spanish_lang', 'spanish');
	}
}
function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

function random_generator($s = 0, $e = 8){
	$now = substr( md5(time().uniqid()), $s, $e );
	return $now;
}

function getRandomNumber($n){
	$seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789!@#$%^&*()'); // and any other characters
	shuffle($seed); // probably optional since array_is randomized; this may be redundant
	$rand = '';
	foreach (array_rand($seed, $n) as $k) $rand .= $seed[$k];
	return $rand;
}
function filename_withoutext( $filename ){
	$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
	return $withoutExt;
}

function super_unique($array){
  $result = array_map("unserialize", array_unique(array_map("serialize", $array)));
  return $result;
}

function get_first_letter( $str ){
	$acronym = "";
	if(!empty($str)){
		$words = explode(" ", $str);
	
		foreach ($words as $w) {
			$acronym .= isset($w[0]) ? $w[0] : '';
		}
	}
	return $acronym;
}

function remove_directory($directory){
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            remove_directory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}

function file_get_contents_curl($url){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

// array( 'to' => '', 'from' => '', 'subject' => '', 'message' => '' )
function send_mail( $mail ){
	include('mandrill/Mandrill.php');
	try {
		$mandrill = new Mandrill('Llm23oJb5EprI7xnVulIXA');
		$message = array(
			'html' => $mail['html'],
			'subject' => $mail['subject'],
			'from_email' => $mail['from_email'],
			'from_name' => $mail['from_name'],
			'to' => $mail['to'],
			'headers' => $mail['headers'],
		);
		
		if(!empty($attachment)){
			$message['attachments']='[
				{
					"type": "text/plain",
					"name": "myfile.txt",
					"content": "ZXhhbXBsZSBmaWxl"
				}
			]';
		}
		
		$async = true;
		$ip_pool = 'Main Pool';
		$send_at = null;
		$result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
		
		if(isset($result[0]['status']) && $result[0]['status'] == 'sent'){
			return $result[0]['email'];
		}else{
			return $result;
		}
		/*
		Array
		(
			[0] => Array
				(
					[email] => recipient.email@example.com
					[status] => sent
					[reject_reason] => hard-bounce
					[_id] => abc123abc123abc123abc123abc123
				)
		
		)
		*/
	} catch(Mandrill_Error $e) {
		// Mandrill errors are thrown as exceptions
		echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
		// A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
		throw $e;
	}
}

function sendmailTemplate($template_name, $mail,$var=false,$data=false,$smpt_option=false){
 
    $data_smpt = json_decode($smpt_option,true);
   if(isset($data_smpt['enable_smpt']) && $data_smpt['enable_smpt'] == 'true'){
	    $CI = & get_instance();
		$CI->load->library('email'); // load library 
		$body = $CI->load->view('email-templates/autho_email_template',$data,TRUE);
		$frommail = $data_smpt['from_mail'];
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = trim($data_smpt['smtp_host']);
		$config['smtp_port'] = trim($data_smpt['smtp_port']);
		$config['smtp_user'] = trim($data_smpt['smtp_user']);
		$config['smtp_pass'] = trim($data_smpt['smtp_pass']);
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['smtp_crypto'] = trim($data_smpt['smpt_crypto']);
		$config['newline'] = "\r\n";
		  
		// Set to, from, message, etc.
		$CI->email->initialize($config);
		$CI->email->from($frommail, $data_smpt['mail_title']);
		$to = $mail['email'];
		$CI->email->to($to);
		$sub = $mail['name'];
		$CI->email->subject($sub);
		$CI->email->message($body);
		if(!$CI->email->send()){
			$result = $CI->email->print_debugger(1);
		}	
    }else{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send-template.json');
		curl_setopt($ch,CURLOPT_POSTFIELDS, '{
			"key":"NtSxVXvKNB_5JQOjv5bFTw",
			"template_name":"'.$template_name.'",
			"template_content":[],
			"message":{
				"to":[
					{"email":"'.$mail['email'].'",
					"name":"'.$mail['name'].'",
					"type":"to"}
				],
				"headers": {
					"Reply-To": "no-reply@app.pixaguru.com"
				},
				"merge": true,
				"global_merge_vars": '.$var.'
			},
			"async":false,
			"ip_pool":"Main Pool"
		}');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
		return $result;
	}
	
}

function date_diffrence( $d1, $d2 ){
	$now = strtotime( $d1 ); // or your date as well
	$your_date = strtotime( $d2 );
	$datediff = $now - $your_date;

	return round($datediff / (60 * 60 * 24));
}
function read_folder($folder,$specific_entries = NULL) {
       
	$entrynames = array();

	if (is_dir($folder) AND ($hendel = opendir($folder))) {
		while ($entryname = readdir($hendel)) {
			if ($entryname !== "." AND $entryname !==".." AND $entryname !==".DS_Store") {

				if ($specific_entries ===NULL) {
					$entrynames[] = $entryname;
				}elseif ($specific_entries ==="subfolders_only"){
					if (is_dir($folder."/".$entryname)) {
						$entrynames[] = $entryname;
					}
				}elseif (!$specific_entries ==="files_only"){
					if (is_dir($folder."/".$entryname)) {
						$entrynames[] = $entryname;
					}
				}elseif (is_array($specific_entries)){					
					$extension = substr($entryname,strrpos($entryname,"."));

					if (in_array(strtolower($extension),$specific_entries)) {
						$entrynames[] = $entryname;
					}
				}
			
			}
		}
		
		closedir($hendel);
	}
	
	sort($entrynames,SORT_NATURAL | SORT_FLAG_CASE);
	
	return $entrynames; 
}

function CountImporterData($filePath){
	// Temporary variable, used to store current query
	$templine = '';

	// Read in entire file
	$lines = file($filePath );
	
	// Loop through each line
	foreach ($lines as $line)
	{

	// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;

		// Add this line to the current segment
		$templine .= $line;

	}
	return $templine;
}