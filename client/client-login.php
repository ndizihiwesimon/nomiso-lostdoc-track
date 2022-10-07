<?php
$action = 'Login';
include 'client-header.php';
require 'connect.php';

//If the POST var "login" exists (our submit button), then we can
//assume that the client has submitted the login form.
if(isset($_POST['login'])){
    session_start();
    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the client account information for the given username.
    $sql = "SELECT * FROM client WHERE clphone = :username || clemail = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($client === false){
        //Could not find a client with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect username');
    }
    elseif ($client['clstatus'] == 0) {
         # code...
        die('Your account is disabled, contact administrator');
     } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $pass=$client['clpass'];
        $validPassword = password_verify($passwordAttempt, $pass);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the client with a login session.
            $_SESSION['client_id'] = $client['clid'];
            $_SESSION['client_name'] = $client['clfname'];
            $_SESSION['type'] = 'client';
            $_SESSION['logged_in'] = time();
            $_SESSION['locked']=0;
            
            //Redirect to our protected page, which we called home.php
            header('Location: client-home.php');
            exit;
            
        }
         else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect password combination!');
        }
    }
    
}
 
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="col-lg-12">
                            <div class="review-tab-pro-inner">
                <div class="text-center txt-primary" style="color: white;">
                    <h3>Login</h3>
                    <p>Client panel for lost and found documents. </p>
                </div>
                 </div>
             </div>
              <div class="col-md-12"></div>
                <div class="hpanel">
                     
                        <!-- Single pro tab start-->
        <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <div class="text-center">
                                <ul id="myTab3" class="tab-review-design">
                                    <li class="active"><a href="#description"><i class="fa fa-lock" aria-hidden="true"></i>Please login</a></li>
                                    
                                </ul></div>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <form method="POST" action="client-login.php" autocomplete="off">
                                     <div class="input-group mg-b-15 mg-t-15">
                                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                            <input type="text" name="username" required="" class="form-control" placeholder="Email or Phone">
                                                        </div>
                                                        <div class="input-group mg-b-15">
                                                            <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                            <input type="Password" name="password" required="" class="form-control" placeholder="Password">
                                                        </div>
                                                         
                                                        <div class="form-group review-pro-edt mg-b-0-pt">
                                                            <button type="submit" name="login" class="btn btn-ctl-bt btn-block waves-effect waves-light">Login
                                                                </button>
                                                        </div>
                                                <ul class="breadcome-menu" style="text-align: left;">
                                            <li><a href="client-reset.php">Forget password?</a></li>
                                                </ul>
                                           </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                     
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
        </div>
        <?php
        include 'footer.php';


        ?>