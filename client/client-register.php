<?php
$action = 'Register';
include 'client-header.php';
require 'connect.php';

if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
    $fname = !empty($_POST['fname']) ? trim($_POST['fname']) : null;   
    $lname = !empty($_POST['lname']) ? trim($_POST['lname']) : null;
    $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
    $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
    $idno = !empty($_POST['idno']) ? trim($_POST['idno']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $address = !empty($_POST['sector']) ? trim($_POST['sector']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(clphone) AS fn FROM client WHERE clphone = :phone";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided phone to our prepared statement.
    $stmt->bindValue(':phone', $phone);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided phone already exists - display error.
 
    if($row['fn'] > 0){
        die('That Phone number already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our client table.
    $sql = "INSERT INTO client (clfname,cllname,clgender,clphone,clidno,clemail,claddress,clpass) VALUES (:fname,:lname,:gender,:phone,:idno,:email,:address,:password)";
   
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':fname', $fname);
    $stmt->bindValue(':lname', $lname);
    $stmt->bindValue(':gender', $gender);
    $stmt->bindValue(':phone', $phone); 
    $stmt->bindValue(':idno', $idno); 
    $stmt->bindValue(':email', $email); 
    $stmt->bindValue(':address', $address);                     
    $stmt->bindValue(':password', $passwordHash);
    
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
       // redirect to google after 5 seconds
    $last_id = $pdo->lastInsertId();
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Created account','Client',$last_id)";
    $pdo->exec($actsql);  
 ?>
<script type="text/javascript">
   window.setTimeout(function() {
    window.location.href = 'client-login.php';
}, 2000); 
</script>

 
  <script type="text/javascript" src="gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="gritter-conf.js"></script>
          <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Nomiso!',
        // (string | mandatory) the text inside the notification
        text: 'You have successfully registered',
        // (string | optional) the image to display on the left
        image: 'img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>

  <?php
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
                    <h3>Registration</h3>
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
                                    <li class="active"><a href="#description"><i class="icon nalika-new-file" aria-hidden="true"></i>Register to Access</a></li>
                                    
                                </ul></div>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="client-register.php">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="fname" class="form-control" placeholder="Firstname" required="">
                                                    </div>
                                                   
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="lname" class="form-control" placeholder="Lastname">
                                                    </div>
                                                    <div class="mg-b-pro-edt">
                                                     <select  name="gender" class="form-control pro-edt-select form-control-primary" required="">
                                                            <option value="">Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Not Applicable">Not Applicable</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                        <input id="phone" type="text" name="phone" maxlength="10" minlength="10"  class="form-control" placeholder="Phone number" required="">
                                                    </div>
                                                   <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                      
                                                    

                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                                        <input id="ID" type="text" name="idno" maxlength="16" minlength="16"  class="form-control" placeholder="ID number" required="">
                                                    </div>
  

                                                    
                                                      <div class="mg-b-pro-edt">
                                                     <select name="province" id="provinceID" class="form-control pro-edt-select form-control-primary" onchange="selectDynamics()" onfocus="selectDynamics()" required="">
                                                      <option value="">Province</option>
        <?php
  // Attempt select query execution
try{
    $sql = "SELECT * FROM province";   
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
while($row = $result->fetch()){
?>                                                        
                                                            
                                                            <option value="<?php echo $row['provid'];  ?>"><?php echo $row['provname'];  ?></option>
                                                           <?php
                                                           }
       
        // Free result set
        unset($result);
    } else{
        ?>
        <option value=""><?php echo "No records were found.";  ?></option>
    <?php
}
}
 catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

?>                                               
                                                    </select>
                                                    </div>
                                    
                                                     <div class="mg-b-pro-edt">
                                                     <select  class="form-control pro-edt-select form-control-primary" id="districtID" onchange="selectDynamics()" required="">
                                                            <option value="">District</option>
                                                                                                                
                                                        </select>
                                                    </div>
                                                   
                                           <div class="mg-b-pro-edt">
                                                     <select class="form-control pro-edt-select form-control-primary" id="sectorID" name="sector" required="">
                                                            <option value="">Sector</option>
                                                                                                                
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <button type="submit" name="register" class="btn btn-ctl-bt waves-effect waves-light m-r-10" onClick="sendOTP();">Save
                                                        </button>
                                                    <button type="reset" class="btn btn-ctl-bt waves-effect waves-light">Discard
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
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
    </div>
        <script type="text/javascript">
function selectDynamics(){
            $(document).ready(function () {
$("#provinceID").change(function () {
    var province = $(this).val();
    var dataString = 'province=' + province;
    $.ajax
                ({
                    type: "POST",
                    url: "get-dis.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $("#districtID").html(html);
                    }
                })
})

$("#districtID").change(function () {
    var district = $(this).val();
    var dataString = 'district=' + district;
    $.ajax
    ({
        type: "POST",
        url: "get-sect.php",
        data: dataString,
        cache: false,
        success: function (html)
        {
            $("#sectorID").html(html);
        }
    })
})
})
        }
        </script>        
        <?php
        include 'footer.php';
        ?>