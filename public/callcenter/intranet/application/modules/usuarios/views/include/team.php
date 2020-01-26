

<div class="portlet-title">

    <h3>Equipo</h3>

    <form action="<?= site_url('usuarios/addTeam/'.$id) ?>" method="post" style="float: right;" class="form-inline">

         <div class="form-group">

            <label for="exampleInputName2">Usuario</label>

            <select class="form-control" name="usuarios" >

                <?php foreach ($getUsuarios as $key => $usuario): ?>
                    
                    <option value="<?= $usuario->getId() ?>"><?= $usuario->getNombre() ?> <?= $usuario->getApellidos() ?></option>

                <?php endforeach ?>
                
            </select>

         </div>
            
        <div class="form-group">

            <button style="float: right;" class="btn green" name="submit" type="submit"><i class=" icon-plus "></i> Usuario al equipo</button>

        </div>
          
    </form>


</div>

<div class="portlet-body flip-scroll">
    
    <?php if($getRow->getEquipo()): ?>

    <div class="table-scrollable">

        <table class="table table-hover table-light">

            <thead>

                <tr>

                    <th> # </th>

                    <th> Nombre </th>

                    <th> Acciones </th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($getRow->getEquipo() as $key => $equipo): ?>

                    <tr>

                        <td><?= $equipo->getId() ?></td>

                        <td><?= $equipo->getIdusuario()->getNombre() ?> <?= $equipo->getIdusuario()->getApellidos() ?></td>

                        <td>
                            
                            <a href="<?= site_url('usuarios/deleteTeam/'.$id.'/'.$equipo->getId()) ?>" data-original-title="" title=""> <i class="fa fa-trash"></i> </a>

                        </td>

                    </tr>

                <? endforeach ?>

            </tbody>

        </table>


    </div>

    <? else: ?>
    
        <div class="alert alert-warning">
          No tienes ningún usuario asignado a este equipo.
        </div>

    <?php endif ?>

</div>