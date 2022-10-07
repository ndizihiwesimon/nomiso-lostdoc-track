<?php
include "connect.php";
$q=$_POST['province'];
?>
      <select name="district" class="form-control pro-edt-select form-control-primary">
      <option value="">District</option>
        <?php
  // Attempt select query execution
try{
    $sql = "SELECT * FROM district WHERE province='$q'";   
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
while($row = $result->fetch()){
?>                                                        
                                                            
               <option value="<?php echo $row['distid'];  ?>"><?php echo $row['distname'];  ?></option>
               <?php
                               }
       
        // Free result set
        unset($result);
    } else{
        ?>
        <option value="">Nothing found!</option>
        <?php
    }
}
 catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

?>                                               
                    </select>
 