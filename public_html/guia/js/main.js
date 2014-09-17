/*
 * Autocompletadores de texto
 */

jQuery("#local").autocomplete({
    serviceUrl: base_url + "/catalogo_zonas",
    onSelect: function(suggestion) {
        jQuery("#tipolocal").val(suggestion.data);
    }
});

jQuery("#cat").autocomplete({
    serviceUrl: base_url + "/catalogo_categorias",
    onSelect: function(suggestion) {
        jQuery("#tipocat").val(suggestion.data);
    }
});
