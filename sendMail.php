<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/SMTP.php";
require_once "PHPMailer/src/Exception.php";
function SendMail($Username, $Password, $Name, $DiaChi, $ReplyTos, $TieuDe, $NoiDung)
{
	$Mail = new PHPMailer(true);
	$Mail -> IsSMTP();
	$Mail -> SMTPDebug = 0;
	$Mail -> SMTPAuth = true;
	$Mail -> SMTPSecure = "ssl";
	$Mail -> Host = "smtp.gmail.com";
	$Mail -> Port = "465";
	$Mail -> Username = $Username;
	$Mail -> Password = $Password;
	foreach ($DiaChi as $DC) {
		$Mail -> AddAddress($DC[0],$DC[1]);
	}
	foreach ($ReplyTos as $key) {
		$Mail -> AddReplyTo($key[0],$key[1]);
	}
	$Mail -> SetFrom($Username, $Name);
	$Mail -> Subject = $TieuDe;
	$Mail -> MsgHTML($NoiDung);
	$Mail -> CharSet = 'UTF-8';
	$Mail -> Send();
}
?>