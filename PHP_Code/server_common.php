<?php require_once('./sql_connect.php');
      
$debug_mode = 1;

function GetInputParameter($parameter_name) {
    global $debug_mode;
    
    if($debug_mode == 1)
    {
        return $_GET[$parameter_name];
    }
    else
    {
        return $_POST[$parameter_name];
    }
}

function UpdateResourceAccessStats($resource_type, $resources) {
    if($resource_type == "SqlTable") {
        $table_name = 'SqlTableAccessStats';
    } else {
        $table_name = 'WebServiceAccessStats';
    }
    
    foreach ($resources as $resource) { 
        $sql = "UPDATE $table_name SET AccessCount=AccessCount+1 WHERE ResourceName='$resource'";
        $result = mysql_query($sql);
    }
}
?>

