<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<button type="button" class="btn btn-default " id="pop-up" data-toggle="modal" data-target="#modal" style="margin-left:300px">ble</button>

<div class="modal fade bs-example-modal-md" id="modal"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> <!--role="dialog">-->
    <div class="" style="margin: 25px 100px">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a type="button" class="close" href="<?=base_url("/admin")?>">&times;</a>
                <h4 class="modal-title">Editar</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?=base_url("/admin/edit_exercise?id={$exercise['id_exercise']}")?>" method="post">

                            <div class="form-row">
                                <!--nome-->
                                <div class="col form-group col-md-6">
                                    <label for="exercise">Nome</label>
                                    <input type="text" class="form-control" id="exercise" name="exercise" value="<?=$exercise['exercise']?>">
                                </div>

                                <!--Nome da func-->
                                <div class="col form-group col-md-6">
                                    <label for="func_name">Nome da Função</label>
                                    <input type="email" class="form-control" id="func_name" name="func_name" value="<?=$exercise['func_name']?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <!--telefone-->
                                <div class="col form-group col-md-6">
                                    <label for="inputs">Inputs</label>
                                    <input type="text" class="form-control" id="inputs" name="inputs" value="<?=$exercise['inputs']?>">
                                </div>
                                <div class="col form-group col-md-6">
                                    <label for="expecteds">Saidas</label>
                                    <input type="text" class="form-control" id="expecteds" name="expecteds" value="<?=$exercise['expecteds']?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group col-md-6">
                                    <label for="deadline">Tempo</label>
                                    <input type="text" class="form-control" id="deadline" name="deadline" value="<?=$exercise['deadline']?>">
                                </div>
                                <div class="col form-group col-md-6">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" value="<?=$exercise['status']?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group col-md-12" >
                                    <label for="description">Descrição</label> <br>
                                    <textarea class="form-control" rows="5" id="description"  name="description"><?=$exercise['description']?></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary form-group" style="float: right">EDITAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default" href="<?=base_url("/admin")?>">Close</a>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $( "#pop-up" ).on( "click");
    $( "#pop-up" ).trigger( "click" );
</script>