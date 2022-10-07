<?php
$action = 'Password reset';
include 'client-header.php';
include 'connect.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="col-lg-12">
                            <div class="review-tab-pro-inner">
                <div class="text-center txt-primary" style="color: white;">
                    <h3>Password reset</h3>
                    <p>Provide email or phone you use to login into system </p>
                </div>
                 </div>
             </div>
              <div class="col-md-12"></div>
                <div class="hpanel">
                     
     <!-- Single pro tab start-->
        <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <div class="text-center">
                                <ul id="myTab3" class="tab-review-design">
                                    <li class="active"><a href="#description"><i class="fa fa-key" aria-hidden="true"></i> Fill to reset</a></li>
                                    
                                </ul></div>
                                 <div id="myTabContent" class="tab-content custom-product-edit">
                                    <form method="POST">
                                        <div class="input-group mg-b-15 mg-t-15">
                                        <span class="input-group-addon"><i class="icon nalika-tick" aria-hidden="true"></i></span>
                                       <input type="text" class="form-control" placeholder="Email or Phone">
                                     </div>
                                      <div class="form-group review-pro-edt mg-b-0-pt">
                                           <button type="submit" class="btn btn-ctl-bt waves-effect waves-light">Send
                                             </button>
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
                     
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
        </div>
        <?php
        include 'footer.php';


        ?>