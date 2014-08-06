<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title<?php
        if (isset($title)) {
            echo $title;
        } else {
            echo $this->config->item('SITE_NAME');
        }
        ?></title>
        <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/font.css" type="text/css" cache="false" />
        <link rel="stylesheet" href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/plugin.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/css/app.css" type="text/css" />
        <!--[if lt IE 9]>
          <script src="js/ie/respond.min.js" cache="false"></script>
          <script src="js/ie/html5.js" cache="false"></script>
          <script src="js/ie/fix.js" cache="false"></script>
        <![endif]-->
    </head>
    <body>
        <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
            <a class="nav-brand" href="<?php echo site_url(); ?>">Dashboard</a>
            <div class="row m-n">
                <div class="col-md-4 col-md-offset-4 m-t-lg">
                    <section class="panel">
                        <header class="panel-heading text-center">
                            Sign in
                        </header>
                        <?php
                        $attributes = array('class' => 'panel-body', 'id' => 'loginFormValidate', 'name' => 'loginFormValidate', 'enctype' => 'multipart/form-data');
                        echo form_open('', $attributes);
                        ?>
                        <?php echo $this->ci_alerts->display('error'); ?><?php echo $this->ci_alerts->display('success'); ?>  <?php echo $message;?>    
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <?php echo form_input($identity);?>
                            <?php echo form_error('identity'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <?php echo form_input($password);?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Keep me logged in
                            </label>
                        </div>
                        <a href="<?php echo site_url(); ?>" class="pull-right m-t-xs"><small>Forgot password?</small></a>
                        <?php echo form_submit('submit', 'Sign in', 'class="btn btn-info"');?>
                        <div class="line line-dashed"></div>                            
                        <div class="line line-dashed"></div>
                        <p class="text-muted text-center"><small>Do not have an account?</small></p>
                        <a href="<?php echo site_url(); ?>" class="btn btn-white btn-block">Create an account</a>
                        <?php echo form_close();?>
                    </section>
                </div>
            </div>
        </section>
        <!-- footer -->
        <footer id="footer">
            <div class="text-center padder clearfix">
                <p>
                    <small><?php echo $this->config->item('COPY_RIGHT'); ?></small>
                </p>
            </div>
        </footer>
        <!-- / footer -->
        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/bootstrap.js"></script>
        <!-- app -->
        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/app.js"></script>
        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/app.plugin.js"></script>
        <script src="<?php echo base_url($this->config->item('BACKEND_ASSETS')); ?>/js/app.data.js"></script>
    </body>
</html>