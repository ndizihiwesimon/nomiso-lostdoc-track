<?php
$locname='Document View';
$usertype='Admin';
include 'header.php';
 
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
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="single-product-details res-pro-tb">
									<h1>Document details</h1>
										<span class="single-pro-star">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
<?php
$id=$_REQUEST['docid'];										
$list = "SELECT * FROM  document JOIN documenttype ON documenttype.dtypeid=document.doctype WHERE document.docid=$id";

$result = $pdo->query($list);
if ($result->rowCount()>0) {
    # code...

while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
    # code...
	?>		
										<div class="single-pro-price">
											<span class="single-regular"  style="font-size: 16px;">Owner names:</span><span class="single-old"><?php echo $row['docowner'];   ?></span>
											<br>
											<span class="single-regular"  style="font-size: 16px;">Type:</span><span class="single-old"><?php echo $row['dtypename'];  ?></span>
											<br>
											<span class="single-regular"  style="font-size: 16px;">Doc. Number:</span><span class="single-old"><?php echo $row['docno'];  ?></span>
											<br>
											<span class="single-regular"  style="font-size: 16px;">Doc. Place:</span><span class="single-old"><?php echo $row['docplace'];  ?></span>
										</div>
										 
										<div class="color-quality-pro">
											<div class="color-quality-details">
												<h5>Posted on</h5>
											<span class="single-old" style="margin-left: 0px; white-space: nowrap;"><?php 
											$thatd=strtotime($row['docregdate']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatd)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatd)."</i>"; 
                                     }
                                      

											   ?></span>
																								
											</div>
											<div class="color-quality">
												<h4>Found on</h4>
												<div class="quantity">
													<span class="single-old" style="margin-left: 0px;"><?php
													$thatt=strtotime($row['docfound']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatt)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatt)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatt)."</i>"; 
                                     }
                                      

													?>

													</span>
                                               </div>
											</div>
											<div class="clear"></div>
											<div class="single-pro-button">
												<div class="pro-button">
													<a href="#">Complete</a>
												</div>
												 
											</div>
											 
										</div>
									 
									 
									</div>
								</div>
<?php

$docuser = $row['docuser'];
$hero=$row['docdeclarer'];
$state=$row['docstate'];
}
if ($state==1) {
	# code...
$info='Owner';
}
else
{
$info='Founder';
}

if ($docuser === 'Admin' AND $state == 0) {
	# code...
	$loca = "SELECT *,ufname as clfname, ulname as cllname, uphone as clphone, uemail as clemail,ulocation as address,uphoto as clphoto FROM users WHERE userid = $hero";
	$pref = '';
}
else
{
$loca = "SELECT * FROM client INNER JOIN sector ON sector.sectid=client.claddress INNER JOIN district ON district.distid=sector.district WHERE  client.clid=$hero";
$pref = '../client/';	
}

$get=$pdo->query($loca);
if ($fetch=$get->fetch(PDO::FETCH_ASSOC)) {
	# code...
	$photo = $fetch['clphoto'];
	if (isset($fetch['usector'])) {
		# code...
		$user = $fetch['utype'];
		$sector = $fetch['usector'];
		
	}
	
?>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="single-product-details res-pro-tb">
										<h1><?php echo $info;  ?> details</h1>
										<span class="single-pro-star">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</span>
									 
				<div class="single-pro-price">
					 <?php
                                        if (isset($photo) AND $photo !== '') {
                                            # code...
                                            ?>
                                            <img src="<?php echo $pref.$photo; ?>" alt="" width="100" height="100"/>
                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img src="avatar/none.jpg" alt="" width="100" height="100"/>
                                        <?php
                                        }
                                        ?>
				</div>
			 
										<div class="single-pro-price">
									 	 <span class="single-regular" style="font-size: 16px;">Names:</span>
									 	 <span class="single-old"><?php 
									 	 echo $fetch['clfname']." ".$fetch['cllname'];
									 	 if (isset($user) && $user === 'Organization') {
									 	 	# code...
									 	 
									 	 	echo " branch";
									 	  
									 	   }
									 	   elseif (isset($user) && $user === 'Sector')
									 	   {

$lis = "SELECT * FROM sector JOIN district ON district.distid = sector.district WHERE sector.sectid=$sector";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
                                         echo " (".$roww['distname']." - ".$roww['sectname']." Sector)";
}
									 	   }
									 	   else
									 	   {

									 	   }
									 	  ?></span>
									 	 <br>
											<span class="single-regular"  style="font-size: 16px;">Address:</span>
											<span class="single-old">
												<?php
if ($docuser === 'Admin' AND $state == 0) {
	# code...
		echo $fetch['address'];
}
else
{
	echo $fetch['distname']." - ".$fetch['sectname'];
}
	
 

												?>

											 </span>
										</div>
										<div class="color-quality-pro">
											<div class="color-quality-details">
												<h5>Phone</h5>
												<span class="single-old" style="margin-left: 0px;"><?php echo "+25".$fetch['clphone'];  ?></span>
											</div>
											<div class="color-quality">
												<h4>Email</h4>
												<div class="quantity">
													<span class="single-old" style="margin-left: 0px;"><?php echo $fetch['clemail'];  ?></span>
													</div>
												</div>
											</div>
											<div class="clear"></div>
											<div class="single-pro-button">
												<div class="pro-button">
													<a href="#">CONNECT</a>
												</div>
												<div class="pro-viwer">
													<a href="client-message.php?rec_id=<?php echo $hero;  ?>&user=<?php echo $docuser;  ?>"><i class="fa fa-envelope"></i></a>
													
												</div>
											</div>
											 
										</div>
									 <?php
         }
     }
     else
     {
     	echo '<p style="color:white;"> Something went wrong, If problem persist contact admin</p>';
     }
									 ?>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
        <!-- Single pro tab End-->
        <!--Leaving space before Footer meeiin-->
 
       <?php
    include 'footer.php';
       ?>
    