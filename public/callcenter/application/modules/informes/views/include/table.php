<div class="portlet light bordered">
    
    <div class="portlet-title">

        <div class="caption">
            <i class="icon-notebook  font-red"></i>
            <span class="caption-subject font-red sbold uppercase">Resultado de la consulta</span>
        </div>

        <div class="actions">
            
            <form method="post"  action="<?= site_url('informes/createExcel') ?>">
                <input id="reportFrom" type="hidden" name="reportFrom" value="" />
                <input id="reportTo" type="hidden" name="reportTo" value="" />
                <input id="reportTipo" type="hidden" name="reportTipo" value="" />
                <input id="reportRol" type="hidden" name="reportRol" value="" />
                <input id="reportUser" type="hidden" name="reportUser" value="" />
                <button type="submit" name="submitReport" class="btn grey-salsa"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </form>

        </div>

    </div>

    <div class="portlet-body">
        
        <?php if( $report ): ?>

            <strong> Fechas: </strong> <?= $report['dateRange'] ?>

            <div class="table-scrollable">

                <table class="table table-hover table-light">

                    <thead>

                        <tr>

                            <?php foreach (explode(';', $report['header']) as $key => $value): ?>
                                
                                <th> <?= $value?> </th>

                            <?php endforeach ?>
                         
                        </tr>

                    </thead>

                    <tbody>

                        <?= $report['trTd'] ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="alert alert-danger" role="alert">
              La consulta no arrojo ningún resultado.
            </div>

        <?php endif ?>

    </div>

</div>