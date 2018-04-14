

<div class="row" style="margin:-100px 0 20px 0">
    <div class="col-md-12" >

        <h1>Página do Administrador</h1>

        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                <tr>
                    <th class="text-center">Total de Usuários</th>
                    <th class="text-center">Usuários Ativos</th>
                    <th class="text-center">Total de Exercícios</th>
                    <th class="text-center">Rodada Atual</th>
                </tr>
                </thead>
                <tbody>

                        <td><?= count($users) ?></td>
                        <td><?= $ativos ?></td>
                        <td><?= count($exercises) ?></td>
                        <td><?= $rodada_atual ?></td>
                </tbody>
            </table>
        </div>

        <?php include "rodadas.php";?>

        <?php if($rodada_andamento): ?>
            <button type="button" class="btn btn-danger">Finalizar Roda</button>
        <?php else: ?>
            <button type="button" class="btn btn-primary">Iniciar Rodada</button>
        <?php endif; ?>

    </div>
</div>