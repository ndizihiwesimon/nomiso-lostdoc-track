<?php
$locname='Client View';
$usertype='Admin';
include 'header.php';

 $actuserid = $_SESSION['user_id'];
  if (isset($_GET['dis_id'])) {
     # code...
    $disableid = $_GET['dis_id'];
    try {
    // sql to delete a record
    $sql = "UPDATE client SET clstatus = 0 WHERE clid = $disableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Disabled client user','Admin',$actuserid)";
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
    $sql = "UPDATE client SET clstatus = 1 WHERE clid = $enableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Enabled client user','Admin',$actuserid)";
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
                            <h4>Client List</h4>
                            <div class="add-product">
                                <a href="#">Add Client</a>
                            </div>
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
$loca = "SELECT * FROM client INNER JOIN sector ON sector.sectid=client.claddress INNER JOIN district ON district.distid=sector.district INNER JOIN province ON province.provid=district.province ORDER BY client.clregdate DESC";
$get=$pdo->query($loca);
while ($fetch=$get->fetch(PDO::FETCH_ASSOC)) {
    # code...


                                    ?>
                                    <tr>
                                        <td>
                                             <?php
                                        if (isset($fetch['clphoto']) AND $fetch['clphoto'] !== '') {
                                            # code...
                                            ?>
                                            <img src="../client/<?php echo $fetch['clphoto']; ?>" width="100" height="100" alt=""/></td>
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
                                    <td><?php echo $fetch['clfname']." ".$fetch['cllname'];  ?></td>
                                    <td><?php echo $fetch['clgender'];   ?></td>
                                    <td><?php echo $fetch['clphone'];   ?></td>
                                    <td><?php echo $fetch['clemail'];   ?></td>
                                    <td><?php echo $fetch['clidno'];   ?></td>
                                    <td><?php echo $fetch['distname']." - ".$fetch['sectname'];   ?></td>
                                      <td><?php
                                     $thatd=strtotime($fetch['clregdate']);
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
                                        if ($fetch['clstatus'] === '1') {
                                            # code...
                                            ?>
                                            <button onclick="disableCl(<?php echo $fetch['clid']; ?>);" data-toggle="tooltip" title="Disable" class="pd-setting-ed"><i class="fa fa-lock" aria-hidden="true"></i></button>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button onclick="enableCl(<?php echo $fetch['clid']; ?>);" data-toggle="tooltip" title="Enable" class="pd-setting-ed"><i class="fa fa-unlock" aria-hidden="true"></i></button>
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
 <!--Leaving space before Footer meeiin-->
  <script type="text/javascript">
function disableCl(Id){
    var iAnswer = confirm("Are you sure you want to disable this client?");
    if(iAnswer){
        window.location = 'client-view.php?dis_id=' + Id;
    }
  }
  function enableCl(Id){
    var iAnswer = confirm("Are you sure you want to enable this client?");
    if(iAnswer){
        window.location = 'client-view.php?en_id=' + Id;
    }
  }
</script>
       <?php
    include 'footer.php';
       ?>
    