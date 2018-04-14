<!--CONTATOS-->


<div class="row" style="margin-top:-100px">
    <div class="col-md-12" >

        <h1>Controlador de Exercícios</h1>

        <!-- Conteúdo -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Exercicio</th>
                    <th>Status</th>
                    <th>Tempo</th>
                    <th>Nível</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($exercises as $exer): ?>
                    <tr>
                        <th scope="row"><?=$exer['id_exercise']?></th>
                        <td>            <?=$exer['exercise']?></td>
                        <td>            <span class="label label-success"><?=$exer['status']?></span></td>
                        <td>            <?=$exer['deadline']/60?>minutos</td>
                        <td>            <?=$exer['nivel']?></td>
                        <td><a type="button" class="btn btn-warning" href="<?=base_url("/admin/edit_exercise_view?id={$exer['id_exercise']}")?>"><span class="fa fa-pencil"></span></a></td>
                        <td><a type="button" class="btn btn-danger" href="<?=base_url("/admin/remove_exercise?id={$exer['id_exercise']}")?>"><span class="fa fa-remove"></span></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <h2>Adicionar Exercício <a href="<?=base_url("/admin/add_exercise_view")?>" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a></h2>

        </div>
    </div>
</div>