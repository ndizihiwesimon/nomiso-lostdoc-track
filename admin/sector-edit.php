<?php
$locname='Sector user edit';
$usertype='Admin';
include 'header.php';

    $online = $_SESSION['user_id'];
    $district = $_SESSION['userd'];

    //first time data
    $button='Save';
    $sfname = '';
    $slname = '';
    $sgender =  '';
    $sphone =  '';
    $sidno =  '';
    $semail =  '';
    $slocation = ''; 
    $spassword = '';
    $action='sregister';

if (isset($_GET['ssector_id'])) {
    # code...
    $seditid=$_GET['ssector_id'];
    $button='Update';
    $action='supdate';
    $hello = "SELECT * FROM users INNER JOIN sector ON sector.sectid=users.uaddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province WHERE  users.userid=$seditid";

$hey=$pdo->query($hello);
if ($get=$hey->fetch(PDO::FETCH_ASSOC)) {
    # code...
    $ssector = $get['usector'];
    $sfname = $get['ufname'];
    $slname = $get['ulname'];
    $sgender = $get['ugender'];
    $sphone = $get['uphone'];
    $sidno = $get['uidno'];
    $semail = $get['uemail'];
    $saddress = $get['uaddress'];
    $sproid = $get['provid'];
    $sproname = $get['provname'];
    $sdisid = $get['distid'];
    $sdisname = $get['distname'];
    $ssecid = $get['sectid'];
    $ssecname = $get['sectname'];
    $slocation = $get['ulocation'];
    $spassword = $get['upass'];


}
 }
if(isset($_POST['sregister']) || isset($_POST['supdate'])){
    
    //Retrieve the field values from our registration form.
    $fname = !empty($_POST['sfname']) ? trim($_POST['sfname']) : null;   
    $lname = !empty($_POST['slname']) ? trim($_POST['slname']) : null;
    $gender = !empty($_POST['sgender']) ? trim($_POST['sgender']) : null;
    $phone = !empty($_POST['sphone']) ? trim($_POST['sphone']) : null;
    $idno = !empty($_POST['sidno']) ? trim($_POST['sidno']) : null;
    $email = !empty($_POST['semail']) ? trim($_POST['semail']) : null;
    $address = !empty($_POST['sector']) ? trim($_POST['sector']) : null;
    $password = !empty($_POST['spassword']) ? trim($_POST['spassword']) : null;
    $slocation = !empty($_POST['slocation']) ? trim($_POST['slocation']) : null;
    $ssector = !empty($_POST['ssector']) ? trim($_POST['ssector']) : null;
    $seditid = !empty($_POST['seditid']) ? trim($_POST['seditid']) : null;


    //Construct the SQL statement and prepare it.
    $sql = "SELECT *,COUNT(usector) AS usect FROM users WHERE usector = :ssector";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided phone to our prepared statement.
    $stmt->bindValue(':ssector', $ssector);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided phone already exists - display error.
 
    if($row['usect'] > 0){
        if (isset($_POST['sregister'])) {
            # code...
            die('That sector already exists!');
        }
        elseif (isset($_POST['supdate']) && $row['userid'] !== $seditid) {
            # code...
            die('There\'s user with that sector!');
        }
        else
        {

        }
        
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
if (isset($_POST['sregister'])) {
    # code...
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO users (ufname,ulname,ugender,uphone,uidno,uemail,uaddress,upass,utype,ulocation,udistrict,usector,reguser) VALUES (:sfname,:slname,:sgender,:sphone,:sidno,:semail,:saddress,:spassword,'Sector',:slocation,:sdistrict,:ssector,:reguser)";
   
}
else
{
    $sql = "UPDATE users SET ufname=:sfname,ulname=:slname,ugender=:sgender,uphone=:sphone,uidno=:sidno,uemail=:semail,uaddress=:saddress,upass=:spassword,ulocation=:slocation,usector=:ssector WHERE userid=:seditid";    
}
    
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':sfname', $fname);
    $stmt->bindValue(':slname', $lname);
    $stmt->bindValue(':sgender', $gender);
    $stmt->bindValue(':sphone', $phone); 
    $stmt->bindValue(':sidno', $idno); 
    $stmt->bindValue(':semail', $email); 
    $stmt->bindValue(':saddress', $address);                     
    $stmt->bindValue(':spassword', $passwordHash);
    $stmt->bindValue(':slocation', $slocation);
    $stmt->bindValue(':ssector', $ssector);
    if (isset($_POST['sregister'])) {
        # code...

    $stmt->bindValue(':reguser', $online);  
    $stmt->bindValue(':sdistrict', $district);
    }
    else
{
    $stmt->bindValue(':seditid', $seditid);
}
   
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result && isset($_POST['sregister'])){
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New sector user record','Admin',$online)";
    $pdo->exec($actsql);
    }
    else
    {
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated sector user record','Admin',$online)";
    $pdo->exec($actsql);            
 ?>
<script type="text/javascript">
   window.setTimeout(function() {
    window.location.href = 'sector-view.php';
}, 2000); 
</script>


  <?php
    }
    
}
?>
 
   
        <!-- Mobile Menu start -->
            
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-wp">
											<div class="breadcomb-icon">
												<i class="icon nalika-home"></i>
											</div>
											<div class="breadcomb-ctn">
												<h2><?php echo $locname;  ?></h2>
												<p>Nomiso <span class="bread-ntd"><?php echo $usertype;  ?> Panel</span></p>
											</div>
										</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-report">
											<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="icon nalika-download"></i></button>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 <!-- Single pro tab start-->
        <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <ul id="myTab3" class="tab-review-design">
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i>Add sector user</a></li>
                                    
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="sector-edit.php">
                                                          <div class="mg-b-pro-edt">
                                                     <select name="ssector"  class="form-control pro-edt-select form-control-primary" >
                                                        <?php
                                                        if (isset($_GET['ssector_id'])) {
                                                            # code...

$lis = "SELECT * FROM sector WHERE sectid = $ssector";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    ?>
                                         <option value="<?php echo $ssector;  ?>"><?php echo $roww['sectname'];  ?></option>
                                         <?php
}

                                                        }
                                                        else
                                                        {
                                                            ?>
                                                          <option value="">Sector</option>  
                                                            <?php
                                                        }
                                          ?>
                                                      
        <?php
  // Attempt select query execution
