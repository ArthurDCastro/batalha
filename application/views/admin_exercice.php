   <!--CONTATOS-->
    <div class="row">
        <div class="col-md-12">

            <!-- Conteúdo -->
            <div class="table-responsive">
                <table class="table" style="max-width: 90%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Exercicio</th>
                        <th>Status</th>
                        <th>Tempo</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exercises as $exer): ?>
                            <tr>
                                <th scope="row"><?=$exer['id_exercise']?></th>
                                <td>            <?=$exer['exercise']?></td>
                                <td>            <?=$exer['status']?></td>
                                <td>            <?=$exer['deadline']/60?>minutos</td>
                                <td><a type="button" class="btn btn-warning" href="index.php?acao=editar&id=1">X</a></td>
                                <td><a type="button" class="btn btn-danger" href="contralador_agenda.php?acao=exclui&id=2">X</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php

    print_r($exercises);