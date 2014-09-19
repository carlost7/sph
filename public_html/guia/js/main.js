/*
 * Autocompletadores de texto
 */

base_url = window.location.origin+"/mx/guia"+


jQuery("#local").autocomplete({
    serviceUrl: base_url + "/catalogo_zonas",
    onSelect: function(suggestion) {
        jQuery("#tipolocal").val(suggestion.data);
    }
});

jQuery("#local").focus(function() {
    alert("prueba");
});

jQuery("#cat").focus(function() {
    alert("prueba");
});


jQuery("#cat").autocomplete({
    serviceUrl: base_url + "/catalogo_categorias",
    onSelect: function(suggestion) {
        jQuery("#tipocat").val(suggestion.data);
    }
});
