$("#add_res").submit(function(e) {
    var postData = $(this).serializeArray();
    var formUrl = $(this).attr('action');
    $.ajax({
        url: formUrl,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
            if (data['status'] == true) {                
                $("#all_comments").append(data['comentario']);
                $("#new_comentario").val("");
                if($("#error").length){
                    $("#error").remove();
                }
            } else {
                $("<div id='error'>"+data['mensaje']+"</div>").insertAfter("#all_comments");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("<div id='error'>error</div>").insertAfter("#all_comments");
        }
    });
    e.preventDefault();    
});

function show_response(id){
    $("#add-com-"+id).show();
}

function hide_response(id){
    $("#add-com-"+id).hide();
}

function add_comment(id){
    var add_form = $("#"+id);
    
    var postData = add_form.serializeArray();
    var formUrl = add_form.attr('action');
    $.ajax({
        url: formUrl,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
            if (data['status'] == true) {                
                $("#text-com"+id).val("");
                $("#com-"+id).append(data['comentario']);
                $("#add-com-"+id).hide();
            } else {
                
                $(data['mensaje']).insertAfter("#com-"+id);                
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            
            $("<div id='error'>error</div>").insertAfter("#com-"+id);
        }
    });    
}

function show_edit_comment(id){
    $("#funct-"+id).hide();
    $("#edit-com-"+id).show();
}

function hide_edit_comment(id){
    $("#funct-"+id).show();
    $("#edit-com-"+id).hide();
}

function delete_comment(id) {
    var objeto = $("#del_comentario-" + id)
    var postData = objeto.serializeArray();
    var formUrl = objeto.attr('action');

    $.ajax({
        url: formUrl,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
            if (data['status'] == true) {
                $("#com-" + id).remove();
            } else {
                $("<div id='error'>"+data['mensaje']+"</div>").insertAfter("#del_comentario-" + id);
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("<div id='error'>error</div>").insertAfter("#del_comentario-" + id);
        }
    });
}

function submit_edit_form(id) {
    var objeto = $("#edit-frm-" + id);
    var postData = objeto.serializeArray();
    var formUrl = objeto.attr('action');
    $.ajax({
        url: formUrl,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
            if (data['status'] == true) {
                $("#com-"+id).replaceWith(data['comentario']);
                if($("#error").length){
                    $("#error").remove();
                }
            } else {
                $("<div id='error'>"+data['mensaje']+"</div>").insertBefore("#com-" + id);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("<div id='error'>error</div>").insertBefore("#com-" + id);
        }
    });    
}