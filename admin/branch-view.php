<?php
$locname='Branch Users View';
$usertype='Admin';
include 'header.php';

   $actuserid = $_SESSION['user_id'];
  if (isset($_GET['dis_id'])) {
     # code...
    $disableid = $_GET['dis_id'];
    try {
    // sql to delete a record
    $sql = "UPDATE users SET ustatus = 0 WHERE userid = $disableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Disabled branch user','Admin',$actuserid)";
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
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Enabled branch user','Admin',$actuserid)";
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
                            <h4>Branch Users List</h4>
                            <div class="add-product">
                                <a href="branch-edit.php">Add user</a>
                            </div>
                            <table>
                                <tr>
                                    <th>Photo</sub></th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <td>Branch</td>
                                    <th>Address</th>
                                    <th>Setting</th>
                                </tr>
                                
 <?php
 $mine = $_SESSION['user_id'];
$lo = "SELECT * FROM users WHERE utype='Organization' AND reguser=$mine order by uregdate DESC";
$ge=$pdo->query($lo);
if ($ge->rowCount()>0) {
    # code...

while ($fet=$ge->fetch(PDO::FETCH_ASSOC)) {
    # code...


                                    ?>
                                    <tr>
                                        <td>
                                            <img src="img/new-product/5-small.jpg" alt=""/>
                                        </td>
                                    <td><?php echo $fet['ufname'];  ?></td>
                                    <td><?php echo $fet['uphone'];   ?></td>
                                    <td><?php echo $fet['uemail'];   ?></td>
                                    <td><?php echo $fet['ulname'];   ?></td>
                                    <td><?php echo $fet['ulocation'];   ?></td>
                                    <td>
                                        <button data-toggle="tooltip" onclick="location.href='branch-edit.php?org_id=<?php echo $fet['userid'];  ?>'" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                           
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
 }
else
{
    ?>
<tr>
    <td colspan="7"><p align="center">...Nothing found!...</p></td>
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
        window.location = 'branch-view.php?dis_id=' + Id;
    }
  }
  function enableCl(Id){
    var iAnswer = confirm("Are you sure you want to enable this sector?");
    if(iAnswer){
        window.location = 'branch-view.php?en_id=' + Id;
    }
  }
</script>
       <?php
    include 'footer.php';
       ?>
    