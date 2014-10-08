$("#btn_rank").click(function() {

    url = "{{ URL::route('miembro.add_rank',array(get_class($evento),$evento->id)) }}";
    $.post(url).done(function(data) {
        if (data['error']) {
            $("#rank").html(data['mensaje']);
        } else {
            $("#rank").html("rank: " + data['rank']);
        }


    });
});

$("#add_comentario").submit(function(e) {
    var postData = $(this).serializeArray();
    var formUrl = $(this).attr('action');
    $.ajax({
        url: formUrl,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
            if (data['status'] == true) {
                if($(".show_comentario:last").length){
                    $(data['comentario']).insertAfter(".show_comentario:last");
                }else{
                    $(data['comentario']).insertAfter("#all_comments");
                }
                
                
                $("#comentario").val("");
            } else {
                $(data['mensaje']).insertAfter(".show_comentario:last");
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("error").insertAfter(".show_comentario:last");
        }
    });
    e.preventDefault();
});

function delete_comment(id) {
    var objeto = $("#del_comentario-"+id)
    var postData = objeto.serializeArray();
    var formUrl = objeto.attr('action');
    
    $.ajax({
        url: formUrl,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
            if (data['status'] == true) {
                $("#com-"+id).remove();
            } else {
                $(data['mensaje']).insertAfter("#del_comentario-"+id);
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("error").insertAfter("#del_comentario-"+id);
        }
    });
}