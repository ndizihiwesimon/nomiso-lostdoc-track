<?php
$locname='Notification View';
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

 <!-- Single pro lost/found list start-->
 <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Notification List</h4>
                             <table>
                                <tr>
                                    <th>Image</th>
                                    <th>Notification</th>
                                    <th>Added at</th>
                                     
                                </tr>
                                
 <?php
$mine=$_SESSION['user_id'];
$list="SELECT * FROM notification WHERE notuser = 'Admin' && notsender=$mine || notreceiver=$mine order by nottime DESC";
$result=$pdo->query($list);
if ($result->rowCount()>0) {
    # code...
while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
    # code...
  if ($row['notreceiver']===$mine) {
 # code...

$yours=$row['notsender'];
$list2 = "SELECT * FROM client WHERE clid=$yours";
$result2 = $pdo->query($list2);
while ($row2=$result2->fetch()) {
        
$name = $row2['clfname']; 
$photocol = $row2['clphoto'];
$photo = '../'.$photocol;                            
                         }

}
else
{
$yours=$row['notreceiver'];
$list2 = "SELECT * FROM client WHERE clid=$yours";
$result2 = $pdo->query($list2);
while ($row2=$result2->fetch()) {
        
$name = $row2['clfname'];
$photocol = $row2['clphoto'];
$photo = '../'.$photocol; 
                           
                         }
 
}
                      
                                    ?>
                                    
                                    <tr>
                                    <td>
                                     <a href="document-view.php?docid=<?php echo $row['notdoc'];?>">
                                        <?php
                                        if (isset($photocol) AND $photocol !== '') {
                                            # code...
                                            ?>
                                            <img src="<?php echo $photo; ?>" alt="" data-toggle="tooltip" title="Click here to view" /></a></td>
                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img src="avatar/none.jpg" alt="" data-toggle="tooltip" title="Click here to view" /></a></td>
                                        <?php
                                        }
                                        ?>
                                    <td> 
                                    	           <h3>
                         <?php
                         echo $name;

                           ?>
                                                                       
                                                         </h3>
      <?php
      if ($row['notreceiver']===$mine) {
          # code...
        echo $row['receivernot'];
      }
      else
      {
        echo $row['sendernot'];
      }
      ?>                                                                              

                                     </td>
                                     <td>
                                     	<?php
                                     $thatd=strtotime($row['nottime']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo "<i>Today ".date('H:i',$thatd)."</i>";
                                     }
                                     else
                                     {
                                         echo date("d m Y",$thatd); 
                                     }
                                      
                                     ?>
                                     </td>
                                     <td>
                                        <button  onclick="location.href='document-view.php?docid=<?php  echo $row['notdoc'];  ?>'" data-toggle="tooltip" title="View" class="pd-setting-ed"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        </td>
                                     </tr>
                                     
 
                                 <?php

                                 
}
}
else
{
    ?>
<tr>
    <td colspan="3"><p align="center">...Nothing found!...</p></td>
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
    