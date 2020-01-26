<?php if($rol == 8): ?>

    <div class="tab-content">

        <div id="cierres" class="tab-pane fade active in">

            <table class="table table-bordered table-striped table-condensed flip-content">

                <thead class="flip-content">

                    <tr>

                        <?php foreach ($thead as $th): ?>
                            <th width="20%"> <?= $th ?> </th>
                        <?php endforeach ?>
                        <th width="20%">Acciones</th>

                    </tr>

                </thead>

                <tbody> 

                <?php foreach ($getResult as $key => $result): ?>

                    <tr>
                        <td> <?= $result->getId() ?> </td>
                        <td> <?= $result->getIdcliente()->getNombre() ?> </td>
                        <td> <?= $result->getIdusuariofrom()->getNombre() ?> <?= $result->getIdusuariofrom()->getApellidos() ?> </td>
                        <td> <?= $result->getFalta()->format("d/m/Y") ?> </td>
                        <td>
                            <a title="Ver" href="<?= site_url($path.'/edit/'.$result->getId()) ?>" class="btn green" type="button"><i class=" icon-eye"></i></a>
                        </td>

                    </tr>

                <?php endforeach ?>

            </tbody>

            </table>

        </div>

        <div id="coberturas" class="tab-pane">
            
            <table class="table table-bordered table-striped table-condensed flip-content">

                <thead class="flip-content">

                    <tr>

                        <?php foreach ($thead as $th): ?>
                            <th width="20%"> <?= $th ?> </th>
                        <?php endforeach ?>
                        <th width="20%">Acciones</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php foreach ($getCoberturas as $key => $result): ?>

                        <tr>
                            <td> <?= $result->getId() ?> </td>
                            <td> <?= $result->getIdcliente()->getNombre() ?> </td>
                            <td> <?= $result->getIdusuariofrom()->getNombre() ?> <?= $result->getIdusuariofrom()->getApellidos() ?> </td>
                            <td> <?= $result->getFalta()->format("d/m/Y") ?> </td>
                            <td>
                                <a title="Ver" href="<?= site_url($path.'/edit/'.$result->getId()) ?>" class="btn green" type="button"><i class=" icon-eye"></i></a>
                            </td>

                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>

        </div>


    </div>

<?php else: ?>

<table class="table table-bordered table-striped table-condensed flip-content">

    <thead class="flip-content">

        <tr>

            <?php foreach ($thead as $th): ?>
                <th width="20%"> <?= $th ?> </th>
            <?php endforeach ?>
            <th width="20%">Acciones</th>

        </tr>

    </thead>

        <tbody> 

            <?php foreach ($getResult as $key => $result): ?>

                <tr>
                    <td> <?= $result->getId() ?> </td>
                    <td> <?= $result->getIdcliente()->getNombre() ?> </td>
                    <td> <?= $result->getIdusuariofrom()->getNombre() ?> <?= $result->getIdusuariofrom()->getApellidos() ?> </td>
                    <td> <?= $result->getFalta()->format("d/m/Y") ?> </td>
                    <td>
                        <a title="Ver" href="<?= site_url($path.'/edit/'.$result->getId()) ?>" class="btn green" type="button"><i class=" icon-eye"></i></a>
                    </td>

                </tr>

            <?php endforeach ?>

        </tbody>

    </thead>

</table>

<?php endif ?>