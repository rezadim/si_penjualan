<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log In - SIP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url('themes/plugins'); ?>/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('themes/dist'); ?>/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url('auth/login'); ?>">SIP Online</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign In to your session</p>

                <?php $errors = session()->getFlashdata('errors');?>

                <?php if(!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    Whoops! Ada kesalahan saat input data, yaitu:
                    <ul>
                        <?php foreach($errors as $error): ?>
                        <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>    
                </div>
                <?php endif; ?>

                <?php $error_login = session()->getFlashdata('error_login'); ?>
                <?php if(!empty($error_login)): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center">
                            <?= $error_login; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php 
                $inputs = session()->getFlashdata('inputs'); 
                echo form_open(base_url('auth/proses_login'));
                ?>
                <div class="input-group mb-3">
                    <?php
                    $username = [
                        'type' => 'text',
                        'name' => 'username',
                        'id' => 'username',
                        // 'value' => $inputs['email'],
                        'class' => 'form-control',
                        
                    ];
                    
                    echo form_input($username);

                    ?>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user-alt"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <?php
                    $password = [
                        'type' => 'password',
                        'name' => 'password',
                        'id' => 'password',
                        // 'value' => $inputs['password'],
                        'class' => 'form-control'
                    ];

                    echo form_input($password);
                    
                    ?>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>

                <?= form_close(); ?>


            </div>
        </div>
    </div>
</div>
    
<script src="<?php echo base_url('themes/plugins'); ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('themes/plugins'); ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('themes/dist'); ?>/js/adminlte.min.js"></script>
</body>
</html>