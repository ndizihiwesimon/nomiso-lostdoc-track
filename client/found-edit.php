<?php
$locname='Found Edit';
$usertype='Client';
include 'header.php';

$actuserid = $_SESSION['client_id'];
//first time data
$button='Save';
$edit=0;
$docowner = '';
$doctype = '';
$docno = '';
$docplace = '';
$action='save';

if (isset($_GET['found_id'])) {
    # code...
    $doc=$_GET['found_id'];
    $button='Update';
    $action='update';
    $edit=1;
    $hey = "SELECT * FROM document LEFT JOIN documenttype ON documenttype.dtypeid=document.doctype WHERE docid=$doc";
    $res = $pdo->query($hey);

if ($row=$res->fetch(PDO::FETCH_ASSOC)) {
$docowner = $row['docowner'];
$doctype = $row['doctype'];
$dtypename = $row['dtypename'];
$docno = $row['docno'];
$docplace = $row['docplace'];

}

} 

if (isset($_POST['save']) || isset($_POST['update'])) {
    # code...
    //Retrieve the field values from our registration form.
    $owner = !empty($_POST['owner']) ? trim($_POST['owner']) : null;   
    $type = !empty($_POST['type']) ? trim($_POST['type']) : null;
    $no = !empty($_POST['no']) ? trim($_POST['no']) : null;
    $place = !empty($_POST['place']) ? trim($_POST['place']) : null;
    $editid = !empty($_POST['editid']) ? trim($_POST['editid']) : null;

    $docstatus = 0;
    $docdeclarer=0;
    $regdate=date('Y-m-d H:i:s'); 
    $foundedon=0;
    $poster=$_SESSION['client_id'];
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT *,COUNT(docid) AS exist FROM document WHERE doctype = :type AND docno = :no";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided document type and document no to our prepared statement.
    $stmt->bindValue(':no', $no);
    $stmt->bindValue(':type', $type);

    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the above info already exists - check poster state
 
    if($row['exist'] > 0){
              
        if (isset($_POST['save']) && $row['docstate']=='1') {
            # code...
            //yooo Nomiso please remember to change how message appear...
           die('That document already exists!');  
        }
        elseif (isset($_POST['update']) && $row['docstate']=='1') {
            # code...
        }
        else
        {
           //Inform founder 
            $docstatus = 1;
            $docid = $row['docid'];
            $poster1=$_SESSION['client_id'];
            $poster2=$row['docposter'];
            $docdeclarer=$poster2;
            $foundedon=date('Y-m-d H:i:s');
            $content1='Document you posted have found its owner, Thank you for helping';
            $content2='Here your document is found, conglatulations!';
            $update = "UPDATE document SET docstatus = 1, docdeclarer=:declarer, docfound=:founded WHERE docid = :doc";
            $found="INSERT INTO notification(sendernot,receivernot,notsender,notreceiver,notdoc,notuser) VALUES(:content1,:content2,:poster1,:poster2,:notdoc,'Client')";
            $hello = $pdo->prepare($found);
            $upd = $pdo->prepare($update);

            $hello->bindValue(':content1', $content1);
            $hello->bindValue(':content2', $content2);
            $hello->bindValue(':poster1', $poster1);
            $hello->bindValue(':poster2', $poster2); 
            $hello->bindValue(':notdoc', $docid);
            $upd->bindValue(':doc', $docid); 
            $upd->bindValue(':declarer', $poster1);
            $upd->bindValue(':founded', $regdate);

            $success = $hello->execute();    
            $up = $upd->execute();          
        }
    }
      
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our document table.
    if(isset($_POST['update'])){
$sql="UPDATE document SET docowner=:owner,doctype=:type,docno=:no,docplace=:place WHERE docid=:doc";
    }
   else
   {
$sql = "INSERT INTO document (docowner,doctype,docno,docplace,docposter,docdeclarer,docfound,docstate,docstatus,docuser) VALUES (:owner,:type,:no,:place,:poster,:docdeclarer,:docfounded,'1',:status,'Client')";
   }
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':owner', $owner);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':no', $no);
    $stmt->bindValue(':place', $place); 

if (isset($_POST['update'])) {
    # code...
    $stmt->bindValue(':doc', $editid);
}
else
{
    $stmt->bindValue(':poster', $poster);
    $stmt->bindValue(':docdeclarer', $docdeclarer);
    $stmt->bindValue(':docfounded', $foundedon);
    $stmt->bindValue(':status', $docstatus);
}
    
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result && isset($_POST['save'])){
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('New found document record','Client',$actuserid)";
    $pdo->exec($actsql);  
    }
    else
    {
    $actsql = "INSERT INTO activitylog(actdesc,actuser,actuserid) VALUES('Updated found document record','Client',$actuserid)";
    $pdo->exec($actsql);       
 ?>
<script type="text/javascript">
   window.setTimeout(function() {
    window.location.href = 'found-view.php';
}, 2000); 
</script>


  <?php
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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i>Add found document</a></li>
                                    
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <form method="POST" action="found-edit.php">
                                                     <div class="mg-b-pro-edt">
                                                     <select name="type" class="form-control pro-edt-select form-control-primary" required>
                                                             <?php if (isset($_GET['found_id'])) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php echo $doctype; ?>"><?php echo $dtypename; ?></option>

                                                            <?php
                                                        }
                                                        else
                                                        {


                                                        ?>
                                                            <option value="">Document Type</option>
                                                            <?php
                                                        }
                                                            try
                                                            {
                                                                $query="SELECT * FROM documenttype WHERE dtypestatus = 1";
                                                                $result=$pdo->query($query);
                                                                if ($result->rowCount()>0) {
                                                                    # code...
                                                                    while ($row=$result->fetch()) {
                                                                        # code...
                                                                        ?>
                                                                        <option value="<?php echo $row['dtypeid'];   ?>"><?php echo $row['dtypename'];   ?></option>


                                                                        <?php
                                                                       
                                                                    }
                                                                unset($result);
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <option value="">Nothing found</option>
                                                                    <?php
                                                                }

                                                            }
                                                            catch(PDOException $e){
                                                                die("ERROR: Could not be able to execute $query." . $e->getMessage());
                                                            }

                                                            ?>
                                                        </select>
                                                    </div> 
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input type="text" name="owner" value="<?php echo $docowner;  ?>" class="form-control" placeholder="Owner Names" required>
                                                    </div>                                                    
                                                   
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                  
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                                        <input type="text" name="no" value="<?php echo $docno;  ?>" class="form-control" placeholder="Document No" required>
                                                    </div>

                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-favorites-button" aria-hidden="true"></i></span>
                                                        <input type="text" name="place" value="<?php echo $docplace;  ?>" class="form-control" placeholder="Document Place">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="hidden" name="editid" value="<?php echo $doc;   ?>">
                                                    <button type="submit" name="<?php echo $action;   ?>" class="btn btn-ctl-bt waves-effect waves-light m-r-10"><?php echo $button; ?>
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
        <!--Leaving space before Footer meeiin-->
 
       <?php
    include 'footer.php';
       ?>
    