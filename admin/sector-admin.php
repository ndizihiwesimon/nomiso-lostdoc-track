<?php
$locname='Sector Users View';
$usertype='Admin';
include 'header.php';
 
 $actuserid = $_SESSION['user_id'];
 if (isset($_GET['dis_id'])) {
     # code...
    $disableid = $_GET['dis_id'];
    try {
    // sql to delete a record
    $sql = "UPDATE users SET ustatus = 0 WHERE userid = $disableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Disabled sector user','Admin',$actuserid)";
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
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Enabled sector user','Admin',$actuserid)";
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
                            <h4>Sector Users List</h4>
                            <div class="add-product">
                                <a href="#">Add user</a>
                            </div>
                            <table>
                                <tr>
                                    <th>Photo</th>
                                    <th>Sector</th>
                                    <th>District</th>
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
 $mine = $_SESSION['user_id'];
$locaa = "SELECT * FROM users INNER JOIN sector ON sector.sectid=users.uaddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province WHERE users.utype='Sector' order by users.uregdate DESC";
$gett=$pdo->query($locaa);
if ($gett->rowCount()>0) {
    # code...

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
$sect=$fetchh['usector'];
$lis = "SELECT * FROM sector LEFT JOIN district ON sector.district = district.distid WHERE sectid=$sect";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
                                         echo $roww['sectname'];
                                         $dist = $roww['distname'];
}

                                          ?></td>
                                    <td><?php echo $dist;   ?></td>      
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
        echo $roww['ulname'];
    }
                                         
                                         
}
?>
                                 </td>
                                    <td>
                                         
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
 }
 else
 {
        ?>
<tr>
    <td colspan="12"><p align="center">...Nothing found!...</p></td>
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
    <script type="text/javascript">
function disableCl(Id){
    var iAnswer = confirm("Are you sure you want to disable this sector?");
    if(iAnswer){
        window.location = 'sector-admin.php?dis_id=' + Id;
    }
  }
  function enableCl(Id){
    var iAnswer = confirm("Are you sure you want to enable this sector?");
    if(iAnswer){
        window.location = 'sector-admin.php?en_id=' + Id;
    }
  }
</script>
       <?php
    include 'footer.php';
       ?>
    