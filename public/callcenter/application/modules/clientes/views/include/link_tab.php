<div class="portlet-title">

    <ul class="nav nav-pills">
		
		<li class="active">

            <a href="#detalleCliente" data-toggle="tab" aria-expanded="true"> Detalle cliente </a>

        </li>

        <li class="">

            <a href="#infoDetallada" data-toggle="tab" aria-expanded="false"> Info detallada </a>

        </li>

        <?php if($rol == 1 OR $rol == 8): ?>

        <li class="">

            <a href="#seguimientoEstado" data-toggle="tab" aria-expanded="false"> Seguimiento Estado </a>

        </li>

        <?php endif ?>

        <li class="">

            <a href="#documentacion" data-toggle="tab" aria-expanded="false"> Documentación </a>

        </li>

        <li class="">

            <a href="#Reportes" data-toggle="tab" aria-expanded="false"> Reportes </a>

        </li>
        
        <?php if($rol == 1 OR $rol == 8): ?>

        <li class="">

            <a href="#Agendar" data-toggle="tab" aria-expanded="false"> Agendar </a>

        </li>

        <?php endif ?>

    </ul>

</div>