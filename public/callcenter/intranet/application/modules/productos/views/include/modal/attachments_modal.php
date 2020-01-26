<div aria-hidden="true" role="basic" tabindex="-1" id="attachments_modal_<?= $id_attached ?>" class="modal fade" style="display: none;">
	
    <div class="modal-dialog">
    	
        <div class="modal-content">
        	
            <div class="modal-header">
            	
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                
                <h4 class="modal-title">Adjuntar archivos</h4>
                
            </div>
            
            <div class="modal-body">
            	
                <img src="<?= base_url('assets/attachments/'.$attached) ?>" />
            	
           	</div>
           	
            <div class="modal-footer">
            	
                <button data-dismiss="modal" class="btn dark btn-outline" type="button">Cerrar</button>
                
            </div>
            
        </div>
       
    </div>
    
</div>