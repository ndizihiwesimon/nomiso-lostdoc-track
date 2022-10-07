<?php
$locname='Company user edit';
$usertype='Admin';
include 'header.php';

 $online=$_SESSION['user_id'];


    //first time data
    $obutton='Save';
    $oaction='oregister';
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
    
    //If the signup process is successful.
    if($result && isset($_POST['oregister'])){
 
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New Organization user record','Admin',$online)";
    $pdo->exec($actsql);
    }
    else
    {
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated Organization user record','Admin',$online)";
    $pdo->exec($actsql);      
 ?>
<script type="text/javascript">
   window.setTimeout(function() {
    window.location.href = 'org-view.php';
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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i>Add company user</a></li>
                                    
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                     <form method="POST" action="org-edit.php">
                                               
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="oname" value="<?php  echo $oname;  ?>" class="form-control" placeholder="Name">
                                                    </div>
                                                   
                                                    
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                        <input type="text" name="ophone" value="<?php  echo $ophone;  ?>"  class="form-control" placeholder="Phone number">
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
                                                        <input type="text" name="branch" value="<?php  echo $branch;  ?>" class="form-control" placeholder="Branch">
                                                    </div>    
                                                    <div class="input-group mg-b-pro-edt">
                                                 <span class="input-group-addon"><i class="icon nalika-placeholder" aria-hidden="true"></i></span>
                                                 <input type="text" name="olocation" value="<?php  echo $olocation;  ?>" class="form-control" placeholder="Location address">
                                                    </div>                                                       
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="opassword" value="<?php  echo $opassword;  ?>" class="form-control" placeholder="Password">
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
        <!--Leaving space before Footer meeiin-->
  
       <?php
    include 'footer.php';
       ?>
    