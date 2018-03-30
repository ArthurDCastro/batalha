   <!--CONTATOS-->
    <div class="row" style="max-width: 90%">
        <div class="col-md-12" style="max-width: 90%">

            <!-- Conteúdo -->
            <div class="table-responsive" style="max-width: 90%">
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