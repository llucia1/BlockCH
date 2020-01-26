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

        <?php foreach ($getResult as $result): ?>

            <tr>
                <td> <?= $result->getId() ?> </td>
                <td> <?= $result->getNombre() ?> </td>
                <td> <?= $result->getPoblacion() ?> </td>
                <td> <?= $result->getTelefono() ?> </td>

                <td> 
                    
                    <?php if($result->getCuentasseguimiento()): ?>

                        <?php foreach ($result->getCuentasseguimiento() as $key => $seguimiento): ?>
                            
                            <?php if($seguimiento->getActual() == 1): ?>
                                
                                <button class="btn btn-danger mt-sweetalert" data-title="Sweet Alerts" data-message="Beautiful popup alerts" data-allow-outside-click="true" data-confirm-button-class="btn-danger"><?= $seguimiento->getTipo() ?></button>

                            <?php endif ?>

                        <?php endforeach ?>


                    <?php else: ?>

                    <button class="btn btn-default mt-sweetalert" data-title="Sweet Alerts" data-message="Beautiful popup alerts" data-allow-outside-click="true" data-confirm-button-class="btn-default">Sin seguiminento</button>


                    <?php endif ?>

                </td>

                <td>

                <?php if($rol == 3): ?>

                    <a title="Ver" href="<?= site_url($path.'/edit/'.$result->getId()) ?>" class="btn green" type="button"><i class=" icon-eye "></i></a>

                <?php else: ?>

                    <a title="Editar" href="<?= site_url($path.'/edit/'.$result->getId()) ?>" class="btn yellow" type="button"><i class=" icon-pencil "></i></a>

                <?php endif ?>

                    <!--<a title="Eliminar" href="<?= site_url($path.'/delete/'.$result->getId()) ?>" class="btn red" type="button"><i class="icon-trash "></i></a>-->
                </td>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>