<?php
$locname='Dashboard';
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

<?php
if (isset($_SESSION['utype']) AND $_SESSION['utype'] === 'Super') {
    # code...

?>
        <div class="section-admin container-fluid">
            <div class="row admin text-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-15">
                                <h4 class="text-left text-uppercase"><b>New clients</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                        <?php
$data = "SELECT *,count(clid) as new_client FROM client WHERE DATE(clregdate) = CURDATE()";
$get = $pdo->query($data);
if ($ro=$get->fetch()) {
        
$new_client = $ro['new_client']; 
                           
                         }

$datatc = "SELECT count(clid) as total_client FROM client";
$gettc = $pdo->query($datatc);
if ($rotc=$gettc->fetch()) {
        
$total_client = $rotc['total_client']; 
                           
                         }
$new_c = $total_client;     
if ($total_client === '0') {
    # code...
    $new_c = 1;
}
$cperc = ($new_client / $new_c) * 100;
$cperc = number_format($cperc, 1);                        
                         
if ($cperc < 50) {
    # code...
    $cdire = 'down';
}
else
{
    $cdire = 'up';
}
                                       
                                        ?>

                                    <div class="col-xs-3 mar-bot-15 text-left">
                                        <label class="label bg-green"><?php echo $cperc; ?>% <i class="fa fa-level-<?php echo $cdire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                        <h2 class="text-right no-margin"><?php echo $new_client; ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $cperc; ?>%;" class="progress-bar bg-green"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                                <h4 class="text-left text-uppercase"><b>Today's lost</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
<?php
$datal = "SELECT *,count(docid) as new_lost FROM document WHERE docstate = '0' AND DATE(docregdate) = CURDATE()";
$getl = $pdo->query($datal);
if ($rol=$getl->fetch()) {
        
$new_lost = $rol['new_lost']; 
                           
                         }
$datatl = "SELECT count(docid) as total_lost FROM document WHERE docstate = '0'";
$gettl = $pdo->query($datatl);
if ($rotl=$gettl->fetch()) {
        
$total_lost = $rotl['total_lost']; 
                           
                         }
$new_l = $total_lost;     
if ($total_lost === '0') {
    # code...
    $new_l = 1;
}
$lperc = ($new_lost / $new_l) * 100;
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
                                        <label class="label bg-red"><?php echo $lperc; ?>% <i class="fa fa-level-<?php echo $ldire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                        <h2 class="text-right no-margin"><?php echo $new_lost; ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $lperc; ?>%;" class="progress-bar progress-bar-danger bg-red"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                                <h4 class="text-left text-uppercase"><b>Today's found</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">

<?php
$dataf = "SELECT count(docid) as new_found FROM document WHERE docstate = '1' AND DATE(docregdate) = CURDATE()";
$getf = $pdo->query($dataf);
if ($rof=$getf->fetch()) {
        
$new_found = $rof['new_found']; 
                           
                         }

$datatf = "SELECT count(docid) as total_found FROM document WHERE docstate = '1'";
$gettf = $pdo->query($datatf);
if ($rotf=$gettf->fetch()) {
        
$total_found = $rotf['total_found']; 
                           
                         }
$new_f = $total_found;     
if ($total_found === '0') {
    # code...
    $new_f = 1;
}
$fperc = ($new_found / $new_f) * 100;
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
                                        <label class="label bg-blue"><?php echo $fperc; ?>% <i class="fa fa-level-<?php echo $fdire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                        <h2 class="text-right no-margin"><?php echo $new_found; ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $fperc; ?>%;" class="progress-bar bg-blue"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                                <h4 class="text-left text-uppercase"><b>New users</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
<?php
$dateu = date("Y-m-d");
$datau = "SELECT count(userid) as new_user FROM users WHERE DATE(uregdate) = CURDATE()";
$getu = $pdo->query($datau);
if ($rou=$getu->fetch()) {
        
$new_user = $rou['new_user']; 
                           
                         }
$datau = "SELECT count(userid) as total_user FROM users WHERE ustatus = '1'";
$getu = $pdo->query($datau);
if ($rou=$getu->fetch()) {
        
$total_user = $rou['total_user']; 
                           
                         }
$new_u = $total_user;     
if ($total_user === '0') {
    # code...
    $new_u = 1;
}
$uperc = ($new_user / $new_u) * 100;
$uperc = number_format($uperc, 1);                        
                         
if ($uperc < 50) {
    # code...
    $udire = 'down';
}
else
{
    $udire = 'up';
}
                                       
                                        
                                        ?>

                                    <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-purple"><?php echo $uperc; ?>% <i class="fa fa-level-<?php echo $udire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                        <h2 class="text-right no-margin"><?php echo $new_user;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $uperc; ?>%;" class="progress-bar bg-purple"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject text-uppercase"><b>Document Track</b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-grey active">
                                                    <input type="radio" name="options" class="toggle" id="option1" checked="">Today</label>
                                                <label class="btn btn-grey">
                                                    <input type="radio" name="options" class="toggle" id="option2">Week</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="curved-line-chart" class="flot-chart-sts flot-chart curved-chart-statistic"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="white-box analytics-info-cs mg-b-30 res-mg-t-30">
                            <h3 class="box-title">Total Clients</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <li class="text-right sp-cn-r"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter sales-sts-ctn"><?php echo $total_client; ?></span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-30">
                            <h3 class="box-title">Total Lost</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                <li class="text-right"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter sales-sts-ctn"><?php echo $total_lost; ?></span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-30">
                            <h3 class="box-title">Total found</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash3"></div>
                                </li>
                                <li class="text-right"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter sales-sts-ctn"><?php echo $total_found; ?></span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs">
                            <h3 class="box-title">Total users</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash4"></div>
                                </li>                                
                                <li class="text-right"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="sales-sts-ctn"><?php echo $total_user; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="white-box tranffic-als-inner">
                            <?php
$doc = "SELECT count(docid) as alldoc FROM document";
$getdoc = $pdo->query($doc);
if ($rowdoc=$getdoc->fetch()) {
        
$docs = $rowdoc['alldoc']; 
                           
                         }
//last month's docs                         
$ldoc = "SELECT count(docid) as lalldoc FROM document WHERE DATE(docregdate) >  DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$lgetdoc = $pdo->query($ldoc);
if ($lrowdoc=$lgetdoc->fetch()) {
        
$ldocs = $lrowdoc['lalldoc']; 
                           
                         }
                       
//success
//check whether number is certain                         
$sdoc = "SELECT count(docid) as success FROM document WHERE docdeclarer != '0'";
$sgetdoc = $pdo->query($sdoc);
if ($srowdoc=$sgetdoc->fetch()) {
        
$success = $srowdoc['success']; 
                           
                         }

$s = $docs;     
if ($docs === '0') {
    # code...
    $s = 1;
}
$perc = ($success / $s) * 100;
$perc = number_format($perc, 1);   

//last month's success
//check whether number is certain                         
$lsdoc = "SELECT count(docid) as lsuccess FROM document WHERE docdeclarer != '0' AND DATE(docregdate) >  DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$lsgetdoc = $pdo->query($lsdoc);
if ($lsrowdoc=$lsgetdoc->fetch()) {
        
$lsuccess = $lsrowdoc['lsuccess']; 
                           
                         }

$ls = $ldocs;     
if ($ldocs === '0') {
    # code...
    $ls = 1;
}
$lsperc = ($lsuccess / $ls) * 100;
$lsperc = number_format($lsperc, 1);   
if ($lsperc < 50) {
    # code...
    $lsdire = 'desc';
}
else
{
    $lsdire = 'asc';
}

//today's success
//check whether number is certain                         
$tsdoc = "SELECT count(docid) as tsuccess FROM document WHERE docdeclarer != '0' AND DATE(docregdate) = CURDATE()";
$tsgetdoc = $pdo->query($tsdoc);
if ($tsrowdoc=$tsgetdoc->fetch()) {
        
$tsuccess = $tsrowdoc['tsuccess']; 
                           
                         }

$ts = $success;     
if ($success === '0') {
    # code...
    $ts = 1;
}
$tperc = ($tsuccess / $ts) * 100;
$tperc = number_format($tperc, 1);   


//inprogress
//remember to check number
$idoc = "SELECT count(docid) as inpro FROM document WHERE docdeclarer = '0'";
$igetdoc = $pdo->query($idoc);
if ($irowdoc=$igetdoc->fetch()) {
        
$inpro = $irowdoc['inpro']; 
                           
                         }

$in = $docs;     
if ($docs === '0') {
    # code...
    $in = 1;
}
$inperc = ($inpro / $in) * 100;
$inperc = number_format($inperc, 1); 


//last month's inprogress
//remember to check number
$lidoc = "SELECT count(docid) as linpro FROM document WHERE docdeclarer = '0' AND DATE(docregdate) >  DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$ligetdoc = $pdo->query($lidoc);
if ($lirowdoc=$ligetdoc->fetch()) {
        
$linpro = $lirowdoc['linpro']; 
                           
                         }

$lin = $ldocs;     
if ($ldocs === '0') {
    # code...
    $lin = 1;
}
$linperc = ($linpro / $lin) * 100;
$linperc = number_format($linperc, 1); 
if ($linperc < 50) {
    # code...
    $lindire = 'desc';
}
else
{
    $lindire = 'asc';
}

//today's inprogress
//remember to check number
$tidoc = "SELECT count(docid) as tinpro FROM document WHERE docdeclarer = '0' AND DATE(docregdate) = CURDATE()";
$tigetdoc = $pdo->query($tidoc);
if ($tirowdoc=$tigetdoc->fetch()) {
        
$tinpro = $tirowdoc['tinpro']; 
                           
                         }

$tin = $inpro;     
if ($inpro === '0') {
    # code...
    $tin = 1;
}
$tinperc = ($tinpro / $tin) * 100;
$tinperc = number_format($tinperc, 1); 

?>
                            <h3 class="box-title"><small class="pull-right m-t-10 text-success last-month-sc cl-one"><i class="fa fa-sort-<?php echo $lsdire;  ?>"></i> <?php echo $lsperc;  ?>% last month</small> Succeed</h3>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Today</h6>
                                    <b><?php echo $tperc; ?>%</b>
                                </div>
                                <div class="stat-item">
                                    <h6>Overall Percentage</h6>
                                    <b><?php echo $perc; ?>%</b>
                                </div>
                            </div>
                            <div id="sparkline8"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="white-box tranffic-als-inner res-mg-t-30">
                            <h3 class="box-title"><small class="pull-right m-t-10 text-danger last-month-sc cl-two"><i class="fa fa-sort-desc"></i> <?php echo $linperc;  ?>% last month</small>Inprogress</h3>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Today</h6>
                                    <b><?php echo $tinperc; ?>%</b>
                                </div>
                                <div class="stat-item">
                                    <h6>Overall Percentage</h6>
                                    <b><?php echo $inperc; ?>%</b>
                                </div>
                            </div>
                            <div id="sparkline9"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="white-box tranffic-als-inner res-mg-t-30">
                            <h3 class="box-title"><small class="pull-right m-t-10 text-success last-month-sc cl-three"><i class="fa fa-sort-asc"></i> 18% last month</small>Site Traffic</h3>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Overall Growth</h6>
                                    <b>80.40%</b></div>
                                <div class="stat-item">
                                    <h6>Montly</h6>
                                    <b>15.40%</b></div>
                                <div class="stat-item">
                                    <h6>Day</h6>
                                    <b>5.50%</b></div>
                            </div>
                            <div id="sparkline10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php 
}

