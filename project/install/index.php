<!DOCTYPE html>
<html>
<head>
    <title>Installer</title>
    <link href="../public/admin/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/custom.css" rel="stylesheet">
    <script src="../public/admin/js/jquery.min.js"></script>
    <script src="../public/admin/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background: #1d2124;">
<div class="container">

    <?php include 'src/helper.php'?>
    <?php

    if ($_POST) {
        $db_name = $_POST['db_name'];
        $db_host = $_POST['db_host'];
        $db_user = $_POST['db_user'];
        $db_pass = $_POST['db_pass'];

  if(import_database($db_host,$db_name,$db_user,$db_pass)){
      if (env_write($base_url,$db_host,$db_name,$db_user,$db_pass)){
          echo '<div style="text-align:center; text-transform:uppercase; margin-top: 200px;">
          <h1 class="text-success">Installed Successfully </h1><br>
          <a href="http://'.$_SERVER['HTTP_HOST'].'" class="btn btn-success btn-sm">Go to Website</a>
          <br><br><b style="color:red;">Please Delete The Install Folder</b><br><br><br></div>';
      }else{
          echo '<div style="text-align:center; text-transform:uppercase;"><h2 class="text-center" style="color:red;">Please Check Your Database Credential!<div>
                    <br><a href="'.$base_url.'/install" class="btn btn-success btn-sm text-center">Go to Install Page</a></div>';
      }
  }else{

  echo  '<div style="text-align:center; text-transform:uppercase;">
            <h2 class="text-center" style="color:red;">Please Check Your Database Credential!<h2>
                    <br><a href="'.$base_url.'/install" class="btn btn-success btn-sm text-center">Go to Install Page</a></div>';
  }
    }else{
        echo '
        <div class="row">
         <div class="col-md-6 text-center">
           <div class="form-sec mt-5">
                <h4>Server Requirements</h4>
                <table class="table">
                  <tbody>

                    <tr>
                      <th scope="row">Required PHP version 7.2.0 or higher</th>
                    </tr>

                     <tr>
                      <th scope="row">Required openssl PHP Extension</th>
                    </tr>

                    <tr>
                      <th scope="row">Required pdo PHP Extension</th>
                    </tr>

                    <tr>
                      <th scope="row">Required mbstring PHP Extension</th>
                    </tr>

                    <tr>
                      <th scope="row">Required tokenizer PHP Extension</th>
                    </tr>

                    <tr>
                      <th scope="row">Required JSON PHP Extension</th>
                    </tr>

                    <tr>
                      <th scope="row">Required cURL PHP Extension</th>
                    </tr>

                     <tr>
                      <th scope="row">Required XML PHP Extension</th>
                    </tr>

                    <tr>
                      <th scope="row">Required fileinfo PHP Extension</th>
                    </tr>



                  </tbody>
                </table>
            </div>
         </div>
        <div class="col-md-6">
            <div class="form-sec mt-5">
                <h4>MySql Installer</h4>

                <form method="post" action="" novalidate="novalidate">

                    <div class="form-group">
                        <label>Database Name:</label>
                        <input class="form-control input-lg" name="db_name" placeholder="Database Name" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Database Host:</label>
                        <input class="form-control input-lg" name="db_host" placeholder="Database Host" type="text" required>
                    </div>

                    <div class="form-group">
                        <label>Database User:</label>
                        <input class="form-control input-lg" name="db_user" placeholder="Database User" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input class="form-control input-lg" name="db_pass" placeholder="Password" type="text">
                    </div>

                    <button type="submit" class="btn btn-primary">INSTALL NOW</button>
                </form>
            </div>
        </div>
    </div>';
    }
    ?>
</div>
</body>
</html>
