<?php
session_start();
include 'connect.php';

 if (!isset($_SESSION['ulogged_in'])) {
     # code...
    header("Location:logout.php");
 }
 if (isset($_SESSION['ulocked']) AND $_SESSION['ulocked']==1) {
     # code...
    header("Location: lock.php");
 }

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $url; // Outputs: Full URL
$_SESSION['URL'] = $url;

$user = $_SESSION['user_id'];                                        
$dataf = "SELECT ustatus FROM users WHERE userid = $user";
$getf = $pdo->query($dataf);
if ($rof=$getf->fetch()) {
    if ($rof['ustatus'] == 0) {
        # code...
        ?>
        <script type="text/javascript">
            alert('You are banned, please contact administrator');
            window.location.href='logout.php';
        </script>
        <?php
    }
}
 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $locname;  ?> | Nomiso - LostDoc <?php echo $usertype;  ?> Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
     <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- nalika Icon CSS
        ============================================ -->
    <link rel="stylesheet" href="css/nalika-icon.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="gritter/css/jquery.gritter.css" />
    
    <!-- modernizr JS
        ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="admin-home.php"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                <strong><img src="img/logo/logosn.png" alt="" /></strong>
            </div>
            <div class="nalika-profile">
                <div class="profile-dtl">
                    <?php 
//display user avatar
$mid = $_SESSION['user_id'];
$lisa = "SELECT uphoto FROM users WHERE userid=$mid";
$resa = $pdo->query($lisa);
if ($rowa=$resa->fetch()) {
    if ($rowa['uphoto'] !== '') {
        # code...
        ?>
     <a href="#"><img src="<?php echo $rowa['uphoto'];  ?>" alt="" /></a>
     <?php 
    }
    else
    {
        ?>
 <a href="#"><img src="avatar/none.jpg" alt="" /></a>
        <?php
    }
    
} 
                    ?>
                   
                    <h2><?php 
                    if ($_SESSION['utype'] === 'Organization') {
                        # code...
                        echo $_SESSION['branch'];
                    
                     ?> <span class="min-dtn"><?php 
                     if ($_SESSION['HQ'] === '1') {
                            # code...
                         echo "HQ";
                     }
                     else
                     {
                        echo "Branch";
                     }
                     
                      }
                      elseif ($_SESSION['utype'] === 'District') {
                          # code...
                     $dis = $_SESSION['userd'];
                     //display district name
$lis = "SELECT * FROM district WHERE distid=$dis";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {
    
     echo $roww['distname'];
}                    
                     ?> <span class="min-dtn"><?php 
                    
                        echo "District";
                      
                     
                      }
                      elseif ($_SESSION['utype'] === 'Sector') {
                          # code...
                          //display sector name
                         $sec = $_SESSION['usersect'];
$lis = "SELECT * FROM sector JOIN district ON district.distid = sector.district WHERE sector.sectid=$sec";
$res = $pdo->query($lis);
if ($roww=$res->fetch()) {

     echo $roww['sectname'];
}                         
                     
                    
                     ?> <span class="min-dtn"><?php 
                    
                        echo "Sector";
                      
                     
                      }
                      else
                      {
                         echo "Super";                    
                     ?> <span class="min-dtn"><?php 
                    
                        echo "Admin";
                      
                     
                      }
                      ?></span></h2>
                </div>
                 
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                         <?php
                        if ($_SESSION['utype'] === 'Organization' || $_SESSION['utype'] === 'Sector') {
                            # code...
                        
                        ?>
                         <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-download icon-wrap"></i> <span class="mini-click-non">Found</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Add Found Doc" href="found-edit.php"><span class="mini-sub-pro">Add record</span></a></li>
                                <li><a title="View added record" href="found-view.php"><span class="mini-sub-pro">View Added</span></a></li>
                                 
                            </ul>
                        </li>

                        <?php
                        if (isset($_SESSION['HQ']) && $_SESSION['HQ'] === '1') {
                            # code...
                            ?>
                               <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-sitemap icon-wrap"></i> <span class="mini-click-non">Branches</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Add branch" href="branch-edit.php"><span class="mini-sub-pro">Add new</span></a></li>
                                <li><a title="View branches" href="branch-view.php"><span class="mini-sub-pro">View added</span></a></li>
                            </ul>
                        </li>
                            <?php
                        }
                    }
                        if ($_SESSION['utype'] === 'Super') {
                            # code...
                        
                        ?>
                      <li>
                            <a title="View clients" href="client-view.php"><i class="icon nalika-user icon-wrap"></i> <span class="mini-click-non">Clients</span></a>
                             
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-folder icon-wrap"></i> <span class="mini-click-non">Documents</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="View found" href="found-admin.php"><span class="mini-sub-pro">Found</span></a></li>
                                <li><a title="View lost" href="lost-admin.php"><span class="mini-sub-pro">Lost</span></a></li>
                            </ul>
                        </li>
                         <li>
                            <a title="View Sectors" href="sector-admin.php"><i class="icon nalika-desktop icon-wrap"></i> <span class="mini-click-non">Sectors</span></a>
                             
                        </li>
                        <?php
                        
                        } 
                        if ($_SESSION['utype'] === 'District') {
                            # code...
                         
                        ?>
                         <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-desktop icon-wrap"></i> <span class="mini-click-non">Sectors</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Add sector" href="sector-edit.php"><span class="mini-sub-pro">Add new</span></a></li>
                                <li><a title="View Sectors" href="sector-view.php"><span class="mini-sub-pro">View added</span></a></li>
                            </ul>
                        </li>
                         <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-favorites icon-wrap"></i> <span class="mini-click-non">Companies</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Add company" href="org-edit.php"><span class="mini-sub-pro">Add new</span></a></li>
                                <li><a title="View companies" href="org-view.php"><span class="mini-sub-pro">View added</span></a></li>
                            </ul>
                        </li>
                        <?php
                    }
                        ?>
                        <li>
                            <a href="#" aria-expanded="false"><i class="icon nalika-forms icon-wrap"></i> <span class="mini-click-non">Report</span></a>
                             
                        </li>
                          <?php
                        if ($_SESSION['utype'] === 'Super') {
                            # code...
                        
                        ?>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-settings icon-wrap"></i> <span class="mini-click-non">Settings</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Document setting" href="doc-type.php"><span class="mini-sub-pro">Document Type</span></a></li>
                                <li><a title="User setting" href="users.php"><span class="mini-sub-pro">Users</span></a></li>
                                                                 
                            </ul>
                        </li>
                         <?php
                     }
                         ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="admin-home.php"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="icon nalika-menu-task"></i>
                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n hd-search-rp">
                                            <div class="breadcome-heading">
                                                <form role="search" class="">
                                                    <input type="text" placeholder="Search..." class="form-control">
                                                    <a href=""><i class="fa fa-search"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item dropdown">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="icon nalika-mail" aria-hidden="true"></i><span class="indicator-ms"></span></a>
                                                    <div role="menu" class="author-message-top dropdown-menu animated zoomIn">
                                                        <div class="message-single-top">
                                                             <h1>Message</h1>
                                                        </div>
