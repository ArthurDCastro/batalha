<?php include "header.php"; ?>
<?php foreach ($table as $key => $tb): ?>

    <?php if ($rodada_andamento & $rodada_atual == $tb['rodada']): ?>
        <h3>
            <?= $tb['rodada'] ?>
        </h3>
        <form class="form" action="<?= base_url('admin/finalizar_rodada'); ?>">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th>Exercício</th>
                        <th class="text-center">Equipe</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">vs</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Equipe</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tb['confrontos'] as $conf): ?>
                        <div class="form-group">
                            <tr>
                                <th><?=$conf['exercicio']?></th>
                                <td>
                                    <span class="label label-<?=$conf['confronto'][0]['equipe']?>"><?=$conf['confronto'][0]['equipe']?></span>
                                </td>
                                <td><?= $conf['confronto'][0]['username'] ?></td>
                                <td>x</td>
                                <td><?= $conf['confronto'][1]['username'] ?></td>
                                <td>
                                    <span class="label label-<?=$conf['confronto'][1]['equipe']?>"><?=$conf['confronto'][1]['equipe']?></span>
                                </td>
                            </tr>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </form>

    <?php elseif($rodada_atual != $tb['rodada'] or (!$rodada_andamento and $rodada_atual == $tb['rodada'])): ?>
        <h3><?= $tb['rodada'] ?></h3>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                <tr>
                    <th>Exercício</th>
                    <th class="text-center">Equipe</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Tempo</th>
                    <th class="text-center">Aproveitamento</th>
                    <th class="text-center">vs</th>
                    <th class="text-center">Aproveitamento</th>
                    <th class="text-center">Tempo</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Equipe</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tb['confrontos'] as $conf): ?>
                    <tr>
                        <th><?= $conf['exercicio'] ?></th>
                        <td>
                            <span class="label label-<?= $conf['confronto'][0]['equipe'] ?>"><?= $conf['confronto'][0]['equipe'] ?></span>
                        </td>
                        <td><?= $conf['confronto'][0]['username'] ?></td>
                        <td><?= $conf['confronto'][0]['tempo_exec']/60 ?>min</td>
                        <td><?= $conf['confronto'][0]['aproveitamento']*100 ?>%</td>
                        <td>x</td>
                        <td><?= $conf['confronto'][1]['aproveitamento']*100 ?>%</td>
                        <td><?= $conf['confronto'][1]['tempo_exec']/60 ?>min</td>
                        <td><?= $conf['confronto'][1]['username'] ?></td>
                        <td>
                            <span class="label label-<?= $conf['confronto'][1]['equipe'] ?>"><?= $conf['confronto'][1]['equipe'] ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
<?php
    endforeach;
include "footer.php";
?>