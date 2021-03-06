jQuery(function () {
      jQuery('#estados').change(function () {
            var estado_id = jQuery("#estados").val();
            url = base_url + "/obtener_zona/" + estado_id;
            jQuery.get(url).done(function (data) {
                  jQuery("#zonas").empty();
                  elemento = "<option value=''></option>";
                  jQuery("#zonas").append(elemento);
                  for (i = 0; i < data.length; i++) {
                        resultado = data[i];
                        if (resultado.id === '{{""}}') {
                              elemento = "<option value=" + resultado.id + " selected >" + resultado.zona + "</option>";
                        } else {
                              elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
                        }
                        jQuery("#zonas").append(elemento);
                  }
            });
      }).trigger('change');
      jQuery('#categorias').change(function () {
            var categoria_id = jQuery("#categorias").val();
            url = base_url + "/obtener_subcategoria/" + categoria_id;
            jQuery.get(url).done(function (data) {
                  jQuery("#subcats").empty();
                  elemento = "<option value=''></option>";
                  jQuery("#subcats").append(elemento);
                  for (i = 0; i < data.length; i++) {
                        resultado = data[i];
                        if (resultado.id === '{{""}}') {
                              elemento = "<option value=" + resultado.id + " selected >" + resultado.subcategoria + "</option>";
                        } else {
                              elemento = "<option value=" + resultado.id + ">" + resultado.subcategoria + "</option>";
                        }
                        jQuery("#subcats").append(elemento);
                  }
            });
      }).trigger('change');
      jQuery("#search_catalog").click(function (e) {
            e.preventDefault();
            if (jQuery("#busca_negocio").is(':checked') && jQuery("#busca_cartelera").is(':checked')) {
                  url = base_url;
            } else if (jQuery("#busca_negocio").is(':checked')) {
                  url = base_url + '/negocios';
            } else if (jQuery("#busca_cartelera").is(':checked')) {
                  url = base_url + '/cartelera';
            } else {
                  url = base_url;
            }

            $(".id_ubicacion").val($("#estados").val() + "-" + $("#zonas").val());
            $(".id_categoria").val($("#categorias").val() + "-" + $("#subcats").val());

            jQuery("#form_catalog").attr("action", url).submit();
      });

});