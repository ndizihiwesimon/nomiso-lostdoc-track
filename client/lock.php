<?php
session_start();
include 'connect.php';
$_SESSION['locked']=1;
if (isset($_POST['unlock'])) {
  # code...
  $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $mine=$_SESSION['client_id'];
  //Retrieve the client account information for the given id.
    $sql = "SELECT * FROM client WHERE clid=:mine";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':mine', $mine);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
   
        //Compare the passwords.
        $pass=$client['clpass'];
        $validPassword = password_verify($passwordAttempt, $pass);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the client with a login session.
            $_SESSION['locked']=0;
            $curr = $_SESSION['URL'];
            //Redirect to our protected page, which we called home.php
            header("Location: $curr");
            exit;
            
        }
         else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect password combination');
        }
    
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Lock | Nomiso - LostDoc</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  
 
</head>

<body onload="getTime()">
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div class="container">
    <div id="showtime"></div>
    <div class="col-lg-4 col-lg-offset-4">
      <div class="lock-screen">
        <h2><a data-toggle="modal" href="#myModal"><i class="fa fa-lock"></i></a></h2>
        <p>UNLOCK</p>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>


            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="hpanel">
                    <div class="panel-body text-center lock-inner">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          
          <a href="#"><img src="img/notification/4.jpg" alt="" class="img-circle" /></a>
          <h4 style="color: white;"><?php echo $_SESSION['client_name'];   ?></span></h4>
        
                        <h5 style="color: white;"><span class="text-success"></span> <strong><?php echo date('l').", ".date('M d').", ".date('Y');  ?></strong></h5> 
                        <form method="POST" action="lock.php" class="m-t">
                            <div class="form-group">
                                <input style="background-color: black;" type="password" name="password" id="passwordID" required="" placeholder="Your password" class="form-control" autofocus>
                            </div>
                            <button class="btn btn-primary block full-width" type="submit" name="unlock">Unlock</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        </div>
        </div>
        <!-- modal -->
      </div>
      <!-- /lock-screen -->
    </div>
    <!-- /col-lg-4 -->
  </div>
  <!-- /container -->
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
  <script>
    function getTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      // add a zero in front of numbers<10
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('showtime').innerHTML = h + ":" + m + ":" + s;
      t = setTimeout(function() {
        getTime()
      }, 500);
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
 $(document).on('ready', function(){
  $('.modal').on('show.bs.modal', function(){
      $(this).find($.attr('autofocus')).focus();
    });
 });
    
  </script>
</body>

</html>
