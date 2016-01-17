<?php
mysql_connect("localhost","root","");
mysql_select_db("ojs_new");
//echo '<pre>';
include("phpmailer.php");

$current_date=date('Y-m-d');

$root=(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
$root.= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

$base_url = $root;

		$sql_admin = mysql_query( "SELECT * from tbl_admin WHERE id=1");
		$admin_user=mysql_fetch_array($sql_admin);

		
 $sql = "SELECT * from tbl_article as a ,  tbl_users as u WHERE a.art_authoremail ='0' AND a.art_status= '1'  AND   a.art_userid=u.user_id";
$res=mysql_query($sql);
if(mysql_num_rows($res)>0)
{
	
	while($row = mysql_fetch_array($res))
	{		
		
		
		$update_article = mysql_query("UPDATE tbl_article SET `art_authoremail` = '1' WHERE art_id = '".$row['art_id']."'");
		
		
		$auhtor_name = ucfirst($row['user_fname'])." ".ucfirst($row['user_lname']);
	    $sql_user  = "SELECT * from tbl_users WHERE user_type='1' AND user_id!='".$row['art_userid']."'";		
		$user_name ='';
		$user_email ='';
		$res_user=mysql_query($sql_user);
		if(mysql_num_rows($res_user)>0)
		{
			while($row_pro = mysql_fetch_array($res_user))
			{
			
				$user_name =	ucfirst($row_pro['user_fname'])." ".ucfirst($row_pro['user_lname']);
						$user_email =	$row['user_email'];
						
					$subject = 'New Article Submission';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".$base_url."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_name.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'> A new article is sbmitted by ".$auhtor_name.". Article Title is: <br><br> ".$row['art_fulltitle']."<br>Article No.".$row['art_no']."
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$admin_user['footer_copy']."</p>
  </div>
</div>
							</body>
							</html>
							";
						
							
							$mail = new PHPMailer;
		
				$mail->From = $admin_user['email'];
				$mail->FromName = 'OJS ';
				$mail->AddAddress($user_email, $user_name);  // Add a recipient
				$mail->AddCC('votive.techs@gmail.com','Votive');
				
				$mail->IsHTML(true);                                  // Set email format to HTML
				
				$mail->Subject =$subject ;
				$mail->Body    = $message;
				$mail->Send();
				echo '<pre>';
			print_r($mail);
				
		$message='';
			}
		}
			
	//echo '<br><br><br>';
		
	}
}


?>