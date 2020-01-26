<div class="col-md-3">
	
	<div class="portlet light bordered">
		
		<div class="portlet-title">
			
			<div class="caption font-dark">

                <i class="fa fa-random font-dark"></i>

                <span class="caption-subject bold uppercase"> RELACIONADOS</span>
                
            </div>
            
            <div class="actions">
 
               <form action="<?= site_url($main_lang.'/'.strtolower(TABLE).'/add_related/'.$id) ?>" id="shoot" method="post" role="form">
               
					<div class="form-body">
						
						<div class="form-group">
								
							<select name="related" class="form-control md-shoot-form" key="<?= $id ?>" table="related_products" field="id_category">
								
								<option value=""></option>
								
								<?php foreach ($get_result as $key => $value): ?>
										
										<?php if($value->is_join != $id): ?>
										
											<option value="<?= $value->is_join ?>"><?= $value->name ?></option>
											
										<?php endif ?>
		
								<?php endforeach ?>

							</select>
							
						</div>
						
					</div>
					
				</form>
				
            </div>
			
		</div>
		
		<div class="portlet-body todo-project-list-content" style="height: auto;">
			
            <div class="table-scrollable">
            	
            	<table class="table table-bordered table-hover">
            		
            		<thead>
            			
            			<tr>
							<th> # </th>
							<th> Producto </th>
							<th>  </th>
						</tr>
            			
            		</thead>
            		
            		<tbody>
            			
            			<?php if ($relacionados): ?>
							
							<?php foreach ($relacionados as $key => $value): ?>
								
								<tr>
            				
		            				<td> <?= $value->is_join ?> </td>
		            				
		            				<td> <?= $value->name ?> </td>
		            				
		            				<td align="center">
		            				
		            					<a href="<?= site_url($main_lang.'/'.strtolower(TABLE).'/delete_related/'.$id.'/'.$value->id) ?>" class="btn btn-circle btn-icon-only btn-default">
		            		
						                    <i class="fa fa-trash"></i>
						                    
						                </a>
		            					
		            				</td>
		            				
		            			</tr>
								
							<?php endforeach ?>

						<?php endif ?>
            			
            		</tbody>
            		
            	</table>
            	
            </div>
            
        </div>
		
	</div>
	
</div>