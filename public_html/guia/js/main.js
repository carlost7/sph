/*
 * Autocompletadores de texto
 */

$("#local").autocomplete({
    serviceUrl: base_url + "/catalogo_zonas",
    onSelect: function(suggestion) {
        jQuery("#tipolocal").val(suggestion.data);
    }
});

$("#cat").autocomplete({
    serviceUrl: base_url + "/catalogo_categorias",
    onSelect: function(suggestion) {
        jQuery("#tipocat").val(suggestion.data);
    }
});
