<?php require_once('./sql_connect.php');
      require_once('./server_common.php');
#e.g:curl 'http://ec2-54-193-66-103.us-west-1.compute.amazonaws.com/easyreturns/php/register_user.php?user_id=srihari.padmanabhan@gmail.com&password=abcdef&device_token=9f0cafcc009f226bdc7643d0e904a6e6ea0c7c1d7ca1dd4655425255f6c2c03c'

UpdateResourceAccessStats('SqlTable', array('Users'));
UpdateResourceAccessStats('Webservice', array('register_user.php'));

$success = true;

$user_id = GetInputParameter("user_id");
$device_token = GetInputParameter("device_token");
$password = GetInputParameter("password");
$os_version = GetInputParameter("os_version");

date_default_timezone_set("UTC");
$signup_date = date("Y-m-d H:i:s");

$min_accepted_length=5;

if(strlen($user_id) > $min_accepted_length and strlen($password) > $min_accepted_length)
{
    $encrypted_pass = md5($password);
    
    $sql = "INSERT INTO Users(UserId,Password,DeviceToken,OSVersion,SignUpDate)
            VALUES('$user_id','$encrypted_pass','$device_token','$os_version','$signup_date')";

    $result = mysql_query($sql);
    
    if (!$result)
    {
        $success = false;
    }
}
else
{
    $success = false;
}

mysql_free_result($result);

if($success) {
    $result = array('result' => 'success');
} else {
    $result = array('result' => 'failed');
}

print json_encode($result);

return json_encode($result);
?>