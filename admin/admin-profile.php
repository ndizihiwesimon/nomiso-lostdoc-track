<?php
$locname='Profile View';
$usertype='Admin';
include 'header.php';
$mine=$_SESSION['user_id'];

//Image upload goes here
if(isset($_POST["update"]) || isset($_POST['oupdate']) AND !empty($_FILES["fileToUpload"]["name"])) {
$photoUpload = '';
$target_dir = "avatar/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    die('Sorry, file already exists.');
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $photoUpload = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
else
{
  $photoUpload = !empty($_POST['curphoto']) ? trim($_POST['curphoto']) : null;
}

 if (isset($_POST['update'])) {
 	# code...
    //Retrieve the field values from our registration form.
    $fname = !empty($_POST['fname']) ? trim($_POST['fname']) : null;   
    $lname = !empty($_POST['lname']) ? trim($_POST['lname']) : null;
    $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
    $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
    $idno = !empty($_POST['idno']) ? trim($_POST['idno']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $address = !empty($_POST['sector']) ? trim($_POST['sector']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $cpassword = !empty($_POST['cpassword']) ? trim($_POST['cpassword']) : null;
    
    $cpass=$_POST['cpass'];
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
 
    if($row['fn'] > 0 && $row['userid'] !== $mine){
        
      die('There\'s user with that phone number!');
      
    }
    if(isset($cpassword) && password_verify($cpassword, $cpass) === false){
        die('Ooops, Current Password doesn\'t match!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.

    $sql="UPDATE users SET ufname=:fname,ulname=:lname,ugender=:gender,uphone=:phone,uidno=:idno,uemail=:email,uaddress=:address,upass=:password,uphoto=:photo WHERE userid=:mine";
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
    $stmt->bindValue(':mine', $mine);
    $stmt->bindValue(':photo', $photoUpload);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated profile','Admin',$mine)";
    $pdo->exec($actsql);      
        //What you do here is up to you!
       // redirect to google after 5 seconds
 ?>
 <script type="text/javascript">
   window.setTimeout(function() {
    window.location.href = 'admin-profile.php';
}, 1000); 
</script>

  <?php
    }
    
 }

 if (isset($_POST['oupdate'])) {
  # code...

    //Retrieve the field values from our registration form.
    $name = !empty($_POST['oname']) ? trim($_POST['oname']) : null;   
    $phone = !empty($_POST['ophone']) ? trim($_POST['ophone']) : null;
    $email = !empty($_POST['oemail']) ? trim($_POST['oemail']) : null;
    $location = !empty($_POST['olocation']) ? trim($_POST['olocation']) : null;
    $branch = !empty($_POST['branch']) ? trim($_POST['branch']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $cpassword = !empty($_POST['cpassword']) ? trim($_POST['cpassword']) : null;
    
    $cpass=$_POST['cpass'];
  
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
 
    if($row['fn'] > 0 && $row['userid'] !== $mine){
        
      die('There\'s company with that phone number!');
      
    }

    if(isset($cpassword) && password_verify($cpassword, $cpass) === false){
        die('Ooops, Current Password doesn\'t match!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "UPDATE users SET ufname=:oname,ulname=:branch,uphone=:ophone,uemail=:oemail,ulocation=:olocation,upass=:password,uphoto=:photo WHERE userid=:mine";
     
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':oname', $name);
    $stmt->bindValue(':branch', $branch);
    $stmt->bindValue(':ophone', $phone); 
    $stmt->bindValue(':oemail', $email); 
    $stmt->bindValue(':olocation', $location);                     
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':mine', $mine);
    $stmt->bindValue(':photo', $photoUpload);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
       // redirect to google after 5 seconds
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated profile','Admin',$mine)";
    $pdo->exec($actsql);        
 ?>
<script type="text/javascript">
   window.setTimeout(function() {
    window.location.href = 'admin-profile.php';
}, 1000); 
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
        <div class="single-product-tab-area mg-t-0 mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<div class="single-product-pr">
							<div class="row">
								 
<?php
if (isset($_SESSION['utype']) && $_SESSION['utype'] === 'Organization') {
  # code...
  $loca = "SELECT * FROM users WHERE utype = 'Organization' AND userid=$mine";
  $get=$pdo->query($loca);
if ($fetch=$get->fetch(PDO::FETCH_ASSOC)) {
  # code...
?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="single-product-details res-pro-tb">
                    <h1>Personal profile</h1>
                    <span class="single-pro-star">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                   
        <div class="single-pro-price">
  
                              <?php 
//display user avatar
$mid = $mine;
$lisa = "SELECT uphoto FROM users WHERE userid=$mid";
$resa = $pdo->query($lisa);
if ($rowa=$resa->fetch()) {
    if ($rowa['uphoto'] !== '') {
        # code...
        ?>
     <a href="#"><img width="100" height="100" src="<?php echo $rowa['uphoto']; ?>" alt="" /></a>
     <?php 
    }
    else
    {
        ?>
 <a href="#"><img width="100" height="100" src="avatar/none.jpg" alt="" /></a>
        <?php
    }
    
} 
                    ?>
        </div>
       
                    <div class="single-pro-price">
                     <span class="single-regular" style="font-size: 15px;">Name:</span>
                     <span class="single-old"><?php echo $fetch['ufname'];   ?></span>
                     <br>
                     <span class="single-regular" style="font-size: 15px;">Branch:</span>
                     <span class="single-old"><?php echo $fetch['ulname'];  
                     if ($_SESSION['HQ'] === '1') {
                            # code...
                         echo " HQ";
                     }
                     else
                     {
                        echo " Branch";
                     }

                      ?></span>
                     <br>
                     
                      <span class="single-regular"  style="font-size: 15px;">Address:</span>
                      <span class="single-old">
                        <?php echo $fetch['ulocation'];?> 
                       </span>

                    </div>
                    <div class="color-quality-pro">
                      <div class="color-quality-details">
                        <h5>Phone</h5>
                        <span class="single-old" style="margin-left: 0px;"><?php echo "+25".$fetch['uphone'];  ?></span>
                      </div>
                      <div class="color-quality">
                        <h4>Email</h4>
                        <div class="quantity">
                          <span class="single-old" style="margin-left: 0px;"><?php echo $fetch['uemail'];  ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="clear"></div>
                      <div class="single-pro-price">
                     <span class="single-regular" style="font-size: 15px;">Registered on:</span>
                     <span class="single-old"><?php 
                     $thatt=strtotime($fetch['uregdate']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatt)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatt)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatt)."</i>"; 
                                     }
                                      

                        

                        ?></span>
                        </div>

                      <div class="clear"></div>
                      <div class="single-pro-button">
                        <div class="pro-button">
                          <a href="admin-profile.php?access=granted" name="get_form" >UPDATE</a>
                        </div>
                        <div class="pro-viwer">
                          <a href="#"><i class="fa fa-envelope"></i></a>
                          
                        </div>
                      </div>
                       
                    </div>
                   <?php
         }
      
     else
     {
      echo '<p style="color:white;"> Something went wrong, If problem persist contact admin</p>';
     }
                   ?>
                  </div>
<?php
if (isset($_REQUEST['access']) AND $_REQUEST['access']=='granted') {
  # code...

?>
                  <div class="single-product-details res-pro-tb">
                    <h1>Update your profile</h1>
                    <span class="single-pro-star">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </span>
                     <br><br>
                               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" enctype="multipart/form-data" action="admin-profile.php">
                                                   
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="oname" value="<?php echo $fetch['ufname']; ?>" class="form-control" required>
                                                    </div>
                                                   
                                                    
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                        <input type="text" name="ophone" value="<?php echo $fetch['uphone']; ?>" id="mobile" class="form-control" required>
                                                    </div>
                                                   <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input type="email" name="oemail" value="<?php echo $fetch['uemail']; ?>" class="form-control" required>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-picture" aria-hidden="true"></i></span>
                                                        <input type="file" name="fileToUpload" class="form-control">
                                                        <input type="hidden" name="curphoto" value="<?php echo $fetch['uphoto']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                      
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-sitemap" aria-hidden="true"></i></span>
                                                        <input type="text" name="branch" value="<?php echo $fetch['ulname']; ?>" class="form-control">
                                                    </div>    
                                                    <div class="input-group mg-b-pro-edt">
                                                 <span class="input-group-addon"><i class="icon nalika-placeholder" aria-hidden="true"></i></span>
                                                 <input type="text" name="olocation" value="<?php echo $fetch['ulocation']; ?>" class="form-control">
                                                    </div>                                                       
                                                     <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="cpassword" class="form-control" placeholder="Current Password">
                                                        <input type="hidden" name="cpass" value="<?php echo $fetch['upass']; ?>">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="password" class="form-control" placeholder="New Password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <button type="submit" name="oupdate" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Update
                                                        </button>
                                                    <button type="reset" class="btn btn-ctl-bt waves-effect waves-light">Discard
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                <?php
}
                
}
else
{


$loca = "SELECT * FROM users INNER JOIN sector ON sector.sectid=users.uaddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province WHERE  users.userid=$mine";
$get=$pdo->query($loca);
if ($fetch=$get->fetch(PDO::FETCH_ASSOC)) {
	# code...
?>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="single-product-details res-pro-tb">
										<h1>Personal profile</h1>
										<span class="single-pro-star">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
									 
				<div class="single-pro-price">
					                              <?php 
//display user avatar
$mid = $mine;
$lisa = "SELECT uphoto FROM users WHERE userid=$mid";
$resa = $pdo->query($lisa);
if ($rowa=$resa->fetch()) {
    if ($rowa['uphoto'] !== '') {
        # code...
        ?>
     <a href="#"><img width="100" height="100" src="<?php echo $rowa['uphoto'];  ?>"  alt="" /></a>
     <?php 
    }
    else
    {
        ?>
 <a href="#"><img width="100" height="100" src="avatar/none.jpg" alt="" /></a>
        <?php
    }
    
} 
                    ?>
				</div>
			 
										<div class="single-pro-price">
									 	 <span class="single-regular" style="font-size: 15px;">Names:</span>
									 	 <span class="single-old"><?php echo $fetch['ufname']." ".$fetch['ulname'];   ?></span>
									 	 <br>
									 	 <span class="single-regular" style="font-size: 15px;">Gender:</span>
									 	 <span class="single-old"><?php echo $fetch['ugender'];   ?></span>
									 	 <br>
									 	 <span class="single-regular" style="font-size: 15px;">ID Number:</span>
									 	 <span class="single-old"><?php echo $fetch['uidno'];   ?></span>
									 	 <br>
									 	 
											<span class="single-regular"  style="font-size: 15px;">Address:</span>
											<span class="single-old">
												<?php echo $fetch['distname']." - ".$fetch['sectname'];?> 
											 </span>

										</div>
										<div class="color-quality-pro">
											<div class="color-quality-details">
												<h5>Phone</h5>
												<span class="single-old" style="margin-left: 0px;"><?php echo "+25".$fetch['uphone'];  ?></span>
											</div>
											<div class="color-quality">
												<h4>Email</h4>
												<div class="quantity">
													<span class="single-old" style="margin-left: 0px;"><?php echo $fetch['uemail'];  ?></span>
													</div>
												</div>
											</div>
											<div class="clear"></div>
											<div class="single-pro-price">
									 	 <span class="single-regular" style="font-size: 15px;">Registered on:</span>
									 	 <span class="single-old"><?php 
									 	 $thatt=strtotime($fetch['uregdate']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatt)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatt)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatt)."</i>"; 
                                     }
                                      

												

									 	    ?></span>
									 	    </div>

											<div class="clear"></div>
											<div class="single-pro-button">
												<div class="pro-button">
												  <a href="admin-profile.php?access=granted" name="get_form" >UPDATE</a>
												</div>
												<div class="pro-viwer">
													<a href="#"><i class="fa fa-envelope"></i></a>
													
												</div>
											</div>
											 
										</div>
									 <?php
         }
      
     else
     {
     	echo '<p style="color:white;"> Something went wrong, If problem persist contact admin</p>';
     }
									 ?>
									</div>
<?php
if (isset($_REQUEST['access']) AND $_REQUEST['access']=='granted') {
	# code...

?>
									<div class="single-product-details res-pro-tb">
										<h1>Update your profile</h1>
										<span class="single-pro-star">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
										 <br><br>
                               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" enctype="multipart/form-data" action="admin-profile.php">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="fname" class="form-control" value="<?php echo $fetch['ufname']; ?>">
                                                    </div>
                                                   
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="lname" class="form-control" value="<?php echo $fetch['ulname']; ?>">
                                                    </div>
                                                    <div class="mg-b-pro-edt">
                                                     <select  name="gender" class="form-control pro-edt-select form-control-primary">
                                                            <option value="<?php echo $fetch['ugender']; ?>"><?php echo $fetch['ugender']; ?></option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Not Applicable">Not Applicable</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                        <input type="text" name="phone" name="phone" id="mobile" class="form-control" value="<?php echo $fetch['uphone']; ?>">
                                                    </div>
                                                   <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input type="email" name="email" class="form-control" value="<?php echo $fetch['uemail']; ?>">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-picture" aria-hidden="true"></i></span>
                                                        <input type="file" name="fileToUpload" class="form-control">
                                                        <input type="hidden" name="curphoto" value="<?php echo $fetch['uphoto']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                      
                                                    

                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                                        <input type="text" name="idno" class="form-control" value="<?php echo $fetch['uidno']; ?>">
                                                    </div>
  

                                                    
                                                      <div class="mg-b-pro-edt">
                                                     <select name="province" id="provinceID" class="form-control pro-edt-select form-control-primary" onchange="selectDynamics()" onfocus="selectDynamics()">
                                                      <option value="<?php echo $fetch['provid']; ?>"><?php echo $fetch['provname']; ?></option>
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
                                                     <select  class="form-control pro-edt-select form-control-primary" name="district" id="districtID" onchange="selectDynamics()">
                                                            <option value="<?php echo $fetch['distid']; ?>"><?php echo $fetch['distname']; ?></option>
                                                                                                                
                                                        </select>
                                                    </div>
                                                   
                                           <div class="mg-b-pro-edt">
                                                     <select class="form-control pro-edt-select form-control-primary" id="sectorID" name="sector">
                                                            <option value="<?php echo $fetch['sectid']; ?>"><?php echo $fetch['sectname']; ?></option>
                                                                                                                
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="cpassword" class="form-control" placeholder="Current Password">
                                                        <input type="hidden" name="cpass" value="<?php echo $fetch['upass']; ?>">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                                        <input type="password" name="password" class="form-control" placeholder="New Password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <button type="submit" name="update" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Update
                                                        </button>
                                                    <button type="reset" class="btn btn-ctl-bt waves-effect waves-light">Discard
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
								<?php
}
}
								?>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
        <!-- Single pro tab End-->
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
        </script>
       <?php
    include 'footer.php';
       ?>
    