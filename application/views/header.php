<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Instituto Federal Catarinense</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css')?>">

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
<!--            <a class="navbar-brand" href="#">-->
<!--                <img src="--><?//=base_url('assets/logo.png')?><!--" alt="" width="20px">-->
<!--            </a>-->

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Olímpiadas</a></li>
                    <li><a href="<?=base_url()?>">Exercícios</a></li>
                    <li><a href="<?=base_url('/ranking')?>">Ranking</a></li>
                    <li><a href="<?=base_url('/table')?>">Table</a></li>
                    <li><a href="#contact">Dicas</a></li>

                    <?php if($user['equipe'] == 'ifc'): ?>

                        <li><a href="<?=base_url('/admin')?>">Admin</a></li>

                    <?php endif; ?> '
                    
                    <li><a href="<?=base_url('/users/logout')?>">sair</a></li>

                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container" style="margin-top: 100px;">
    <!-- Content Goes here-->