<?php
$mi=$_SESSION['user_id'];
$li="SELECT * FROM message WHERE msg_receiver=$mi order by msg_date DESC limit 10";
$resul=$pdo->query($li);
?>

                                                        <ul class="message-menu">
<?php
if ($resul->rowCount()>0) {
    # code...

while ($ro=$resul->fetch(PDO::FETCH_ASSOC)) {
    # code...
$user = $ro['msg_user'];
$sender = $ro['msg_sender'];

$listo = "SELECT * FROM client WHERE clid=$sender";
$resulto = $pdo->query($listo);
while ($rowo=$resulto->fetch()) {
        
$name = $rowo['clfname'];  
}
  
?>  

                                                            <li>
                                                                <a href="admin-message.php?rec_id=<?php echo $sender;  ?>">
                                                                    <div class="message-img">
                                                                        
          <?php 
//display user avatar
$clid = $sender;
$lisa = "SELECT clphoto FROM client WHERE clid=$clid";
$resa = $pdo->query($lisa);
if ($rowa=$resa->fetch()) {
    if ($rowa['clphoto'] !== '') {
        # code...
        ?>
     <img width="90" height="90" src="<?php echo "../".$rowa['clphoto'];  ?>" alt="" />
     <?php 
    }
    else
    {
        ?>
 <img src="avatar/none.jpg" alt="" />
        <?php
    }
    
} 
   ?>

                                                                    </div>
                                                                    <div class="message-content">
                                                                        <span class="message-date">
 <?php
                                     $thatd=strtotime($ro['msg_date']);
                                     if (date('Y-m-d')===date('Y-m-d',$thatd)) {
                                         # code...
                                        echo date('H:i',$thatd);
                                     }
                                     else
                                     {
                                         echo date("d M",$thatd); 
                                     }
                                      
                                     ?>
                                                                        </span>
                                                                        <h2><?php echo $name;  ?></h2>
                                                                        <p><?php echo $ro['msg_content'];  ?></p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            

 <?php
 }
}
else
{
    echo '<li><div class="message-content"><p><i>No message yet!</i></p></div></li>';
}
?>
                                                        </ul>
                                                        <div class="message-view">
                                                            <a href="message-view.php">View All Messages</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="icon nalika-alarm" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                        <div class="notification-single-top">
                                                            <h1>Notifications</h1>
                                                        </div>
