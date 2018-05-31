function removeContent(id, el){
    $.ajax({
        type: "GET",
        url: "contents/destroy/"+id,
        data: {id: id},
        success: function(data){
            if(data == '1'){
                $(el).parent().parent().remove();
            }
        }
    });
}