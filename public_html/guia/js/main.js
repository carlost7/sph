/*
 * Autocompletadores de texto
 */

base_url = window.location.origin+"/mx/guia"+


$("#local").autocomplete({
    serviceUrl: base_url + "/catalogo_zonas",
    onSelect: function(suggestion) {
        $("#tipolocal").val(suggestion.data);
    }
});

$("#cat").autocomplete({
    serviceUrl: base_url + "/catalogo_categorias",
    onSelect: function(suggestion) {
        $("#tipocat").val(suggestion.data);
    }
});
