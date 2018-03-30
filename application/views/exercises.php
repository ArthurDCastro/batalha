<?php include 'header.php'; ?>

<div class="container-fluid">



    <div class="row">
    <div class="col-md-12">
        <h2>Bem vindo <?=$user['username'];?></h2>
    </div>
        <div class="col-md-3">

            <div class="panel test-cases-result" style="text-align: center; background: #fff; color: #101010; text-shadow: none;">
                <img src="<?=base_url('assets/logos/'.$user['equipe'].'.jpg')?>" alt="" width="100%" height="auto">


                <?php if(isset($ranking['pts'])): ?>
                <h1 style="font-size: 60px; margin-top: 0"><?=(!empty($ranking['pos'])?$ranking['pos']: 0)?> &#186; lugar</h1>
                <span><?=$ranking['pts']?> pts conquistados</span>
                <?php endif; ?>
                <br><br>
            </div>

        </div>

        <div class="col-md-9">
            <div id="secExercises" class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Exercícios</h3>
                </div>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Exercício</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Casos Corretos</th>
                            <th class="text-center">Prazo de Entrega</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($exercises as $exercise): if(in_array($user['username'], $exercise['fight'])): ?>

                        <tr>
                            <td><?=$exercise['exercise']?></td>
                            <?php if ($exercise['deadline'] < time()):?>
                            <td class="text-center"><span class="label label-danger">encerrado</span></td>
                            <?php else:?>
                            <td class="text-center"><span class="label label-success">aberto</span></td>
                            <?php endif;?>

                            <td class="text-center"><span class="label label-info"><?= $exercise['solved']['message']?></span></td>
                            <td class="text-center"><?= $exercise['deadline']   ?></td>
                            <td class="text-center">
                                <a href="<?= base_url("code/exercicio/".$exercise['func_name']) ?>" class="btn btn-sm">Codificar!</a>
                            </td>
                        </tr>

                        <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

