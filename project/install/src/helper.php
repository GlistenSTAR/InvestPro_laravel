<?php



function import_database($mysql_host,$mysql_database,$mysql_user,$mysql_password){
    try{
        $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
        $query = file_get_contents("src/database.sql");
        $stmt = $db->prepare($query);
        if ($stmt->execute()){
            return true;
        }
        return false;
    }catch (Exception $exception){
        return false;
    }


}


$base_url = home_base_url();
if (substr("$base_url", -1=="/")) {
    $base_url = substr("$base_url", 0, -4);
}

function home_base_url(){
    $base_url = (isset($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
    $tmpURL = dirname(__FILE__);
    $tmpURL = str_replace(chr(92),'/',$tmpURL);
    $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
    $tmpURL = ltrim($tmpURL,'/');
    $tmpURL = rtrim($tmpURL, '/');
    $tmpURL = str_replace('install','',$tmpURL);
    $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
    return $base_url;
}

function createTable($name, $details, $status){
    if ($status=='1') {
        $pr = '<i class="fa fa-check"><i>';
    }else{
        $pr = '<i class="fa fa-times" style="color:red;"><i>';
    }
    echo "<tr><td>$name</td><td>$details</td><td>$pr</td></tr>";
}

function env_write($base_url,$db_host,$db_name,$db_user,$db_pass){
    $key = base64_encode(random_bytes(32));
    $output = '
  APP_NAME=Laravel
  APP_ENV=production
  APP_KEY=base64:'.$key.'
  APP_DEBUG=false
  APP_LOG_LEVEL=debug
  APP_URL=http://localhost/

  DB_CONNECTION=mysql
  DB_HOST='.$db_host.'
  DB_PORT=3306
  DB_DATABASE='.$db_name.'
  DB_USERNAME='.$db_user.'
  DB_PASSWORD='.$db_pass.'


  BROADCAST_DRIVER=log
  CACHE_DRIVER=file
  SESSION_DRIVER=file
  SESSION_LIFETIME=120
  QUEUE_DRIVER=sync

  REDIS_HOST=127.0.0.1
  REDIS_PASSWORD=null
  REDIS_PORT=6379
  ';
    $file = fopen('../.env', 'w');
    fwrite($file, $output);
    if (fclose($file)){
        return true;
    }
    return false;
}