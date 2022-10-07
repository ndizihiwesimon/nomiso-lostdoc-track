<?php
$locname='Found View';
$usertype='Client';
include 'header.php';
 
 $actuserid = $_SESSION['client_id'];
 if (isset($_GET['del_id'])) {
     # code...
    $deleteid = $_GET['del_id'];
    try {
    // sql to delete a record
    $sql = "DELETE FROM document WHERE docid=$deleteid";
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Deleted found document record','Client',$actuserid)";
    $pdo->exec($actsql);  
    //use exec() because no results are returned
    $pdo->exec($sql);
   // echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    die("ERROR: Could not delete. " . $e->getMessage());
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
                            <h4>Found List</h4>
                            <div class="add-product">
                                <a href="found-edit.php" data-toggle="tooltip" title="Add new">Add Found</a>
                            </div>
                            <table>
                                <tr>
                                    <th>Image</th>
                                    <th>Document Title</th>
                                    <th>Owner Names</th>
                                    <th>Document number</th>
                                    <th>Place</th>
                                    <th>Status</th>
                                    <th>Lost by</th>
                                    <th>Added at</th>
                                    <th>Setting</th>
                                </tr>
                                
 <?php
$clientid = $_SESSION['client_id'];
$list = "SELECT * FROM client INNER JOIN document ON document.docposter=client.clid INNER JOIN documenttype ON documenttype.dtypeid=document.doctype WHERE  document.docposter =$clientid AND document.docstate='1' AND document.docuser='Client' ORDER BY document.docregdate DESC";
$result = $pdo->query($list);
if ($result->rowCount()>0) {
    # code...

while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
    # code...


                                    ?>
                                    <tr>
                                    <td><img src="img/new-product/5-small.jpg" alt="" /></td>
                                    <td><?php echo $row['dtypename'];  ?></td>
                                    <td><?php echo $row['docowner'];   ?></td>
                                    <td><?php echo $row['docno'];  ?> </td>
                                    <td><?php echo $row['docplace'];  ?></td>
                                    <td>
                                        <?php
   if ($row['docdeclarer'] == '0') {
               
            
           $mode = '';

                                ?>
                                        <button class="ds-setting"><i>Waiting</i></button>
                                     
   <?php
}
 else
            {
                $mode = 'disabled';
                ?>
                <button class="pd-setting"><i>Success</i></button>

                <?php
            }

                ?>
                                    </td>                                    
                                    <td><?php
            if ($row['docstatus'] == '0') {
                # code...
                echo "<i>Waiting</i>";
            }
            else
            {

$founder=$row['docdeclarer'];
$list2 = "SELECT * FROM client WHERE clid=$founder";
$result2 = $pdo->query($list2);
while ($row2=$result2->fetch()) {
        
echo $row2['clfname']." ".$row2['cllname']; 

$thatt=strtotime($row['docfound']);
if (date('Y-m-d')===date('Y-m-d',$thatt)) {
   # code...
echo "<br><i>2 mins ago</i>";
}
else
{
    echo " <br><i>".date("d-M-Y",$thatt)."</i>";
}

            }                
              
}
               ?>

                                         
                                     </td>
                                     <td><?php
                                     $thatd=strtotime($row['docregdate']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatd)."</i>";
                                     }
                                     else
                                     {
                                         echo "<i>".date("d-M-Y",$thatd)."</i>"; 
                                     }
                                      
                                     ?></td>
                                    <td>
                                        <button onclick="location.href='found-edit.php?found_id=<?php  echo $row['docid'];  ?>'" data-toggle="tooltip" title="Edit"  <?php echo $mode; ?> class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button onclick="deleteDoc(<?php echo $row['docid']; ?>);" data-toggle="tooltip" title="Discard" <?php echo $mode; ?> class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                                 <?php
 
}
}
else
{
    ?>
<tr>
    <td colspan="8"><p align="center">...Nothing found!...</p></td>
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
function deleteDoc(Id){
    var iAnswer = confirm("Are you sure you want to delete this document?");
    if(iAnswer){
        window.location = 'found-view.php?del_id=' + Id;
    }
  }
</script>
       <?php
    include 'footer.php';
       ?>
    