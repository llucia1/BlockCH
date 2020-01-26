<div class="col-md-3">
	
	<div class="portlet light bordered">
		
		<div class="portlet-title">
			
			<div class="caption font-dark">

                <i class="fa fa-user"></i>
                
                <span class="caption-subject bold uppercase"> Opciones</span>
                
            </div>
			
		</div>

		<div class="portlet-body todo-project-list-content" style="height: auto;">
			
            <div class="todo-project-list">
    			
				<form role="form">
					
					<div class="form-group form-md-checkboxes">

						<div class="md-checkbox-inline">
							
							<div class="md-checkbox">

								<input <?php if($get_row['locked'] == 1) echo 'checked' ?> type="checkbox" class="md-check" id="locked" multi="false" key="<?= $id ?>" table="<?= $param ?>" field="locked">

								<label for="locked">
									<span class="inc"></span>
									<span class="check"></span>
									<span class="box"></span> Bloquear</label>
							</div>

						</div>
						
					</div>
					
				</form>
                
            </div>
            
        </div>
		
	</div>
	
</div>