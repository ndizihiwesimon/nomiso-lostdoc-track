<?php
$locname='Settings';
$usertype='Admin';
include 'header.php';

 $actuserid = $_SESSION['user_id'];
  if (isset($_GET['dis_id'])) {
     # code...
    $disableid = $_GET['dis_id'];
    try {
    // sql to delete a record
    $sql = "UPDATE documenttype SET dtypestatus = 0 WHERE dtypeid = $disableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Disabled document type','Admin',$actuserid)";
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
    $sql = "UPDATE documenttype SET dtypestatus = 1 WHERE dtypeid = $enableid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Enabled document type','Admin',$actuserid)";
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
  

$name='';
$ddescription='';
$button='Save';
$action='save';
$editid=0;
if (isset($_GET['dtype_id'])) {
    # code...
    $editid=$_GET['dtype_id'];
    $hello = "SELECT * FROM documenttype WHERE dtypeid=$editid";
    $hey = $pdo->query($hello);
    $fetch = $hey->fetch();

    $button='Update';
    $action='update';
    $name=$fetch['dtypename'];
    $ddescription=$fetch['dtypedesc'];    
}
    if (isset($_POST['save']) || isset($_POST['update'])) {
        # code...
    
    //Retrieve the field values from our registration form.
    $typename = !empty($_POST['type']) ? trim($_POST['type']) : null;   
    $description = !empty($_POST['description']) ? trim($_POST['description']) : null;
    $editid = !empty($_POST['editid']) ? trim($_POST['editid']) : null;
    $regdate=date('Ymd H:i:s');  
 
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(dtypeid) AS dtype FROM documenttype WHERE dtypename = :typename";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided document type name to our prepared statement.
    $stmt->bindValue(':typename', $typename);

    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the above info already exists - check poster state
 
    if(isset($_POST['save']) && $row['dtype'] > 0){
            # code...
            //yooo Nomiso please remember to change how message appear...
           die('That document type already exists!');  
   }
  if (isset($_POST['update']) && $row['dtype']!=$editid && $row['dtype'] > 0) {
       # code...
    die('Ooops, can\'t update \'cause that type name already exists');
   }

if(isset($_POST['save'])){      
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our document table.
    $sql = "INSERT INTO documenttype (dtypename,dtypedesc) VALUES (:typename,:description)";
   }
   else
   {
    $sql = "UPDATE documenttype SET dtypename=:typename, dtypedesc=:description WHERE dtypeid=:editid";
   }
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':typename', $typename);    
    $stmt->bindValue(':description', $description);
    if (isset($_POST['update'])) {
        # code...
    $stmt->bindValue(':editid', $editid);
    }
   // $stmt->bindValue(':regdate', $regdate);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
 if (isset($_POST['save'])) {
     # code...
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New document type record','Admin',$actuserid)";
    $pdo->exec($actsql);
 }
 else
 {
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated document type record','Admin',$actuserid)";
    $pdo->exec($actsql);
    // redirect to google after 5 seconds

 ?>
<script type="text/javascript">
   window.setTimeout(function() {
    window.location.href = 'doc-type.php';
}, 5000); 
</script>
  <?php
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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i>Add  document Types</a></li>
                                    
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="doc-type.php">
  
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="type" value="<?php echo $name;  ?>" class="form-control" placeholder="Document type name" required>
                                                    </div>                                                    
                                                   
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
 
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-favorites-button" aria-hidden="true"></i></span>
                                                        <textarea name="description" class="form-control" placeholder="Description goes here..." required><?php echo $ddescription;   ?></textarea> 
                                                       
                                                       

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">

                                                    <input type="hidden" name="editid" value="<?php echo $editid;   ?>">
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
         <!-- Single pro lost/found list start-->
 <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Document type List</h4>
                             
                            <table>
                                <tr>
                                    <th>N<sup>O</sup></sub></th>
                                    <th>Document Type name</th>
                                    <th>Description</th>
                                    <th>Registered on</th>
                                    <th>Setting</th>
                                </tr>
                                
 <?php
$list = "SELECT * FROM documenttype";
$result = $pdo->query($list);
$number=1;
while ($row=$result->fetch()) {
    # code...


                                    ?>
                                    <tr>
                                    <td><?php echo $number;  ?></td>
                                    <td><?php echo $row['dtypename'];   ?></td>
                                    <td><?php echo $row['dtypedesc'];  ?> </td>
                                      <td><?php
                                     $thatd=strtotime($row['dtyperegdate']);
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
                                        <button data-toggle="tooltip"  onclick="location.href='doc-type.php?dtype_id=<?php echo $row['dtypeid'];?>'" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                          <?php
                                        if ($row['dtypestatus'] === '1') {
                                            # code...
                                            ?>
                                            <button onclick="disableCl(<?php echo $row['dtypeid']; ?>);" data-toggle="tooltip" title="Disable" class="pd-setting-ed"><i class="fa fa-lock" aria-hidden="true"></i></button>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button onclick="enableCl(<?php echo $row['dtypeid']; ?>);" data-toggle="tooltip" title="Enable" class="pd-setting-ed"><i class="fa fa-unlock" aria-hidden="true"></i></button>
                                            <?php
                                        }

                                        ?>
                                    </td>
                                </tr>
                                 <?php
$number+=1;                                 
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
    var iAnswer = confirm("Are you sure you want to disable this type?");
    if(iAnswer){
        window.location = 'doc-type.php?dis_id=' + Id;
    }
  }
  function enableCl(Id){
    var iAnswer = confirm("Are you sure you want to enable this type?");
    if(iAnswer){
        window.location = 'doc-type.php?en_id=' + Id;
    }
  }
</script>
       <?php
    include 'footer.php';
       ?>
    