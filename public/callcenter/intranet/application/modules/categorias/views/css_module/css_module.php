<?= link_tag('assets/assets_private/global/plugins/datatables/datatables.min.css') ?>
<?= link_tag('assets/assets_private/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') ?>

<style>

ul#menu_arbol, ul#menu_arbol ul {
     list-style-type: none;
     background: url(http://www.pruebasdugage.es/unifor/assets/assets_private/global/img/linea_vertical.gif) repeat-y;
     padding: 0;
  }
ul#menu_arbol li {
     padding: 5px 10px!important;
  }
  ul#menu_arbol ul {
     margin-left: 5px;
  }

  ul#menu_arbol li {
    padding: 0 10px;
    background: url(http://www.pruebasdugage.es/unifor/assets/assets_private/global/img/nodo.gif) no-repeat;
  }

  ul#menu_arbol li.cierre {
       background: #FFF url(http://www.pruebasdugage.es/unifor/assets/assets_private/global/img/cierre.gif) left top no-repeat;
  }

  ul#menu_arbol .radio input[type="radio"], ul#menu_arbol .radio-inline input[type="radio"] {
  margin-left: -9px;
  position: absolute;
}

</style>
