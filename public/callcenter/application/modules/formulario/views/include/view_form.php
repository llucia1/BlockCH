<form class="form-horizontal" role="form">
    
    <?php foreach ($getFields as $key => $re): ?>
        
        <?php switch ($re->getType()):

                case 'header':?>

                <div class="form-group col-md-12">

                    <h4><strong><?= $getRow->getName() ?></strong></h4>
                    <hr/>

                </div>

                <?php break ?>

                <?php case 'text':?>

                <div style="padding: 0 20px;" class="form-group">

                    <label for="<?= $re->getName() ?>"><?= $re->getName() ?></label>

                    <div class="input-group">

                        <input name="<?= $re->getName() ?>" class="form-control" id="<?= $re->getName() ?>" type="text">
                        <span style="cursor: pointer" class="input-group-addon">
                            <i class="fa fa-trash font-red"></i>
                        </span>

                        <span style="padding: 0;" class="input-group-addon">
                            <input table="formularioCampos" field="orderer" key="<?= $re->getId() ?>" value="<?= $re->getOrderer() ?>" style="height: 32px;width: 40px;" type="text" class="form-control md-text"/>
                        </span>

                        <span style="cursor: pointer" class="input-group-addon">
                            <i onclick="location.reload()" class="fa fa-refresh" aria-hidden="true"></i>
                        </span>

                    </div>

                </div>

            <?php break ?>

            <?php case 'textarea': ?>

                <div style="padding: 0 20px;" class="form-group">

                    <label for="<?= $re->getName() ?>"><?= $re->getName() ?></label>
                    <div class="input-group">
                        <textarea name="<?= $re->getName() ?>" class="form-control" cols="50" rows="4"> </textarea>
                        <span style="cursor: pointer" class="input-group-addon">
                            <i class="fa fa-trash font-red"></i>
                        </span>

                        <span style="padding: 0;" class="input-group-addon">
                            <input table="formularioCampos" field="orderer" key="<?= $re->getId() ?>" value="<?= $re->getOrderer() ?>" style="height: 32px;width: 40px;" type="text" class="form-control md-text"/>
                        </span>

                        <span style="cursor: pointer" class="input-group-addon">
                            <i onclick="location.reload()" class="fa fa-refresh" aria-hidden="true"></i>
                        </span>

                    </div>
                    
                </div>

            <?php break ?>

            <?php case 'boolean': ?>

                <div style="padding: 0 20px;" class="form-group">

                    <label><?= $re->getName() ?></label>

                    <div class="mt-radio-inline input-group">

                        <label class="mt-radio">
                            <input name="<?= $re->getName() ?>" id="<?= $re->getName() ?>" value="1" type="radio"> Si
                            <span></span>
                        </label>

                        <label class="mt-radio">
                            <input name="<?= $re->getName() ?>" id="<?= $re->getName() ?>" value="0" type="radio"> No
                            <span></span>
                        </label>

                        <span style="cursor: pointer" class="input-group-addon">
                            <i class="fa fa-trash font-red"></i>
                        </span>

                        <span style="padding: 0;" class="input-group-addon">
                            <input table="formularioCampos" field="orderer" key="<?= $re->getId() ?>" value="<?= $re->getOrderer() ?>" style="height: 32px;width: 40px;" type="text" class="form-control md-text"/>
                        </span>

                        <span style="cursor: pointer" class="input-group-addon">
                            <i onclick="location.reload()" class="fa fa-refresh" aria-hidden="true"></i>
                        </span>
                        
                    </div>

                </div>

            <?php break ?>

            <?php case 'select': ?>

                <div style="padding: 0 20px;" class="form-group">

                    <label><?= $re->getName() ?></label>
                    
                    <div class="input-group">

                        <select name="<?= $re->getName() ?>" class="form-control">
                            
                            <option value=""></option>

                            <?php $options = explode(',', $re->getOptions()) ?>

                            <?php foreach ($options as $key => $value): ?>
                            
                                <option value="<?= $value ?><"><?= $value ?></option>

                            <?php endforeach ?>

                        </select>

                        <span style="cursor: pointer" class="input-group-addon">
                            <i class="fa fa-trash font-red"></i>
                        </span>

                        <span style="padding: 0;" class="input-group-addon">
                            <input table="formularioCampos" field="orderer" key="<?= $re->getId() ?>" value="<?= $re->getOrderer() ?>" style="height: 32px;width: 40px;" type="text" class="form-control md-text"/>
                        </span>

                        <span style="cursor: pointer" class="input-group-addon">
                            <i onclick="location.reload()" class="fa fa-refresh" aria-hidden="true"></i>
                        </span>

                    </div>

                </div>

            <?php break ?>

        <?php endswitch ?>

    <?php endforeach ?>
    
</form>