<?php
$mine = $_SESSION['user_id'];
$list = "SELECT * FROM notification WHERE notuser = 'Admin' && notsender=$mine || notreceiver=$mine order by nottime DESC limit 10";
$result = $pdo->query($list);
?>
                                                       <ul class="notification-menu">
<?php
if ($result->rowCount()>0) {
    # code...

while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
    # code...


?>                                                      
                                                            <li>
                                                                <a href="document-view.php?docid=<?php echo $row['notdoc'];?>">
                                                                    <div class="notification-icon">
                                                                        <i class="icon nalika-tick" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="notification-content">
                                                                        <span class="notification-date">2 mins ago</span>
                                                                        <h2>
                         <?php
 if ($row['notreceiver']===$mine) {
 # code...

$yours=$row['notsender'];
$list2 = "SELECT * FROM client WHERE clid=$yours";
$result2 = $pdo->query($list2);
while ($row2=$result2->fetch()) {
        
echo $row2['clfname']; 
                           
                         }

}
else
{
$yours=$row['notreceiver'];
$list2 = "SELECT * FROM client WHERE clid=$yours";
$result2 = $pdo->query($list2);
while ($row2=$result2->fetch()) {
        
echo $row2['clfname']; 
                           
                         }
 
}
                          ?>
                                                                       
                                                                    </h2>
                                                                        <p>
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
                                                                    </p>
                                                                    </div>
                                                                </a>
                                                            </li>
 <?php
 }
}
else
{
    echo '<li><div class="notification-content"><p><i>No notification</i></p></div></li>';
}
?>                                                           
                                                        </ul>
                                                        <div class="notification-view">
                                                            <a href="notification-view.php">View All Notification</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <span class="admin-name"><?php echo $_SESSION['user_name'];  ?></span>
                                                            <i class="icon nalika-user"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        
                                                        <li><a href="admin-profile.php"><span class="icon nalika-user author-log-ic"></span> My Profile</a>
                                                        </li>
                                                        <li><a href="lock.php"><span class="icon nalika-diamond author-log-ic"></span> Lock</a>
                                                        </li>
                                                        <li><a href="#"><span class="icon nalika-settings author-log-ic"></span> Settings</a>
                                                        </li>
                                                        <li><a href="logout.php"><span class="icon nalika-unlocked author-log-ic"></span> Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="icon nalika-down-arrow"></i></a>

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                            <li class="active"><a data-toggle="tab" href="#Notes">News</a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Projects">Activity</a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Settings">Settings</a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content custom-bdr-nt">
                                                            <div id="Notes" class="tab-pane fade in active">
                                                                <div class="notes-area-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="icon nalika-chat"></i> Latest News</h2>
                                                                        <p>You have 10 New News.</p>
                                                                    </div>
                                                                    <div class="notes-list-area notes-menu-scrollbar">
                                                                        <ul class="notes-menu-list">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/4.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/1.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/2.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/3.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/4.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/1.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/2.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/1.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/2.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/3.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="Projects" class="tab-pane fade">
                                                                <div class="projects-settings-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="icon nalika-happiness"></i> Recent Activity</h2>
                                                                        <p> You have 20 Recent Activity.</p>
                                                                    </div>
                                                                    <div class="project-st-list-area project-st-menu-scrollbar">
                                                                        <ul class="projects-st-menu-list">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New User Registered</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">1 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order Received</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">2 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order Received</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">3 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order Received</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">4 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New User Registered</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">5 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">6 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New User</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">7 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">9 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="Settings" class="tab-pane fade">
                                                                <div class="setting-panel-area">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="icon nalika-gear"></i> Settings Panel</h2>
                                                                        <p> You have 20 Settings. 5 not completed.</p>
                                                                    </div>
                                                                    <ul class="setting-panel-list">
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Show notifications</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                                                                            <label class="onoffswitch-label" for="example">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Disable Chat</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                                                                            <label class="onoffswitch-label" for="example3">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Enable history</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                                                                            <label class="onoffswitch-label" for="example4">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Show charts</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                                                                            <label class="onoffswitch-label" for="example7">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Update everyday</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example2">
                                                                                            <label class="onoffswitch-label" for="example2">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Global search</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example6">
                                                                                            <label class="onoffswitch-label" for="example6">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Offline users</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example5">
                                                                                            <label class="onoffswitch-label" for="example5">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>