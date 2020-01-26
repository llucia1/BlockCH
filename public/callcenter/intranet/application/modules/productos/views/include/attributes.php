<div class="portlet light bordered">

    <div class="portlet-title">

        <div class="caption">

            <i class="icon-settings font-dark"></i>

            <span class="caption-subject font-dark sbold uppercase">Atributos</span>

        </div>

        <form style="float: right;" class="form-inline">

          <div class="form-group">

            <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-search"></i></span>

                <input name="search-attr" value="" class="form-control search-attr" type="text">

          	</div>

          </div>

            <a href="" class="btn btn-success go-srh-attr" style="width:13%;" type="button">Ir</a>

        </form>

    </div>

    <div class="portlet-body">

        <div class="row">

           <div class="col-md-3 col-sm-3 col-xs-3">

               <ul class="nav nav-tabs tabs-left">

                   <?php foreach ($attributes as $key => $value): ?>

                        <li <?php if($key == 0) echo 'class="active"' ?> >

                            <a data-toggle="tab" href="#<?= url_title($value->name) ?><?= $value->is_join ?>"> <?= $value->name ?> </a>

                        </li>

                    <?php endforeach ?>

               </ul>

           </div>

           <div class="col-md-9 col-sm-9 col-xs-9">

               <div class="tab-content">

                   <?php foreach ($attributes as $key => $value): ?>

                        <div id="<?= url_title($value->name) ?><?= $value->is_join ?>" class="tab-pane <?php if($key == 0) echo 'active' ?> <?php if($key > 0) echo 'fade' ?>">

                          <table class="table table-striped table-bordered table-hover table-checkable order-column" id="attr_<?= $key ?>">

                            <thead>

                                 <tr>
                                     <th> # </th>
                                     <th> Valor </th>
                                     <th> Precio </th>
                                     <th> Estado </th>
                                     <th>  </th>
                                     <th>  </th>

                                 </tr>

                             </thead>

                             <tbody>

                                <?php foreach ($this->$model_name->get_attribute_values($value->is_join,$lang) as $key2 => $value2): ?>

                                     <tr id="<?= $value2->value ?>">

                                             <td> <?= $value2->is_join ?> </td>

                                             <td> <?= $value2->value ?> </td>

                                             <td>

                                                 <form role="form">

                                                     <div class="form-body">

                                                         <div class="form-group">

                                                                 <input id="attribute-value-<?= $value2->is_join ?>" type="text" key="<?= $id ?>" attribute="<?= $value2->id_attribute ?>" attribute_value="<?= $value2->is_join ?>" class="form-control impact-attribute"

                                                                 <?php $pro_attr = $this->$model_name->exist_product_attribute($id,$value2->id_attribute,$value2->is_join) ?>

                                                                 <?php if($pro_attr): ?>

                                                                     <?php $state = $pro_attr->state ?>
                                                                     <?php $value_ = $pro_attr->impact ?>
                                                                     value="<?= $pro_attr->impact ?>"

                                                                 <?php else: ?>

                                                                     <?php $state = 0 ?>
                                                                     <?php $value_ = 0 ?>
                                                                     value="0"

                                                                 <?php endif ?>
                                                                 name="impact">

                                                             </div>

                                                     </div>

                                                 </form>

                                             </td>

                                             <td>

                                               <div class="form-group">

                                                   <input value="<?= $value_ ?>" <?php if($state == 1) echo 'checked' ?> type="checkbox" class="impact-attribute-state" id="attribute-value-<?= $value2->is_join ?>" state="<?= $state ?>" multi="false" key="<?= $id ?>" attribute="<?= $value2->id_attribute ?>" attribute_value="<?= $value2->is_join ?>">
																	<span style="display:none;"><?= $state ?></span>
                                               </div>

                                              </td>

                                             <td align="center">

                                               <a id="<?= $value2->is_join ?>" title="imágenes" data-toggle="modal" data-target="#imagesSliderModal<?= $value2->id ?>" class="btn btn-circle btn-icon-only btn-default impact-attribute" style="cursor:pointer;">

                                                   <i class="fa fa-camera"></i>

                                               </a>

                                               <?php $isModal['id_attribute_value'] = $value2->id ?>
                                               <?php $isModal['id_attribute'] = $value2->id_attribute  ?>
                                               <?php $isModal['id'] = $id ?>
                                               <?php $isModal['attachments_attr'] = $this->$model_name->get_attachments(strtolower(TABLE),$id,$value2->id_attribute,$value2->id)?>

                                               <?php $this->load->view('include/modal/imagesSlider_modal',$isModal) ?>

                                              </td>

                                             <td align="center">

                                                 <a id="<?= $value2->is_join ?>" class="btn btn-circle btn-icon-only btn-default impact-attribute" style="cursor:pointer;">

                                                     <i class="fa fa-floppy-o"></i>

                                                 </a>

                                             </td>

                                         </tr>


                                 <?php endforeach ?>

                             </tbody>

                          </table>

                        </div>

                   <?php endforeach ?>

               </div>

           </div>

        </div>

    </div>

</div>
