<div class="tab-pane fade" id="seguimientoEstado">
    
    <div class="row">

        <div class="portlet light">

            <div class="portlet-title">
                
                <div class="col-md-6">

                    <h3>Seguimiento Estado</h3>

                </div>

            </div>

            <div class="portlet-body flip-scroll">

                <div class="row">

                    <div class="col-md-12">

                        <div class="mt-timeline-2">

                        <div class="mt-timeline-line border-grey-steel"></div>

                        <ul class="mt-container">

                            <?php foreach ($getCuentasSeguimiento as $key => $seguimiento): ?>
                                
                                <li class="mt-item">
                                    
                                    <div class="mt-timeline-icon bg-blue-chambray bg-font-blue-chambray border-grey-steel">
                                        <i class="icon-bubbles"></i>
                                    </div>

                                    <div class="mt-timeline-content">

                                        <div class="mt-content-container">

                                            <div class="mt-title">
                                                <h3 class="mt-content-title"><?= $seguimiento->getTipo() ?></h3>
                                            </div>

                                            <div class="mt-author">
                                                <div class="mt-author-notes font-grey-mint"><?= $seguimiento->getFalta()->format('d-m-Y H:i') ?></div>
                                            </div>

                                        </div>

                                    </div>

                                </li>

                            <?php endforeach ?>

                        </ul>
                
                    </div>

                    </div>

                </div>

            </div>

    </div>

</div>

</div>