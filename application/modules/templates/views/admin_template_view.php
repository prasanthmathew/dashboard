<!DOCTYPE html>
<html>
    <head>
        <title><?php
            if (isset($title)) {
                echo $title;
            } else {
                echo $this->config->item('SITE_NAME');
            }
            ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="ABB" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="">
        <link href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/new.css" rel="stylesheet">
        <link href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/print.css" rel="stylesheet">
        <link href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/media.css" rel="stylesheet">
        <link href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/datatable.css" rel="stylesheet">


        <!-- Important. For Theming change primary-color variable in main.css  -->

        <link href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/fonts/font-awesome.min.css" rel="stylesheet">

        <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/html5shiv.js"></script>
          <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/respond.min.js"></script>
        <![endif]-->  

        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/jquery.js"></script> 
        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/bootstrap.min.js"></script> 
        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/jquery.scrollUp.js"></script> 
    </head>

    <body>

        <!-- Header Start -->
        <header class="header_bb"> <a href="<?php echo base_url(); ?>" class="logo"> <img src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/img/logo.png" alt="Logo"/> </a>
            
            <div class="user-profile">            
                <span class="profile_icon">Welcome <?php echo ucfirst($this->session->userdata('name'));?> </span>
                <div class="profile_icon"><img src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/img/Pencil-icon.png" alt="edit"/> <a href="#" data-toggle="modal" data-target="#changePass">Change Password</a></div>
                <div class="profile_icon"><img src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/img/System-Logout-icon.png" alt="logout"/> <a href="<?php echo site_url(); ?>auth/authLogout">Logout</a></div>
            </div>
        </header>
        <!-- Header End --> 

        <!-- Main Container start -->
        <div class="dashboard-container">
            <?php
            if (isset($main_content)) {
                echo $main_content;
            } else {

                echo $this->config->item('SITE_NAME');
            }
            ?>
            <!------------------------//////////////////////////////--------------------->

            <!-- Dashboard Wrapper End -->
            <?php
            if (isset($change_pass_model)) {
                echo $change_pass_model;
            }
            ?>
            <footer <?php echo isset($footer_class) ? $footer_class: "" ;?>>
                <p><?php echo $this->config->item('COPY_RIGHT'); ?></p>
            </footer>

        </div>
    </div>
    <!-- Main Container end --> 



   
    <script type="text/javascript">
//ScrollUp
        $(function() {
            $.scrollUp({
                scrollName: 'scrollUp', // Element ID
                topDistance: '300', // Distance from top before showing element (px)
                topSpeed: 300, // Speed back to top (ms)
                animation: 'fade', // Fade, slide, none
                animationInSpeed: 400, // Animation in speed (ms)
                animationOutSpeed: 400, // Animation out speed (ms)
                scrollText: 'Scroll to top', // Text for element
                activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            });
        });

        //Tooltip
        $('a').tooltip('hide');

        //Popover
        $('.popover-pop').popover('hide');

        //Dropdown
        $('.dropdown-toggle').dropdown();


//        var message = "";
//        function clickIE() {
//            if (document.all) {
//                (message);
//                return false;
//            }
//        }
//        function clickNS(e) {
//            if
//                    (document.layers || (document.getElementById && !document.all)) {
//                if (e.which == 2 || e.which == 3) {
//                    (message);
//                    return false;
//                }
//            }
//        }
//        if (document.layers)
//        {
//            document.captureEvents(Event.MOUSEDOWN);
//            document.onmousedown = clickNS;
//        }
//        else {
//            document.onmouseup = clickNS;
//            document.oncontextmenu = clickIE;
//        }
//
//        document.oncontextmenu = new Function("return false")
    </script>
         
    <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/jquery.validate.js"></script> 
    <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/common.js"></script> 
    <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/bootstrap.file-input.js"></script>
    <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/jquery.md5.js"></script> 
    <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/datatable.js"></script> 

    <script>
        $(document).ready(function(e) {
            $('input[type=file]').bootstrapFileInput();
            $('.file-inputs').bootstrapFileInput();
            $('#actvity_table').dataTable();
            $('#opportunity_table').dataTable();
        });
        //change password

        $("#chngPassValidate").on("submit", function(event) {
            event.preventDefault();
            $("#oldpasswd").val() == "" ? "" : $("#oldpasswd").val($.md5($("#oldpasswd").val()));
            $("#newpasswd").val() == "" ? "" : $("#newpasswd").val($.md5($("#newpasswd").val()));
            $("#cnfmpasswd").val() == "" ? "" : $("#cnfmpasswd").val($.md5($("#cnfmpasswd").val()));
            var frmVals = $("#chngPassValidate").serialize();
            $.ajax({
                url: "<?php echo site_url(); ?>auth/changePass",
                type: "post",
                data: frmVals,
                success: function(data, status) {                    
                    if (status == "success") {
                        var json_obj = $.parseJSON(data);
                        if (json_obj.status) {
                            
                            $(':input', '#chngPassValidate')
                                    .not(':button, :submit, :reset, :hidden')
                                    .val('');
                            $("#region_pass1_succ").html(json_obj.msg);
                            $("#region_pass1_succ").show();
                            $("#region_pass1").hide();
                        }
                        if (!json_obj.status)  {
                            $(':input', '#chngPassValidate')
                                    .not(':button, :submit, :reset, :hidden')
                                    .val('');
                            $("#region_pass1 font").html(json_obj.msg);
                            $("#region_pass1_succ").hide();
                            $("#region_pass1").show();
                        }
                    } else {
                        $(':input', '#chngPassValidate')
                                .not(':button, :submit, :reset, :hidden')
                                .val('');
                        $("#region_pass font").html(json_obj.msg);
                        $("#region_pass_succ").hide();
                        $("#region_pass").show();
                    }
                },
                error: function(jqXHR, textStatus) {
                    $(':input', '#chngPassValidate')
                            .not(':button, :submit, :reset, :hidden')
                            .val('');
                    $("#region_pass font").html('Password is wrong.');
                    $("#region_pass_succ").hide();
                    $("#region_pass").show();

                }
            });

        });
        
        //Region [assword test

        $("#rgnPassValidate").on("submit", function(event) {
            event.preventDefault();
            $("#txtpasswd").val() == "" ? "" : $("#txtpasswd").val($.md5($("#txtpasswd").val()));
            var frmVals = $("#rgnPassValidate").serialize();
            $.ajax({
                url: "auth/checkRegion",
                type: "post",
                data: frmVals,
                success: function(data, status) {
                    if (status == "success") {
                        var json_obj = $.parseJSON(data);
                        if (json_obj.status) {
                            window.location.href = '<?php echo site_url(); ?>dashboard/targetSet';
                        }
                        else {
                            $("#region_pass font").html(json_obj.msg);
                            $("#region_pass").show();
                            $( '#txtpasswd')
                            .val('');
                        }
                    } else {
                        $("#region_pass font").html(json_obj.msg);
                        $("#region_pass").show();
                        $( '#txtpasswd')
                            .val('');
                    }
                },
                error: function(jqXHR, textStatus) {
                    $("#region_pass font").html('E-mail or Password is wrong.');
                    $("#region_pass").show();
                    $( '#txtpasswd')
                            .val('');

                }
            });

        });
    </script>




</body>
</html>