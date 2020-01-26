<form class="search-form">

    <div class="input-group btn-searcher">
        
        <span class="input-group-btn">
            <a href="javascript:;" class="btn submit">
                <i class="icon-magnifier"></i>
            </a>
        </span>

    </div>

</form>

<ul class="dropdown-menu">

	<li class="external">

        <h3>
			<span class="bold">Buscador</span>

		</h3>

    </li>

    <li>
    	
    	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
			
			<div class="col-md-12">

				<form role="form" method="GET">

				<div style="margin-top: 10px" class="form-body">

		    		<div class="form-group">

		    			<label>Buscar por</label>

		    			<select name="f" class="form-control">

		    				<?php foreach ($searcher as $key => $value): ?>
		    					
		    					<option value="<?= $value ?>"><?= $key ?></option>

		    				<?php endforeach ?>
                            
                        </select>

		    		</div>

		    		<div class="form-group">

                        <label>Dato a buscar</label>
                        <input name="q" class="form-control spinner" type="text"> 

                    </div>

                    <div class="form-group">

                        <button style="width: 100%" class="btn btn-default" type="submit">Buscar</button> 

                    </div>

                    

	    		</div>

    		</form>

    	</div>

    </li>

</ul>