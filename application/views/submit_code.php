<?php include 'header.php'; ?>


    <div class="row">
        <div class="col-md-12">

            <?php if (isset($errors)):?>
                <div class="alert alert-danger" role="alert">
                    <p><strong><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Deu ruim:</strong><?=$errors?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="row">

        <!-- Dados do problema-->
        <div class="col-md-7">
            <div class="offerings view panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> <?=$exercise['exercise']?>
                        <span id="countdown" class="label label-success" style="float: right; text-transform: lowercase;"></span>
                    </h3>
                    <hr>
                </div>
                <div class="panel-body">

                    <div class="exercise-description">
                        <?=$exercise['description']?>
                    </div>

                </div>
            </div>
        </div>

        <!-- Envio -->
        <div class="col-md-5">
            <div class="panel test-cases-result">
                <div class="panel-heading" style="background: none !important;"                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     >
                    <h3 class="panel-title"><i class="fa fa-trophy" aria-hidden="true"></i> Casos de Teste</h3>
                </div>
                <div class="panel-body">

                    <h1><?= $solved['message']?></h1>
                    <span style="text-align: center; font-size: 11px;">
                        <p><?= ($solved['date']) ? $solved['date'] : ""; ?></p>
                    </span>

                    <div class="col-md-10 col-md-offset-1">
                        <ul>
                            <li>Selecione um arquivo com a extensão <strong>.php</strong></li>
                            <li>Certifique-se que sua função tem o nome exigido!</li>
                        </ul>

                        <form action="<?= base_url('code/upload/'.$exercise['func_name']) ?>" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="file" name="file" class="form-control">
                            </div>

<!--                            <button type="submit" class="btn btn-danger btn-block disabled" disabled><i class="fa fa-hand-spock-o"></i> submeter!</button>-->
                            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-hand-spock-o"></i> submeter!</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


<script>

    window.onload = (function(){

        var countDownDate = new Date("<?php echo date('M d, Y H:m:s', $exercise['deadline']); ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").setAttribute("class", "label label-danger");
                document.getElementById("countdown").innerHTML = "encerrado";
            }
        }, 1000);

    });
</script>


<?php include 'footer.php'; ?>

