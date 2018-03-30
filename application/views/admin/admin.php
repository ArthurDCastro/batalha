<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Instituto Federal Catarinense</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/adminStyle.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css')?>">

</head>
<body style="max-width:88%">

<div id="sidebar-wrapper">
    <nav id="spy">
        <ul class="sidebar-nav nav" >
            <li class="sidebar-brand">
                <a href="#home"><span class="fa fa-home solo">Admin</span></a>
            </li>

            <li>
                <a href="<?=base_url()?>">
                    Exercícios
                </a>
            </li>
            <li>
                <a href="<?=base_url('/ranking')?>">
                    Ranking
                </a>
            </li>
            <li>
                <a href="<?=base_url('/table')?>">
                    Table
                </a>
            </li>
            <li>
                <a href="<?=base_url('/admin')?>">
                    <span class="fa fa-edit solo">Controlador de Exercício</span>
                </a>
            </li>
            <li>
                <a href="<?=base_url('/admin/users')?>">
                    <span class="fa fa-user solo">Controlador de Usuários</span>
                </a>
            </li>


            <li><a href="<?=base_url('/users/logout')?>">sair</a></li>
        </ul>
    </nav>
</div>

<div class="container" style="margin-top: 100px;margin-left: 275px;max-width: 90%">
    <!-- Content Goes here-->