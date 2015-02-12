jQuery(document).ready(function () {

      jQuery("#nombre_ubicacion").autocomplete({
            serviceUrl: base_url + "/catalogo_zonas",
            onSelect: function (suggestion) {
                  jQuery("#id_ubicacion").val(suggestion.data);
            }
      });

      jQuery("#nombre_categoria").autocomplete({
            serviceUrl: base_url + "/catalogo_categorias",
            onSelect: function (suggestion) {
                  jQuery("#id_categoria").val(suggestion.data);
            }
      });

});

