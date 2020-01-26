<?php foreach ($getFolders as $key => $folder): ?>

    <div id="folder-<?= $folder->getId() ?>" class="col-md-2 icon-sistem">

        <a>
            <i id="<?= $folder->getId() ?>" class="fa fa-folder-o tooltipFolder" aria-hidden="true"></i>
        </a>
        <div>

            <div id="<?= $folder->getId() ?>" class="show-input-nombre" style="margin-top: 10px;"><?= $folder->getNombre() ?></div>

            <input style="display:none;" class="md-text content-nombre show-input-nombre-<?= $folder->getId() ?>" table="carpetas" field="nombre" key="<?= $folder->getId() ?>" type="text" value="<?= $folder->getNombre() ?>">

        </div>

        <ul id="dropdown-menu<?= $folder->getId() ?>" class="dropdown-menu">

	        <li><a href="<?= site_url('archivador?folder='.$folder->getId()) ?>" > Acceder</a></li>

             <?php if($rol == 6 OR $rol == 9): ?>

    	        <li><a id="<?= $folder->getId() ?>" class="deleteFolder" > Eliminar</a></li>
    	        
             <?php endif ?>

             <li><a id="<?= $folder->getId() ?>" class="close-tip"> Cerrar</a></li>

        </ul>
        

    </div>

<?php endforeach ?>

<?php if(isset($getAttachments)): ?>

    <?php if($getAttachments): ?>

        <?php foreach ($getAttachments as $key => $attach): ?>
            
            <div id="file-<?= $attach->getId() ?>" class="col-md-1 icon-sistem">

                <a>
                    <i id="<?= $attach->getId() ?>" class="fa fa-file-o tooltipFolder" aria-hidden="true"></i>
                </a>

                <div style="margin-top: 10px;"><?= alt($attach->getAttached()) ?></div>

                <ul id="dropdown-menu<?= $attach->getId() ?>" class="dropdown-menu">

                    <li><a target="_blank" href="<?= base_url('assets/attachments_archivador/'.$attach->getAttached()) ?>" > Ver</a></li>

                    <?php if($rol == 6 OR $rol == 9): ?>

                        <li><a id="<?= $attach->getId() ?>" class="deleteFile" > Eliminar</a></li>

                    <?php endif ?>

                    <li><a id="<?= $attach->getId() ?>" class="close-tip"> Cerrar</a></li>

                </ul>

            </div>

        <?php endforeach ?> 

    <?php endif ?>

<?php endif ?>  
