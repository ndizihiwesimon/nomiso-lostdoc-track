<?php
$locname='Dashboard';
$usertype='Client';

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
												<p>Welcome to Nomiso <span class="bread-ntd"><?php echo $usertype;  ?> Panel</span></p>
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
        
                <div class="section-admin container-fluid">
            <div class="row admin text-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-15">
                                <h4 class="text-left text-uppercase"><b>Found</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                    <div class="col-xs-3 mar-bot-15 text-left">
                                        <label class="label bg-green">100% <i class="fa fa-level-up" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                        <?php
$user = $_SESSION['client_id'];                                        
$dataf = "SELECT count(docid) as new_found FROM document WHERE docposter = $user AND docstate = '1' AND docuser = 'Client'";
$getf = $pdo->query($dataf);
if ($rof=$getf->fetch()) {
        
$new_found = $rof['new_found']; 
                           
                         }


                                        ?>
                                        <h2 class="text-right no-margin"><?php echo $new_found; ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: 100%;" class="progress-bar bg-green"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                                <h4 class="text-left text-uppercase"><b>Lost</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                    <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-purple">100% <i class="fa fa-level-up" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
<?php
$datas = "SELECT count(docid) as new_lost FROM document WHERE docposter = $user AND docstate = '0'";
$gets = $pdo->query($datas);
if ($ros=$gets->fetch()) {
        
$new_lost = $ros['new_lost']; 
                           
                         }

                                        ?>

                                        <h2 class="text-right no-margin"><?php echo $new_lost;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: 100%;" class="progress-bar bg-purple"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                               <h4 class="text-left text-uppercase"><b>Found Success</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
 <?php
$datai = "SELECT count(docid) as new_fsuccess FROM document WHERE docposter = $user AND docstate = '1' AND docdeclarer != '0' AND docuser = 'Client'";
$geti = $pdo->query($datai);
if ($roi=$geti->fetch()) {
        
$new_fsuccess = $roi['new_fsuccess']; 
                           
                         }
$new_f = $new_found;     
if ($new_found === '0') {
    # code...
    $new_f = 1;
}                         
$fperc = ($new_fsuccess / $new_f) * 100;
$fperc = number_format($fperc, 1);

                                       
if ($fperc < 50) {
    # code...
    $fdire = 'down';
}
else
{
    $fdire = 'up';
}
                                        ?>
                                         <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-red"><?php echo $fperc; ?>% <i class="fa fa-level-<?php echo $fdire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">

                                        <h2 class="text-right no-margin"><?php echo $new_fsuccess;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $fperc; ?>%;" class="progress-bar bg-red"></div>
                                </div>
                            </div>
                        </div>
                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                              <h4 class="text-left text-uppercase"><b>Lost Succeed</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
<?php
$datats = "SELECT count(docid) as new_lsuccess FROM document WHERE docposter = $user  AND docstate = '0' AND docdeclarer != '0'";
$getts = $pdo->query($datats);
if ($rots=$getts->fetch()) {
        
$new_lsuccess = $rots['new_lsuccess']; 
                           
                         }
$new_l = $new_lost;     
if ($new_lost === '0') {
    # code...
    $new_l = 1;
}
$lperc = ($new_lsuccess / $new_l) * 100;
$lperc = number_format($lperc, 1);                        
                         
if ($lperc < 50) {
    # code...
    $ldire = 'down';
}
else
{
    $ldire = 'up';
}
                                        ?>
                                    <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-blue"><?php echo $lperc; ?>% <i class="fa fa-level-<?php echo $ldire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">

                                        <h2 class="text-right no-margin"><?php echo $new_lsuccess;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $lperc; ?>%;" class="progress-bar bg-blue"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <!--Leaving space before Footer meeiin-->

         <div class="mg-tb-30">
            
        </div>

  <script type="text/javascript" src="gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="gritter-conf.js"></script>
          <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Nomiso!',
        // (string | mandatory) the text inside the notification
        text: 'You have successfully Logged in',
        // (string | optional) the image to display on the left
        image: 'img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>

       <?php
    include 'footer.php';
       ?>
     