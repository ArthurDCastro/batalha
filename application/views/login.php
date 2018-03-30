<!DOCTYPE html>
<html lang="en" class="code-bg clearfix">
<head>
    <meta charset="utf-8">
    <title>Instituto Federal Catarinense</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css')?>">

</head>
<body style="background-color:rgba(0, 0, 0, 0.7);" >

<div class="container">

    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="<?=base_url('assets/logo.png')?>" />
    <form class="form-horizontal" method="post" action="<?= base_url('users/login')?>">
        <fieldset>

            <div class="form-group" style="text-align: center">
                    <?php if(!empty($success_msg)): ?>
                        <p class="statusMsg"><?=@$success_msg ?></p>
                    <?php else: ?>
                        <p class="statusMsg"><?=@$error_msg ?></p>
                    <?php endif; ?>

            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="control-label" for="nome">Equipe</label>
                <input id="nome" name="name" type="text" placeholder="" class="form-control input-md" required="">
                <?php echo form_error('email','<span class="help-block">','</span>'); ?>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="control-label" for="senha">Senha</label>
                <input id="senha" name="password" type="password" placeholder="" class="form-control input-md" required="">
                <?php echo form_error('password','<span class="help-block">','</span>'); ?>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="control-label" for="logar"></label>
                <button id="logar" name="login_submit" value="submited" class="btn btn-warning btn-block">logar!</button>
            </div>
            <span style="text-align: center; display: block;">
                <a href="<?= base_url('/ranking')?>">Acompanhe o ranking</a>
            </span>

        </fieldset>
    </form>
    </div><!-- /card-container -->
</div>



</body>
</html>