try{
    $userd = $_SESSION['userd'];
    
    $sql = "SELECT * FROM sector WHERE district = $userd order by sectname";   
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
while($row = $result->fetch()){
?>                                                        
                                                            
                                                            <option value="<?php echo $row['sectid'];  ?>"><?php echo $row['sectname'];  ?></option>
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
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="sfname" value="<?php  echo $sfname;  ?>" class="form-control" placeholder="Firstname">
                                                    </div>
                                                   
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="slname" value="<?php  echo $slname;  ?>" class="form-control" placeholder="Lastname">
                                                    </div>
                                                    <div class="mg-b-pro-edt">
                                                     <select  name="sgender" class="form-control pro-edt-select form-control-primary">
                                                             <?php  
                                                        if (isset($_GET['ssector_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $sgender;  ?>"><?php  echo $sgender;  ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="">Gender</option>

                                                            <?php
                                                        }

                                                       ?>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Not Applicable">Not Applicable</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                        <input type="text" name="sphone" value="<?php  echo $sphone;  ?>" name="phone" id="mobile" class="form-control" placeholder="Phone number">
                                                    </div>
                                                   <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input type="email" name="semail" value="<?php  echo $semail;  ?>" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                      
                                                    

                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                                        <input type="text" name="sidno" value="<?php  echo $sidno;  ?>" class="form-control" placeholder="ID number ">
                                                    </div>
  

                                                    
                                                      <div class="mg-b-pro-edt">
                                                     <select name="province" id="provID" class="form-control pro-edt-select form-control-primary" onchange="dynamics()" onfocus="dynamics()">
                                                          <?php  
                                                        if (isset($_GET['ssector_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $sproid;  ?>"><?php  echo $sproname;  ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="">Province</option>

                                                            <?php
                                                        }

                                                       ?>
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
                                                     <select  class="form-control pro-edt-select form-control-primary" id="distID" onchange="dynamics()">
                                                                <?php  
                                                        if (isset($_GET['ssector_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $sdisid;  ?>"><?php  echo $sdisname;  ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                           <option value="">District</option>

                                                            <?php
                                                        }

                                                       ?>
                                                                                                                
                                                        </select>
                                                    </div>
                                                   
                                           <div class="mg-b-pro-edt">
                                                     <select class="form-control pro-edt-select form-control-primary" id="sectID" name="sector">
                                                                  <?php  
                                                        if (isset($_GET['ssector_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $ssecid;  ?>"><?php  echo $ssecname;  ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                           <option value="">Sector</option>

                                                            <?php
                                                        }

                                                       ?>
                                                          
                                                                                                                
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                 <span class="input-group-addon"><i class="icon nalika-placeholder" aria-hidden="true"></i></span>
                                                 <input type="text" name="slocation" value="<?php  echo $slocation;  ?>" class="form-control" placeholder="Location address">
                                                    </div>                                                    
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="spassword" value="<?php  echo $spassword;  ?>" class="form-control" placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="hidden" name="seditid" value="<?php  echo $seditid;  ?>">
                                                    <button type="submit" name="<?php echo $action;  ?>" class="btn btn-ctl-bt waves-effect waves-light m-r-10"><?php echo $button;  ?>
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
        <!--Leaving space before Footer meeiin-->
 <script type="text/javascript">
     
//Get data for district users
function dynamics(){
$(document).ready(function () {
$("#provID").change(function () {
    var province = $(this).val();
    var dataString = 'province=' + province;
    $.ajax
                ({
                    type: "POST",
                    url: "get-udis.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $("#distID").html(html);
                    }
                })
})

$("#distID").change(function () {
    var district = $(this).val();
    var dataString = 'district=' + district;
    $.ajax
    ({
        type: "POST",
        url: "get-usect.php",
        data: dataString,
        cache: false,
        success: function (html)
        {
            $("#sectID").html(html);
        }
    })
})
})
        } 
 </script>
       <?php
    include 'footer.php';
       ?>
    