<?php
$locname='Message';
$usertype='Client';
include 'header.php';

$mi = $_SESSION['client_id'];
$button='Send';
$action='send';
 
 if (isset($_GET['rec_id'])) {
     # code...
    $rec_id = $_GET['rec_id'];
    $user = $_GET['user'];
    if ($user === 'Client') {
        # code...
    $get = "SELECT * FROM client WHERE clid = $rec_id";
    $getem = $pdo->query($get);
    if ($fet = $getem->fetch()) {
        # code...
        $fname = $fet['clfname'];
        $lname = $fet['cllname'];
    }        
    }
    else
    {
    $get = "SELECT * FROM users WHERE userid = $rec_id";
    $getem = $pdo->query($get);
    if ($fet = $getem->fetch()) {
        # code...
        $fname = $fet['ufname'];
        $lname = $fet['ulname'];
    } 
    }

}
    if (isset($_POST['send'])) {
        # code...
    
    //Retrieve the field values from our registration form.
    $recname = !empty($_POST['receiver']) ? trim($_POST['receiver']) : null;   
    $msgcontent = !empty($_POST['message']) ? trim($_POST['message']) : null;
    $usert = !empty($_POST['user2']) ? trim($_POST['user2']) : null;
        
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our message table.
    $sql = "INSERT INTO message (msg_content,msg_sender,msg_receiver,msg_user) VALUES (:message,:sender,:receiver,:user)";
 
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':message', $msgcontent);    
    $stmt->bindValue(':receiver', $recname);
    $stmt->bindValue(':sender', $mi);
    $stmt->bindValue(':user', $usert);
 
    //Execute the statement and insert the new message.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
 
       // redirect to google after 5 seconds
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New message','Client',$mi)";
    $pdo->exec($actsql);
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
<?php
 if (isset($_GET['rec_id'])) {
     # code...
?>
 <!-- Single pro tab start-->
        <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <ul id="myTab3" class="tab-review-design">
                                    <li class="active"><a href="#description"><i class="fa fa-plus" aria-hidden="true"></i>New message</a></li>
                                    
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="client-message.php">
  
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="hidden" name="receiver" value="<?php echo $rec_id;  ?>">
                                                        <input type="hidden" name="user2" value="<?php echo $user; ?>">
                                                        <input type="text"  value="<?php echo $fname." ".$lname;  ?>" class="form-control">
                                                    </div>                                                    
                                                   
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
 
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                        <textarea name="message" class="form-control" placeholder="Message content goes here..." required></textarea> 
                                                       
                                                       

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
 
                                                    <button type="submit" name="<?php echo $action;  ?>" class="btn btn-ctl-bt waves-effect waves-light m-r-10"><?php  echo $button;  ?>
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
<?php
}
?>

         <!-- Single pro lost/found list start-->
 <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Sent Messages</h4>
                             
                            <table>
                                <tr>
                                    <th>Image</th>
                                    <th>Receiver</th>
                                    <th>Message</th>
                                    <th>Sent on</th>
                                    <th>Status</th>
                                </tr>
                                
 <?php
 $oh = "SELECT * FROM message WHERE msg_sender = $mi order by msg_date DESC";
 $hh = $pdo->query($oh);
 if ($hh->rowCount()>0) {
    # code...
 while ($row=$hh->fetch()) {
     # code...
 $userr = $row['msg_user'];
 $rec = $row['msg_receiver'];
 if ($userr === 'Client') {
     # code...
    $list = "SELECT * FROM client WHERE clid = $rec";
    $result = $pdo->query($list);
    $roo=$result->fetch();
    # code...
    $fname2 = $roo['clfname'];
    $lname2 = $roo['cllname'];
    $photocol = $roo['clphoto'];
    $photo = $photocol;
 }
 else
 {
    $list = "SELECT * FROM users WHERE userid = $rec";
    $result = $pdo->query($list);
    $roo=$result->fetch();
    # code...
    $fname2 = $roo['ufname'];
    $lname2 = $roo['ulname'];
    $photocol = $roo['uphoto'];
    $photo = 'admin/'.$photocol;
 
 }


                                    ?>
                                    <tr>
                                    <td>
                                          <?php
                                           if ($photocol !== '') {
        # code...
        ?>
     <img src="<?php echo $photo;  ?>" alt="" width="100" height="100"/>
     <?php 
    }
    else
    {
        ?>
 <img src="avatar/none.jpg" alt="" width="100" height="100"/>
        <?php
    }
    
           ?>
                                    </td>
                                    <td><?php echo $fname2." ".$lname2;   ?></td>
                                    <td><?php echo $row['msg_content'];  ?> </td>
                                      <td><?php
                                     $thatd=strtotime($row['msg_date']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatd)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d M Y",$thatd)."</i>"; 
                                     }
                                      
                                     ?></td>
                                    <td>
                                         <?php
   if ($row['msg_receiver'] == 0) {
               
            
           

                                ?>
                                        <button class="ds-setting"><i>Pending</i></button>
                                     
   <?php
}
 else
            {
                ?>
                <button class="pd-setting"><i>Delivered</i></button>

                <?php
            }

                ?>
                                 
                                    </td>
                                </tr>
                                 <?php
                             
}
}
else
{
    ?>
<tr>
    <td colspan="5"><p align="center">...No message yet!...</p></td>
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
        <!--Leaving space before Footer meeiin-->
 
       <?php
    include 'footer.php';
       ?>
    