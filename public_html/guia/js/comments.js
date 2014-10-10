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
            } else {
                $(data['mensaje']).insertAfter("#all_comments");                
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("error").insertAfter(".show_comentario:last");
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

$(".frm_add_response").submit(function(e){
    var postData = $(this).serializeArray();
    var formUrl = $(this).attr('action');
    var idform = $(this).attr('id');
    
    $.ajax({
        url: formUrl,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
            if (data['status'] == true) {                
                $("#text-com"+idform).val("");
                $("#com-"+idform).append(data['comentario']);
                $("#add-com-"+idform).hide();
            } else {
                
                $(data['mensaje']).insertAfter("#com-"+idform);                
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            
            $("error").insertAfter("#com-"+idform);
        }
    });
    e.preventDefault();
})