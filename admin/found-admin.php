<?php
$locname='Found View';
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
                            <h4>Found List</h4>
                            <div class="add-product">
                                <a href="#">Add Found</a>
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
                                    <th>Action</th>
                                </tr>
                                
 <?php
$list = "SELECT * FROM document JOIN documenttype ON documenttype.dtypeid=document.doctype WHERE document.docstate='1' order by document.docregdate DESC";
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
               
            
           

                                ?>
                                        <button class="ds-setting"><i>Waiting</i></button>
                                     
   <?php
}
 else
            {
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
                $mode = 'disabled';
            }
            else
            {
$mode = '';
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
    echo " <br><i>".date("d M Y",$thatt)."</i>";
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
                                         echo "<i>".date("d M Y",$thatd)."</i>"; 
                                     }
                                      
                                     ?><br> By 
                                     <?php
                                     $user = $row['docposter'];
                                     if (isset($row['docuser']) && $row['docuser'] === 'Admin') {
                                         # code...
                                     

$lis = "SELECT * FROM users WHERE userid=$user";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    $user = $roww['utype'];
    $sector = $roww['usector'];
 
                                         
                                         if (isset($user) && $user === 'Organization') {
                                            # code...
                                         echo $roww['ufname']." ".$roww['ulname'];
                                            echo " branch";
                                          
                                           }
                                           elseif (isset($user) && $user === 'Sector')
                                           {

$liso = "SELECT * FROM sector JOIN district ON district.distid = sector.district WHERE sector.sectid=$sector";
$reso = $pdo->query($liso);
if ($ro=$reso->fetch()) {
                                         echo $ro['distname']." - ".$ro['sectname']." Sector";
}
                                           }
                                           else
                                           {

                                           }
        
                                        
}
}
else
{
   $lis = "SELECT * FROM client WHERE clid=$user";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    
        echo $roww['cllname'];
                                        
} 
}
?>
                                         
                                     </td>
                                    <td>
                                        <button  onclick="location.href='document-admin.php?docid=<?php  echo $row['docid'];  ?>'" <?php echo $mode; ?> data-toggle="tooltip" title="View" class="pd-setting-ed"><i class="fa fa-eye" aria-hidden="true"></i></button>
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
 
       <?php
    include 'footer.php';
       ?>
    