elseif ($_SESSION['utype'] === 'District') {
    # code...

?>
        <div class="section-admin container-fluid">
            <div class="row admin text-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-15">
                                <h4 class="text-left text-uppercase"><b>New sectors</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                        <?php
$date = date("Y-m-d");
$dis = $_SESSION['userd'];
$data = "SELECT count(userid) as new_sector FROM users WHERE udistrict = $dis AND utype = 'Sector' AND DATE(uregdate) = CURDATE()";
$get = $pdo->query($data);
if ($ro=$get->fetch()) {
        
$new_sector = $ro['new_sector']; 
                           
                         }

//here....

$datats = "SELECT count(userid) as total_sector FROM users WHERE udistrict = $dis AND utype = 'Sector' AND ustatus = '1'";
$getts = $pdo->query($datats);
if ($rots=$getts->fetch()) {
        
$total_sector = $rots['total_sector']; 
                           
                         }


//Get sectors for this district

$tsect = "SELECT count(sectid) as dis_sector FROM sector WHERE district = $dis";
$yes = $pdo->query($tsect);
if ($col=$yes->fetch()) {
        
$dis_sector = $col['dis_sector']; 
                           
                         }
//Percentage

$new_ts = $dis_sector;     
if ($dis_sector === '0') {
    # code...
    $new_ts = 1;
}
$tsperc = ($total_sector / $new_ts) * 100;
$tsperc = number_format($tsperc, 1);                        
                         
if ($tsperc < 50) {
    # code...
    $tsdire = 'down';
}
else
{
    $tsdire = 'up';
}

//perc. for new latest today

$new_s = $total_sector;     
if ($total_sector === '0') {
    # code...
    $new_s = 1;
}
$sperc = ($new_sector / $new_s) * 100;
$sperc = number_format($sperc, 1);                        
                         
if ($sperc < 50) {
    # code...
    $sdire = 'down';
}
else
{
    $sdire = 'up';
}
                                     
                         

       

                                        ?>

                                    <div class="col-xs-3 mar-bot-15 text-left">
                                        <label class="label bg-green"><?php echo $sperc; ?>% <i class="fa fa-level-<?php echo $sdire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                        <h2 class="text-right no-margin"><?php echo $new_sector; ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $sperc; ?>%;" class="progress-bar bg-green"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                                <h4 class="text-left text-uppercase"><b>New Companies</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                  
<?php
$user = $_SESSION['user_id'];
$datao = "SELECT count(userid) as total_org FROM users WHERE ustatus = '1' AND utype = 'Organization' AND reguser = $user";
$geto = $pdo->query($datao);
if ($roo=$geto->fetch()) {
        
$total_org = $roo['total_org']; 
                           
                         }

$dateu = date("Y-m-d");
$datau = "SELECT count(userid) as new_org FROM users WHERE reguser = $user AND utype = 'Organization' AND DATE(uregdate) = CURDATE()";
$getu = $pdo->query($datau);
if ($rou=$getu->fetch()) {
        
$new_org = $rou['new_org']; 
                           
                         }
$new_o = $total_org;     
if ($total_org === '0') {
    # code...
    $new_o = 1;
}
$operc = ($new_org / $new_o) * 100;
$operc = number_format($operc, 1);                        
                         
if ($operc < 50) {
    # code...
    $odire = 'down';
}
else
{
    $odire = 'up';
}
                                 
                                        ?>

                                    <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-purple"><?php echo $operc; ?>% <i class="fa fa-level-<?php echo $odire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                        <h2 class="text-right no-margin"><?php echo $new_org;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $operc; ?>%;" class="progress-bar bg-purple"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                               <h4 class="text-left text-uppercase"><b>Total Companies</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                    <div class="col-xs-3 mar-bot-15 text-left">
                                        <label class="label bg-red">100% <i class="fa fa-level-up" aria-hidden="true"></i></label>
                                    </div>
                                 <div class="col-xs-9 cus-gh-hd-pro">
                                        <h2 class="text-right no-margin"><?php echo $total_org;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: 100%;" class="progress-bar bg-red"></div>
                                </div>
                            </div>
                        </div>
                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                              <h4 class="text-left text-uppercase"><b>Total sectors</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                    <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-blue"><?php echo $tsperc; ?>% <i class="fa fa-level-<?php echo $tsdire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                       <h2 class="text-right no-margin"><?php echo $total_sector;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $tsperc; ?>%;" class="progress-bar bg-blue"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
<?php 
}
else
{
?>
        <div class="section-admin container-fluid">
            <div class="row admin text-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-15">
                                <h4 class="text-left text-uppercase"><b>New found</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                    <div class="col-xs-3 mar-bot-15 text-left">
                                  
<?php
$user = $_SESSION['user_id'];                                        
$date = date("Ymd");
$dataf = "SELECT count(docid) as new_found FROM document WHERE docposter = $user AND docuser = 'Admin' AND docstate = '1' AND DATE(docregdate) = CURDATE()";
$getf = $pdo->query($dataf);
if ($rof=$getf->fetch()) {
        
$new_found = $rof['new_found']; 
                           
                         }

$datatf = "SELECT count(docid) as total_found FROM document WHERE docposter = $user AND docuser = 'Admin' AND docstate = '1'";
$gettf = $pdo->query($datatf);
if ($rotf=$gettf->fetch()) {
        
$total_found = $rotf['total_found']; 
                           
$total_f = $total_found;                         }
if ($total_found === '0') {
    # code...
    $total_f = 1;
}                         
                         
$fperc = ($new_found / $total_f) * 100;
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

                                        <label class="label bg-green"><?php echo $fperc; ?>% <i class="fa fa-level-<?php echo $fdire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                         <h2 class="text-right no-margin"><?php echo $new_found; ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $fperc; ?>%;" class="progress-bar bg-green"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                                <h4 class="text-left text-uppercase"><b>Today's Success</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
<?php
$datats = "SELECT count(docid) as total_succeed FROM document WHERE docposter = $user AND docuser = 'Admin' AND docstate = '1' AND docdeclarer != '0'";
$getts = $pdo->query($datats);
if ($rots=$getts->fetch()) {
        
$total_succeed = $rots['total_succeed']; 
                           
                         }
                         

$datas = "SELECT count(docid) as new_succeed FROM document WHERE docposter = $user AND docuser = 'Admin' AND docstate = '1' AND docdeclarer != '0' AND DATE(docregdate) = CURDATE()";
$gets = $pdo->query($datas);
if ($ros=$gets->fetch()) {
        
$new_succeed = $ros['new_succeed']; 
                           
                    }
$total_s = $total_succeed;     
if ($total_succeed === '0') {
    # code...
    $total_s = 1;
}
$sperc = ($new_succeed / $total_s) * 100;
$sperc = number_format($sperc, 1);                                        

if ($sperc < 50) {
    # code...
    $sdire = 'down';
}
else
{
    $sdire = 'up';
}

                             ?>

                                         <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-purple"><?php echo $sperc; ?>% <i class="fa fa-level-<?php echo $sdire; ?>" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">

                                        <h2 class="text-right no-margin"><?php echo $new_succeed;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $sperc; ?>%;" class="progress-bar bg-purple"></div>
                                </div>
                            </div>
                        </div>
                   
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                              <h4 class="text-left text-uppercase"><b>Total Found</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                    <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-red">100% <i class="fa fa-level-up" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">
                                     <h2 class="text-right no-margin"><?php echo $total_found;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: 100%;" class="progress-bar bg-red"></div>
                                </div>
                            </div>
                        </div>

                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                              <h4 class="text-left text-uppercase"><b>Total Succeed</b></h4>
                                <div class="row vertical-center-box vertical-center-box-tablet">
                                    <div class="text-left col-xs-3 mar-bot-15">
                                        <label class="label bg-blue">100% <i class="fa fa-level-up" aria-hidden="true"></i></label>
                                    </div>
                                    <div class="col-xs-9 cus-gh-hd-pro">

                                        <h2 class="text-right no-margin"><?php echo $total_succeed;  ?></h2>
                                    </div>
                                </div>
                                <div class="progress progress-mini">
                                    <div style="width: 100%;" class="progress-bar bg-blue"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
      <?php
}

?>
 
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
     