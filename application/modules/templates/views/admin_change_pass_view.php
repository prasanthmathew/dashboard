<!---Chanage password Model -->
<div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog_cstm">
        <div class="modal-content">
            <div class="col-lg-12 login_lock no-padder">
                <header class="panel-heading panel-heading_bb login_head"> Change Password
                    <button type="button" class="close close_cstm" data-dismiss="modal" aria-hidden="true">&times;</button>
                </header>
                <div class="col-lg-12">
                    <div class="col-sm-12 col-md-12"> 
                        <!--<h1 class="text-center login-title">Sign In ABB</h1>-->
                        <div class="account-wall">
                            <form class="form-signin" action="<?php echo site_url(); ?>auth/changePass" name="chngPassValidate" id="chngPassValidate" method="post" >                                                                
                                <div class="alert alert-danger alert_pad" id="region_pass1" style="display:none;"><font>Test</font><a class="close" href="#" data-dismiss="alert">&times;</a></div>
                                <div class="alert alert-success alert_pad" id="region_pass1_succ" style="display:none;"><font>Test</font><a class="close" href="#" data-dismiss="alert">&times;</a></div>
                                <input type="password" id="oldpasswd" name="oldpasswd" class="form-control inputmrg" placeholder="Old Password" required="" >
                                <input type="password" id="newpasswd" name="newpasswd" class="form-control inputmrg" placeholder="New Password" required="" min="8" >
                                <input type="password" id="cnfmpasswd" name="cnfmpasswd" class="form-control inputmrg" placeholder="Confirm Password" required="" equalTo="#newpasswd" >
                                <input type="submit" class="btn btn-lg btn-primary btn-block btn-primary_custome" value="Save Changes" id="chngPassBtn"  > 
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!---Chanage password Model -->