<!--CONTATOS-->


<div class="row" style="margin-top:-100px">
    <div class="col-md-12" >

        <h1>Controlador de Usuários</h1>

        <!-- Conteúdo -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Equipe</th>
                    <th>password</th>
                    <th>Atividade</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?=$user['id']?></th>
                        <td>            <?=$user['username']?></td>
                        <td><span class="label label-<?=$user['equipe']?>"><?=$user['equipe']?></span>
                        </td>
                        <td>            <?=$user['password']?></td>
                        <?php if($user['atividade']):?>
                            <td>            <span class="label label-success">Ativo</span></td>
                        <?php else:?>
                            <td>            <span class="label label-danger">Inativo</span></td>
                        <?php endif; ?>
                        <td><a type="button" class="btn btn-warning" href="<?=base_url("/admin/edit_user_view?id={$user['id']}")?>"><span class="fa fa-pencil"></span></a></td>
                        <td><a type="button" class="btn btn-danger" href="<?=base_url("/admin/remove_user?id={$user['id']}")?>"><span class="fa fa-remove"></span></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <h2>Adicionar Usuário <a href="<?=base_url("/admin/add_user_view")?>" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></a></h2>

        </div>
    </div>
</div>