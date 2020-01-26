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

        <?php if($getResult): ?>

            <?php foreach ($getResult as $result): ?>

                <tr>
                    <td> <?= $result->getId() ?> </td>
                    <td <?php if( $result->getIdestado()->getId() != 4 ) echo 'style="color:#217EBD;"'?> ><?= $result->getName() ?> <?= $result->getFirstName() ?> <?= $result->getLastName() ?></td>
                    <td> <?= $result->getTelephone() ?> </td>
                    <td> <?= $result->getDocumentNumber() ?> </td>

                    <?php if($rol != 4): ?>

                        <td> <?= $result->getIdusuario()->getNombre() ?> <?= $result->getIdusuario()->getApellidos() ?> </td>

                    <?php endif ?>


                    <?php if($rol == 1): ?>

                        <td>
                            <a title="Editar" href="<?= site_url($path.'/edit/'.$result->getId()) ?>" class="btn yellow" type="button"><i class=" icon-pencil "></i></a>
                            <!--<a title="Eliminar" href="<?= site_url($path.'/delete/'.$result->getId()) ?>" class="btn red" type="button"><i class="icon-trash "></i></a>-->
                        </td>

                    <?php elseif($rol == 4): ?>

                        <?php if(compare_dates($result->getFregistro()->format("d-m-Y"),date("d-m-Y")) == 0): ?>

                            <td>
                                <a title="Llamar" href="<?= site_url($path.'/view/'.$result->getId()) ?>" class="btn blue" type="button"><i class=" icon-call-end "></i></a>
                            </td>

                        <?php else: ?>

                            <td>

                                <a title="Llamar" href="<?= site_url($path.'/view/'.$result->getId()) ?>" class="btn grey" type="button"><i class=" icon-call-end "></i></a>

                            </td>

                        <?php endif ?>

                    <?php endif ?>

                </tr>

            <?php endforeach ?>

        <?php endif ?>

    </tbody>

</table>