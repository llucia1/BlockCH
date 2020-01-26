<div class="page-content">

    <div class="page-head">

        <?= $this->load->view('include/page_head') ?>

    </div>

    <?= $this->load->view('include/page_breadcrumb') ?>

    <div class="m-heading-1 border-green m-bordered">

        <h3>Este es tu espacio para la gestión de archivos</h3>
        <p>En el puedes crear carpetas y subcarpetas, añadir y eliminar archivos.<br/>
            1.Para crear nuevas carpetas sólo tienes que hacer click en el icono <strong>Nueva carpeta</strong>, esto creará una nueva carpeta con el nombre <strong>Nueva carpeta</strong>. Para cambiar el nombre de esta selecciona su nombre con el cursor y escribe su nuevo nombre, este se actualizara automáticamente.<br/>
            2.Dentro de cada carpeta además de crear nuevas carpetas, puedes adjuntar archivos haciendo click en el icono de <strong>Nuevo archivo</strong>, aparecerá una ventana flotante donde podrás seleccionar el archivo y subirlo haciendo click en guardar.<br/>
            3.Haciendo click en un archivo o carpeta se despliega un Tooltip con opciones, entre otras tienes la opción de borrar, tienes que tener en cuenta que este borrado es definitivo, ya que borra el objeto seleccionado del servidor.

        </p>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="portlet light bordered">
                
                <div class="col-md-12">

            	   <?= $breadCrumbs ?>

                </div>
                
                <?php if($rol == 6 OR $rol == 9): ?>

                    <a id="newFolder" data-parent="<?= $parent ?>" class="icon-btn btn-archivador">
                        <i class="fa fa-folder-o" aria-hidden="true"></i>
                        <div> Nueva </div>
                    </a>

                <?php endif ?>
                
                <?php if(isset($_GET['folder'])): ?>

                    <?php if($rol == 6 OR $rol == 9): ?>

                        <a class="icon-btn btn-archivador" data-toggle="modal" data-target="#AttachModal">
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            <div> Nuevo </div>
                        </a>

                    <?php endif ?>

                <?php endif ?>

                <div class="portlet-body flip-scroll">
                       
                    <div class="row">

                        <div id="content-section-archivos" style="margin-top: 35px;" class="col-md-12">
                            
                            <?php if($getFolders OR $getAttachments): ?>

                                <?= $this->load->view('include/folders') ?>  

                            <?php else: ?>

                                <div class="col-md-12 msn-archivos">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Este apartado está vacío.</div>

                            <?php endif ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->load->view('include/attach_modal') ?>
