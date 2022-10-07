<?php
include "connect.php";
$s=$_POST['district'];
?>
      <select name="sector" id="sector" class="form-control pro-edt-select form-control-primary">
      <option value="">Sector</option>
        <?php
  // Attempt select query execution
try{
    $sql = "SELECT * FROM sector WHERE district='$s'";   
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
while($row = $result->fetch()){
?>                                                        
                                                            
               <option value="<?php echo $row['sectid'];  ?>"><?php echo $row['sectname'];  ?></option>
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