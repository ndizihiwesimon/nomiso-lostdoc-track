<?php
$locname='Message';
$usertype='Client';
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

 <!-- Single pro lost/found list start-->
 <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Incoming Messages</h4>
                             
                            <table>
                                <tr>
                                    <th>Image</th>
                                    <th>Sender</th>
                                    <th>Message</th>
                                    <th>Received on</th>
                                </tr>
                                
 <?php
 $oh = "SELECT * FROM message WHERE msg_receiver = $mi order by msg_date DESC";
 $hh = $pdo->query($oh);
 if ($hh->rowCount()>0) {
    # code...
 while ($row=$hh->fetch()) {
     # code...
 $userr = $row['msg_user'];
 $sen = $row['msg_sender'];
 if ($userr === 'Client') {
     # code...
    $list = "SELECT * FROM client WHERE clid = $sen";
 }
 else
 {
    $list = "SELECT *,ufname clfname, ulname cllname FROM users WHERE userid = $sen";
 }

$result = $pdo->query($list);
if ($roo=$result->fetch()) {
    # code...
    $fname = $roo['clfname'];
    $lname = $roo['cllname'];
    
    if (isset($roo['utype'])) {
        # code...
    $usert = $roo['utype'];
    $sector = $roo['usector'];  
    $photocol = $roo['uphoto'];
    $photo = 'admin/'.$photocol;       
    }
    else
    {
    $photocol = $roo['clphoto'];
    $photo = $photocol;
    }
   
   
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
                                    <td><?php echo $fname." ".$lname;  
                                     if (isset($usert) && $usert === 'Organization') {
                                            # code...
                                         
                                            echo " branch";
                                          unset($usert);
                                           }
                                           elseif (isset($usert) && $usert === 'Sector')
                                           {

$lis = "SELECT * FROM sector JOIN district ON district.distid = sector.district WHERE sector.sectid=$sector";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
                                         echo " (".$roww['distname']." - ".$roww['sectname']." Sector)";
}
unset($usert);
                                           }
                                           else
                                           {

                                           }
                                            
                                           ?>
                                        
                                    </td>
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
    