<?php include 'header.php'; ?>

<div class="container-fluid">

    <div class="row">


        <div class="col-md-12">
            <div id="ranking" class="panel panel-default">
                <div class="panel-heading" style="background: #fff">
                    <h3 class="panel-title">Ranking</h3>
                </div>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#Posicao</th>
                        <th class="text-center">Equipe</th>
                        <th class="text-center">Participante</th>
                        <th class="text-center">Pontos Conquistados</th>
                        <th class="text-center">Casos de teste resolvidos</th>
                        <th class="text-center">Exercícios enviados</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ranking as $key => $user): ?>

                            <tr>
                                <td class="text-center">#<?=$key+1?></td>
                                <td class="text-center"><span class="avatar" style="background: url('<?=base_url('assets/logos/'.$this->users_model->get_user_by_id($user['id'])['equipe'].'.jpg')?>');"></span></td>
                                <td class="text-center"><?=ucfirst($this->users_model->get_user_by_id($user['id'])['username']);?></td>
                                <td class="text-center"><?=$user['pts']?></td>
                                <td class="text-center"><?=$user['test_solveds'].'/'.$user['test_cases']?></td>
                                <td class="text-center"><?=$user['solveds']?></td>

                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

