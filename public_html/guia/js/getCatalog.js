$(function() {
    $('#estados').change(function() {
        var estado_id = $("#estados").val();
        url = base_url + "/obtener_zona/" + estado_id;
        $.get(url).done(function(data) {
            $("#zonas").empty();
            for (i = 0; i < data.length; i++) {
                resultado = data[i];
                if (resultado.id === '{{""}}') {
                    elemento = "<option value=" + resultado.id + " selected >" + resultado.zona + "</option>";
                } else {
                    elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
                }
                $("#zonas").append(elemento);
            }
        });
    }).trigger('change');
    $('#categorias').change(function() {
        var categoria_id = $("#categorias").val();
        url = base_url + "/obtener_subcategoria/" + categoria_id;
        $.get(url).done(function(data) {
            $("#subcats").empty();
            for (i = 0; i < data.length; i++) {
                resultado = data[i];
                if (resultado.id === '{{""}}') {
                    elemento = "<option value=" + resultado.id + " selected >" + resultado.subcategoria + "</option>";
                } else {
                    elemento = "<option value=" + resultado.id + ">" + resultado.subcategoria + "</option>";
                }
                $("#subcats").append(elemento);
            }
        });
    }).trigger('change');


    $("#search_catalog").click(function(e){
       e.preventDefault();
       if( $("#busca_negocio").is(':checked') && $("#busca_cartelera").is(':checked') ){
           url = base_url;
       }else if($("#busca_negocio").is(':checked')){
           url = base_url+'/negocios';
       }else if($("#busca_cartelera").is(':checked')){
           url = base_url+'/cartelera';
       }else{
           url = base_url;
       }
       $("#form_catalog").attr("action",url).submit();
    });

});


$("#nombre_ubicacion").autocomplete({
    serviceUrl: base_url + "/catalogo_zonas",
    
    onSelect: function(suggestion) {
        $("#id_ubicacion").val(suggestion.data);
    }
});

$("#nombre_categoria").autocomplete({
    serviceUrl: base_url + "/catalogo_categorias",
    onSelect: function(suggestion) {
        $("#id_categoria").val(suggestion.data);
    }
});
