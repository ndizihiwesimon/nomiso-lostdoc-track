<?php
$locname='User settings';
$usertype='Admin';
include 'header.php';

 $actuserid = $_SESSION['user_id'];
  if (isset($_GET['dis_id'])) {
     # code...
    $disableid = $_GET['dis_id'];
    try {
    // sql to delete a record
    $sql = "UPDATE users SET ustatus = 0 WHERE userid = $disableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Disabled user','Admin',$actuserid)";
    //use exec() because no results are returned
    $pdo->exec($sql);
    $pdo->exec($actsql);
   // echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    die("ERROR: Could not disable. " . $e->getMessage());
    }
 }

   if (isset($_GET['en_id'])) {
     # code...
    $enableid = $_GET['en_id'];
    try {
    // sql to delete a record
    $sql = "UPDATE users SET ustatus = 1 WHERE userid = $enableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Enabled user','Admin',$actuserid)";
    //use exec() because no results are returned
    $pdo->exec($sql);
    $pdo->exec($actsql);
   // echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    die("ERROR: Could not enable. " . $e->getMessage());
    }
 }
  

$online=$_SESSION['user_id'];

 
     //Retrieve the field values from our registration form.
    $fname = '';
    $lname = '';
    $gender = '';
    $phone = '';
    $idno = '';
    $email = '';
    $address = '';
    $password = '';
    $dlocation = '';
    $action = 'register';
    $daction = 'dregister';
    $oaction = 'oregister';
    $button = $obutton = $dbutton = 'Save';

   // $editid=0;

 if (isset($_GET['super_id'])) {
     # code...
    $editid = $_GET['super_id'];
    $action = 'update';
    $button = 'Update';

    $hello = "SELECT * FROM users INNER JOIN sector ON sector.sectid=users.uaddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province WHERE  users.userid=$editid";

$hey=$pdo->query($hello);
if ($get=$hey->fetch(PDO::FETCH_ASSOC)) {
    # code...
    $fname = $get['ufname'];
    $lname = $get['ulname'];
    $gender = $get['ugender'];
    $phone = $get['uphone'];
    $idno = $get['uidno'];
    $email = $get['uemail'];
    $address = $get['uaddress'];
    $proid = $get['provid'];
    $proname = $get['provname'];
    $disid = $get['distid'];
    $disname = $get['distname'];
    $secid = $get['sectid'];
    $secname = $get['sectname'];
    $password = $get['upass'];


}
 }
 if (isset($_POST['register']) || isset($_POST['update'])) {
    //Retrieve the field values from our registration form.
    $fname = !empty($_POST['fname']) ? trim($_POST['fname']) : null;   
    $lname = !empty($_POST['lname']) ? trim($_POST['lname']) : null;
    $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
    $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
    $idno = !empty($_POST['idno']) ? trim($_POST['idno']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $address = !empty($_POST['sector']) ? trim($_POST['sector']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $editid = !empty($_POST['editid']) ? trim($_POST['editid']) : null;

    //Construct the SQL statement and prepare it.
    $sql = "SELECT *,COUNT(uphone) AS fn FROM users WHERE uphone = :phone";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided phone to our prepared statement.
    $stmt->bindValue(':phone', $phone);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided phone already exists - display error.
 
    if($row['fn'] > 0){
        if (isset($_POST['register'])) {
            # code...
            die('That Phone number already exists!');
        }
        elseif (isset($_POST['update']) && $row['userid'] !== $editid) {
            # code...
            die('There\'s another user with that phone number!');
        }
        else
        {

        }
        
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    if(isset($_POST['register'])){
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our client table.
    $sql = "INSERT INTO users (ufname,ulname,ugender,uphone,uidno,uemail,uaddress,upass,utype,reguser) VALUES (:fname,:lname,:gender,:phone,:idno,:email,:address,:password,'Super',:reguser)";
   }
   else
   {
    $sql = "UPDATE users SET ufname=:fname,ulname=:lname,ugender=:gender,uphone=:phone,uidno=:idno,uemail=:email,uaddress=:address,upass=:password WHERE userid=:editid";
   }
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
    if (isset($_POST['register'])) {
        # code...
     $stmt->bindValue(':reguser', $online);
    }
    else
    {
     $stmt->bindValue(':editid', $editid);
    }
    
    
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
       // redirect to google after 5 seconds
        //Super user == active
 if (isset($_POST['register'])) {
     # code...
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New Super Admin user','Admin',$actuserid)";
    $pdo->exec($actsql);
 }
 else
 {
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated Super Admin user','Admin',$actuserid)";
    $pdo->exec($actsql);    
 }
    }
    
}
 
    $dfname = '';
    $dlname = '';
    $dgender =  '';
    $dphone =  '';
    $didno =  '';
    $demail =  '';
    $dlocation = ''; 
    $dpassword = '';
    
 if (isset($_GET['district_id'])) {
     # code...
    $deditid = $_GET['district_id'];
    $daction = 'dupdate';
    $dbutton = 'Update';

    $hello = "SELECT * FROM users INNER JOIN sector ON sector.sectid=users.uaddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province WHERE  users.userid=$deditid";

$hey=$pdo->query($hello);
if ($get=$hey->fetch(PDO::FETCH_ASSOC)) {
    # code...
    $district = $get['udistrict'];
    $dfname = $get['ufname'];
    $dlname = $get['ulname'];
    $dgender = $get['ugender'];
    $dphone = $get['uphone'];
    $didno = $get['uidno'];
    $demail = $get['uemail'];
    $daddress = $get['uaddress'];
    $dproid = $get['provid'];
    $dproname = $get['provname'];
    $ddisid = $get['distid'];
    $ddisname = $get['distname'];
    $dsecid = $get['sectid'];
    $dsecname = $get['sectname'];
    $dlocation = $get['ulocation'];
    $dpassword = $get['upass'];


}
 }
if(isset($_POST['dregister']) || isset($_POST['dupdate'])){
    
    //Retrieve the field values from our registration form.
    $fname = !empty($_POST['dfname']) ? trim($_POST['dfname']) : null;   
    $lname = !empty($_POST['dlname']) ? trim($_POST['dlname']) : null;
    $gender = !empty($_POST['dgender']) ? trim($_POST['dgender']) : null;
    $phone = !empty($_POST['dphone']) ? trim($_POST['dphone']) : null;
    $idno = !empty($_POST['didno']) ? trim($_POST['didno']) : null;
    $email = !empty($_POST['demail']) ? trim($_POST['demail']) : null;
    $address = !empty($_POST['dsector']) ? trim($_POST['dsector']) : null;
    $password = !empty($_POST['dpassword']) ? trim($_POST['dpassword']) : null;
    $dlocation = !empty($_POST['dlocation']) ? trim($_POST['dlocation']) : null;
    $ddistrict = !empty($_POST['ddistrict']) ? trim($_POST['ddistrict']) : null;
    $deditid = !empty($_POST['deditid']) ? trim($_POST['deditid']) : null;

    //Construct the SQL statement and prepare it.
    $sql = "SELECT *,COUNT(udistrict) AS udist FROM users WHERE udistrict = :ddistrict";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided phone to our prepared statement.
    $stmt->bindValue(':ddistrict', $ddistrict);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided phone already exists - display error.
 
    if($row['udist'] > 0){
        if (isset($_POST['dregister'])) {
            # code...
            die('That district already exists!');
        }
        elseif (isset($_POST['dupdate']) && $row['userid'] !== $deditid) {
            # code...
            die('There\'s user with that district!');
        }
        else
        {

        }
        
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
if (isset($_POST['dregister'])) {
    # code...
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our client table.
    $sql = "INSERT INTO users (ufname,ulname,ugender,uphone,uidno,uemail,uaddress,upass,utype,ulocation,udistrict,reguser) VALUES (:dfname,:dlname,:dgender,:dphone,:didno,:demail,:daddress,:dpassword,'District',:dlocation,:ddistrict,:reguser)";
   
}
else
{
    $sql = "UPDATE users SET ufname=:dfname,ulname=:dlname,ugender=:dgender,uphone=:dphone,uidno=:didno,uemail=:demail,uaddress=:daddress,upass=:dpassword,ulocation=:dlocation,udistrict=:ddistrict WHERE userid=:deditid";    
}
    
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':dfname', $fname);
    $stmt->bindValue(':dlname', $lname);
    $stmt->bindValue(':dgender', $gender);
    $stmt->bindValue(':dphone', $phone); 
    $stmt->bindValue(':didno', $idno); 
    $stmt->bindValue(':demail', $email); 
    $stmt->bindValue(':daddress', $address);                     
    $stmt->bindValue(':dpassword', $passwordHash);
    $stmt->bindValue(':dlocation', $dlocation);
    $stmt->bindValue(':ddistrict', $ddistrict);
    if (isset($_POST['dregister'])) {
        # code...

    $stmt->bindValue(':reguser', $online);  
    }
    else
{
    $stmt->bindValue(':deditid', $deditid);
}

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
       // redirect to google after 5 seconds
        //District user == active
 if (isset($_POST['dregister'])) {
     # code...
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New District Admin user','Admin',$actuserid)";
    $pdo->exec($actsql);
 }
 else
 {
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated District Admin user','Admin',$actuserid)";
    $pdo->exec($actsql);    
 }
    }
    
} 
    $oname = '';
    $ophone = '';
    $oemail = '';
    $branch = '';
    $olocation = '';
    $opassword =  '';

if (isset($_GET['org_id'])) {
    # code...
    $oeditid = $_GET['org_id'];
    $oaction = 'oupdate';
    $obutton = 'Update';

    $hello = "SELECT * FROM users  WHERE  userid=$oeditid";

$hey=$pdo->query($hello);
if ($get=$hey->fetch(PDO::FETCH_ASSOC)) {
    # code...
    $oname = $get['ufname'];
    $ophone = $get['uphone'];
    $oemail = $get['uemail'];
    $branch = $get['ulname'];
    $olocation = $get['ulocation'];
    $opassword = $get['upass'];
 

}
}
if(isset($_POST['oregister']) || isset($_POST['oupdate'])){
    
    //Retrieve the field values from our registration form.
    $name = !empty($_POST['oname']) ? trim($_POST['oname']) : null;   
    $phone = !empty($_POST['ophone']) ? trim($_POST['ophone']) : null;
    $email = !empty($_POST['oemail']) ? trim($_POST['oemail']) : null;
    $location = !empty($_POST['olocation']) ? trim($_POST['olocation']) : null;
    $password = !empty($_POST['opassword']) ? trim($_POST['opassword']) : null;
    $branch = !empty($_POST['branch']) ? trim($_POST['branch']) : null;
    $oeditid = !empty($_POST['oeditid']) ? trim($_POST['oeditid']) : null;
    $hq=1;


    //Construct the SQL statement and prepare it.
    $sql = "SELECT *,COUNT(uphone) AS fn FROM users WHERE uphone = :phone AND utype='Organization'";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided phone to our prepared statement.
    $stmt->bindValue(':phone', $phone);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided phone already exists - display error.
 
    if($row['fn'] > 0){
        if (isset($_POST['oregister'])) {
            # code...
        die('That Company phone number already exists!');

        }
        elseif (isset($_POST['oupdate']) && $row['userid'] !== $oeditid) {
            # code...
            die('There\'s company with that phone number!');
        }
        else
        {

        }
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    if (isset($_POST['oregister'])) {
        # code...

    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our client table.
    $sql = "INSERT INTO users (ufname,ulname,ugender,uphone,uemail,ulocation,upass,utype,reguser) VALUES (:oname,:branch,:hq,:ophone,:oemail,:olocation,:opassword,'Organization',:reguser)";
      
    }
    else
    {
        $sql = "UPDATE users SET ufname=:oname,ulname=:branch,uphone=:ophone,uemail=:oemail,ulocation=:olocation,upass=:opassword WHERE userid=:oeditid";
    }
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':oname', $name);
    $stmt->bindValue(':branch', $branch);
    $stmt->bindValue(':ophone', $phone); 
    $stmt->bindValue(':oemail', $email); 
    $stmt->bindValue(':olocation', $location);                     
    $stmt->bindValue(':opassword', $passwordHash);
    if (isset($_POST['oregister'])) {
        # code...
     $stmt->bindValue(':hq', $hq);   
     $stmt->bindValue(':reguser', $online);   
    }
    else
    {
        $stmt->bindValue(':oeditid', $oeditid);
    }
    
    
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
       // redirect to google after 5 seconds
        //Super user == active
if (isset($_POST['oregister'])) {
    # code...
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New Organization Admin user','Admin',$actuserid)";
    $pdo->exec($actsql);
}
else
{
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated Organization Admin user','Admin',$actuserid)";
    $pdo->exec($actsql);    
    }
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
                        <li class="active"><a href="#description"><i class="icon nalika-user" aria-hidden="true"></i>Super admin</a></li>
                        <li><a href="#district"><i class="icon nalika-refresh-button" aria-hidden="true"></i> District user</a></li>
                        <li><a href="#organization"><i class="icon nalika-team" aria-hidden="true"></i>Organization/company</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="users.php">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="fname" value="<?php  echo $fname;  ?>" class="form-control" placeholder="Firstname" required>
                                                    </div>
                                                   
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="lname" value="<?php  echo $lname;  ?>" class="form-control" placeholder="Lastname" required>
                                                    </div>
                                                    <div class="mg-b-pro-edt">
                                                     <select  name="gender" class="form-control pro-edt-select form-control-primary" required>
                                                        <?php  
                                                        if (isset($_GET['super_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $gender;  ?>"><?php  echo $gender;  ?></option>
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
                                                        <input type="text" name="phone" value="<?php  echo $phone;  ?>" name="phone" id="mobile" class="form-control" placeholder="Phone number" required>
                                                    </div>
                                                   <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input type="email" name="email" value="<?php  echo $email;  ?>" class="form-control" placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                      
                                                    

                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                                        <input type="text" name="idno" value="<?php  echo $idno;  ?>" class="form-control" placeholder="ID number" required>
                                                    </div>
  

                                                    
                                                      <div class="mg-b-pro-edt">
                                                     <select name="province" id="provinceID" class="form-control pro-edt-select form-control-primary" onchange="selectDynamics()" onfocus="selectDynamics()" required>
                                                           <?php  
                                                        if (isset($_GET['super_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $proid;  ?>"><?php  echo $proname;  ?></option>
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
                                                     <select  class="form-control pro-edt-select form-control-primary" id="districtID" onchange="selectDynamics()" required>
                                                           <?php  
                                                        if (isset($_GET['super_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $disid;  ?>"><?php  echo $disname;  ?></option>
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
                                                     <select class="form-control pro-edt-select form-control-primary" id="sectorID" name="sector" required>
                                                           <?php  
                                                        if (isset($_GET['super_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $secid;  ?>"><?php  echo $secname;  ?></option>
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
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="password" value="<?php  echo $password;  ?>" class="form-control" placeholder="Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="hidden" name="editid" value="<?php echo $editid;  ?>">
                                                    <button type="submit" name="<?php  echo $action;  ?>" class="btn btn-ctl-bt waves-effect waves-light m-r-10"><?php  echo $button;  ?>
                                                        </button>
                                                    <button type="reset" class="btn btn-ctl-bt waves-effect waves-light">Discard
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="district">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="users.php">
                                                          <div class="mg-b-pro-edt">
                                                     <select name="ddistrict"  class="form-control pro-edt-select form-control-primary" required>
                                                        <?php
                                                        if (isset($_GET['district_id'])) {
                                                            # code...

$lis = "SELECT * FROM district WHERE distid=$district";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    ?>
                                         <option value="<?php echo $district;  ?>"><?php echo $roww['distname'];  ?></option>
                                         <?php
}

                                                        }
                                                        else
                                                        {
                                                            ?>
                                                          <option value="">District</option>  
                                                            <?php
                                                        }
                                          ?>
                                                      
        <?php
  // Attempt select query execution
try{
    $sql = "SELECT * FROM district order by distname";   
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
while($row = $result->fetch()){
?>                                                        
                                                            
                                                            <option value="<?php echo $row['distid'];  ?>"><?php echo $row['distname'];  ?></option>
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
                                                        <input type="text" name="dfname" value="<?php  echo $dfname;  ?>" class="form-control" placeholder="Firstname" required>
                                                    </div>
                                                   
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="dlname" value="<?php  echo $dlname;  ?>" class="form-control" placeholder="Lastname" required>
                                                    </div>
                                                    <div class="mg-b-pro-edt">
                                                     <select  name="dgender" class="form-control pro-edt-select form-control-primary" required>
                                                             <?php  
                                                        if (isset($_GET['district_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $dgender;  ?>"><?php  echo $dgender;  ?></option>
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
                                                        <input type="text" name="dphone" value="<?php  echo $dphone;  ?>" name="phone" id="mobile" class="form-control" placeholder="Phone number" required>
                                                    </div>
                                                   <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input type="email" name="demail" value="<?php  echo $demail;  ?>" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                      
                                                    

                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                                        <input type="text" name="didno" value="<?php  echo $didno;  ?>" class="form-control" placeholder="ID number" required>
                                                    </div>
  

                                                    
                                                      <div class="mg-b-pro-edt">
                                                     <select name="province" id="provID" class="form-control pro-edt-select form-control-primary" onchange="dynamics()" onfocus="dynamics()" required>
                                                          <?php  
                                                        if (isset($_GET['district_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $dproid;  ?>"><?php  echo $dproname;  ?></option>
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
                                                     <select  class="form-control pro-edt-select form-control-primary" id="distID" onchange="dynamics()" required>
                                                                <?php  
                                                        if (isset($_GET['district_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $ddisid;  ?>"><?php  echo $ddisname;  ?></option>
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
                                                     <select class="form-control pro-edt-select form-control-primary" id="sectID" name="dsector" required>
                                                                  <?php  
                                                        if (isset($_GET['district_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php  echo $dsecid;  ?>"><?php  echo $dsecname;  ?></option>
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
                                                 <input type="text" name="dlocation" value="<?php  echo $dlocation;  ?>" class="form-control" placeholder="Location address" required>
                                                    </div>                                                    
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="dpassword" value="<?php  echo $dpassword;  ?>" class="form-control" placeholder="Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="hidden" name="deditid" value="<?php  echo $deditid;  ?>">
                                                    <button type="submit" name="<?php echo $daction;  ?>" class="btn btn-ctl-bt waves-effect waves-light m-r-10"><?php echo $dbutton;  ?>
                                                        </button>
                                                    <button type="reset" class="btn btn-ctl-bt waves-effect waves-light">Discard
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="organization">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="users.php">
                                               
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="oname" value="<?php  echo $oname;  ?>" class="form-control" placeholder="Name" required>
                                                    </div>
                                                   
                                                    
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                        <input type="text" name="ophone" value="<?php  echo $ophone;  ?>" class="form-control" placeholder="Phone number" required>
                                                    </div>
                                                   <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input type="email" name="oemail" value="<?php  echo $oemail;  ?>" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                      
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-sitemap" aria-hidden="true"></i></span>
                                                        <input type="text" name="branch" value="<?php  echo $branch;  ?>" class="form-control" placeholder="Branch" required>
                                                    </div>    
                                                    <div class="input-group mg-b-pro-edt">
                                                 <span class="input-group-addon"><i class="icon nalika-placeholder" aria-hidden="true"></i></span>
                                                 <input type="text" name="olocation" value="<?php  echo $olocation;  ?>" class="form-control" placeholder="Location address" required>
                                                    </div>                                                       
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="opassword" value="<?php  echo $opassword;  ?>" class="form-control" placeholder="Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="hidden" name="oeditid" value="<?php  echo $oeditid;  ?>">
                                                    <button type="submit" name="<?php echo $oaction;  ?>" class="btn btn-ctl-bt waves-effect waves-light m-r-10"><?php echo $obutton;  ?>
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
         <!-- Single pro tab start-->
        <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <ul id="myTab3" class="tab-review-design">
                        <li class="active"><a href="#desclist"><i class="icon nalika-user" aria-hidden="true"></i>Super admin</a></li>
                        <li><a href="#dislist"><i class="icon nalika-refresh-button" aria-hidden="true"></i> District users</a></li>
                        <li><a href="#orglist"><i class="icon nalika-team" aria-hidden="true"></i>Organization/company</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="desclist">
                                       <!-- Single pro lost/found list start-->
 <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Admin List</h4>
                             
                            <table>
                                <tr>
                                    <th>Photo</sub></th>
                                    <th>Names</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>ID Number</th>
                                    <th>Address</th>
                                    <th>Registered on</th>
                                    <th>Setting</th>
                                </tr>
                                
 <?php
$loca = "SELECT * FROM users INNER JOIN sector ON sector.sectid=users.uaddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province WHERE users.utype='Super' order by users.uregdate DESC";
$get=$pdo->query($loca);
while ($fetch=$get->fetch(PDO::FETCH_ASSOC)) {
    # code...


                                    ?>
                                    <tr>
                                        <td>
                                           <?php
                                        if (isset($fetch['uphoto']) AND $fetch['uphoto'] !== '') {
                                            # code...
                                            ?>
                                            <img src="<?php echo $fetch['uphoto']; ?>" width="100" height="100" alt=""/></td>
                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img src="avatar/none.jpg" width="100" height="100" alt=""/></td>
                                        <?php
                                        }
                                        ?>    
                                        </td>
                                    <td><?php echo $fetch['ufname']." ".$fetch['ulname'];  ?></td>
                                    <td><?php echo $fetch['ugender'];   ?></td>
                                    <td><?php echo $fetch['uphone'];   ?></td>
                                    <td><?php echo $fetch['uemail'];   ?></td>
                                    <td><?php echo $fetch['uidno'];   ?></td>
                                    <td><?php echo $fetch['distname']." - ".$fetch['sectname'];   ?></td>
                                      <td><?php
                                     $thatd=strtotime($fetch['uregdate']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatd)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatd)."</i>"; 
                                     }
                                      
                                     ?><br> By 
                                     <?php
$user=$fetch['reguser'];
$lis = "SELECT * FROM users WHERE userid=$user";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user) {
        # code...
        echo "<i>You</i>";
    }
    else
    {
        echo $roww['ufname'];
    }
                                         
                                         
}
?>
                                 </td>

                                    <td>
                                        <button data-toggle="tooltip" onclick="location.href='users.php?super_id=<?php echo $fetch['userid'];  ?>'" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                          <?php
                                        if ($fetch['ustatus'] === '1') {
                                            # code...
                                            if ($fetch['userid'] === $_SESSION['user_id']) {
                                            # code...
                                            ?>
                                            <button  data-toggle="tooltip" title="Online" class="pd-setting-ed"><i class="fa fa-circle" aria-hidden="true"></i></button>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button onclick="disableCl(<?php echo $fetch['userid']; ?>);" data-toggle="tooltip" title="Disable" class="pd-setting-ed"><i class="fa fa-lock" aria-hidden="true"></i></button>

                                            <?php
                                        }
                                        }
                                        else
                                        {
                                            ?>
                                            <button onclick="enableCl(<?php echo $fetch['userid']; ?>);" data-toggle="tooltip" title="Enable" class="pd-setting-ed"><i class="fa fa-unlock" aria-hidden="true"></i></button>
                                            <?php
                                        }

                                        ?>
                                    </td>
                                </tr>
                                 <?php
 }
                                 ?>
                            </table>
                            <div class="custom-pagination">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>           
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="dislist">
                                           <!-- Single pro lost/found list start-->
 <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>District users list</h4>
                             
                            <table>
                                <tr>
                                    <th>Photo</th>
                                    <th>District</sub></th>
                                    <th>Names</th>
                                    <th>Gender</th>
                                    <th>ID Number</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Location</th>
                                    <th>Registered on</th>
                                    <th>Setting</th>
                                </tr>
                                
 <?php
$locaa = "SELECT * FROM users INNER JOIN sector ON sector.sectid=users.uaddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province WHERE users.utype='District' order by users.uregdate";
$gett=$pdo->query($locaa);
while ($fetchh=$gett->fetch(PDO::FETCH_ASSOC)) {
    # code...


                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                        if (isset($fetchh['uphoto']) AND $fetchh['uphoto'] !== '') {
                                            # code...
                                            ?>
                                            <img src="<?php echo $fetchh['uphoto']; ?>" width="100" height="100" alt=""/></td>
                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img src="avatar/none.jpg" width="100" height="100" alt=""/></td>
                                        <?php
                                        }
                                        ?> 
                                        </td>
                                        <td><?php
$dist=$fetchh['udistrict'];
$lis = "SELECT * FROM district WHERE distid=$dist";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
                                         echo $roww['distname'];
}

                                          ?></td>
                                    <td><?php echo $fetchh['ufname']." ".$fetchh['ulname'];  ?></td>
                                    <td><?php echo $fetchh['ugender'];   ?></td>
                                    <td><?php echo $fetchh['uidno'];   ?></td>
                                    <td><?php echo $fetchh['distname']." - ".$fetchh['sectname'];   ?></td>
                                    <td><?php echo $fetchh['uphone'];   ?></td>
                                    <td><?php echo $fetchh['uemail'];   ?></td>
                                    <td><?php echo $fetchh['ulocation'];   ?></td>
                                      <td><?php
                                     $thatd=strtotime($fetchh['uregdate']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatd)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatd)."</i>"; 
                                     }
                                      
                                     ?><br> By 
                                     <?php
$user=$fetchh['reguser'];
$lis = "SELECT * FROM users WHERE userid=$user";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user) {
        # code...
        echo "<i>You</i>";
    }
    else
    {
        echo $roww['ufname'];
    }
                                         
                                         
}
?>
                                 </td>
                                    <td>
                                        <button data-toggle="tooltip" onclick="location.href='users.php?district_id=<?php echo $fetchh['userid'];  ?>'" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                          <?php
                                        if ($fetchh['ustatus'] === '1') {
                                            # code...
                                            ?>
                                            <button onclick="disableCl(<?php echo $fetchh['userid']; ?>);" data-toggle="tooltip" title="Disable" class="pd-setting-ed"><i class="fa fa-lock" aria-hidden="true"></i></button>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button onclick="enableCl(<?php echo $fetchh['userid']; ?>);" data-toggle="tooltip" title="Enable" class="pd-setting-ed"><i class="fa fa-unlock" aria-hidden="true"></i></button>
                                            <?php
                                        }

                                        ?>
                                    </td>
                                </tr>
                                 <?php
 }
                                 ?>
                            </table>
                            <div class="custom-pagination">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>           
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="orglist">
                                            <!-- Single pro lost/found list start-->
 <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Oraganization users</h4>
                             
                            <table>
                                <tr>
                                    <th>Photo</sub></th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <td>Branch</td>
                                    <th>Address</th>
                                    <th>Regisitered on</th>
                                    <th>Setting</th>
                                </tr>
                                
 <?php
$lo = "SELECT * FROM users WHERE utype='Organization' order by uregdate desc";
$ge=$pdo->query($lo);
while ($fet=$ge->fetch(PDO::FETCH_ASSOC)) {
    # code...


                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                        if (isset($fet['uphoto']) AND $fet['uphoto'] !== '') {
                                            # code...
                                            ?>
                                            <img src="<?php echo $fet['uphoto']; ?>" width="100" height="100" alt=""/></td>
                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img src="avatar/none.jpg" width="100" height="100" alt=""/></td>
                                        <?php
                                        }
                                        ?> 
                                        </td>
                                    <td><?php echo $fet['ufname'];  ?></td>
                                    <td><?php echo $fet['uphone'];   ?></td>
                                    <td><?php echo $fet['uemail'];   ?></td>
                                    <td><?php echo $fet['ulname']; 
                                    if ($fet['ugender'] == 1) {
                                        # code...
                                        echo " (HQ)";
                                    }
                                      ?></td>
                                    <td><?php echo $fet['ulocation'];   ?></td>
                                      <td><?php
                                     $thatd=strtotime($fet['uregdate']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatd)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatd)."</i>"; 
                                     }
                                      
                                     ?><br> By 
                                     <?php
$user=$fet['reguser'];
$lis = "SELECT * FROM users WHERE userid=$user";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user) {
        # code...
        echo "<i>You</i>";
    }
    else
    {
        echo $roww['ufname'];
    }
                                         
                                         
}
?>
                                 </td>
                                    <td>
                                        <button data-toggle="tooltip" onclick="location.href='users.php?org_id=<?php echo $fet['userid'];  ?>'" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                          <?php
                                        if ($fet['ustatus'] === '1') {
                                            # code...
                                            ?>
                                            <button onclick="disableCl(<?php echo $fet['userid']; ?>);" data-toggle="tooltip" title="Disable" class="pd-setting-ed"><i class="fa fa-lock" aria-hidden="true"></i></button>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button onclick="enableCl(<?php echo $fet['userid']; ?>);" data-toggle="tooltip" title="Enable" class="pd-setting-ed"><i class="fa fa-unlock" aria-hidden="true"></i></button>
                                            <?php
                                        }

                                        ?>
                                    </td>
                                </tr>
                                 <?php
 }
                                 ?>
                            </table>
                            <div class="custom-pagination">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
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
                    </div>
                </div>
            </div>
        </div>
        <!--Leaving space before Footer meeiin-->
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
 
function disableCl(Id){
    var iAnswer = confirm("Are you sure you want to disable this user?");
    if(iAnswer){
        window.location = 'users.php?dis_id=' + Id;
    }
  }
  function enableCl(Id){
    var iAnswer = confirm("Are you sure you want to enable this user?");
    if(iAnswer){
        window.location = 'users.php?en_id=' + Id;
    }
  }
</script>        
       <?php
    include 'footer.php';
       ?>
    