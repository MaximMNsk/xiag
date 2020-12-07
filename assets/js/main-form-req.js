$(document).on('click', '#save', ()=>{
    var d = $.Deferred();
    $.ajax({
        dataType: "json",
        type: "POST",
        url: 'main/save/',
        data: $.param( collectData() ),
        success: function( ans ){
            $.when( customAlert( ans.code, ans.text ) ).done(()=>{
                if( ans.code==0 ){
                    d.resolve();
                    customRedirect( ans.addData );
                }else{
                    d.resolve();
                }
            });
            // console.info(ans);
        },
        error: function (jqXHR, exception) {
            ajaxError(jqXHR, exception);
            d.reject();
        }
    });
    return d; 
});


function collectData(){
    let data = [];
    data.push(
        {name: 'question', value: $('#question').val() }
    );
    $('input[id^=answer]').each(function(i,e){
        data.push(
            {name: $(e).attr('id'), value: $(e).val() }
        );
    });
    return data;
}

function customAlert( alertCode, alertText ){
    var d = $.Deferred();
    var alertClass = (alertCode==0) ? "alert alert-success" : "alert alert-warning";
    $("#message").append("<div id='custom-alert'>"+alertText+"</div>");
    $("#custom-alert").addClass(alertClass).hide();
    $("#custom-alert").fadeIn();
    setTimeout(()=>{
        $.when( $("#custom-alert").fadeOut() ).done(()=>{
            $("#custom-alert").remove();
            d.resolve();
        });
    }, 5000);
    return d; 
}

function customRedirect( uuid ){
    var url = "show/poll";
    url = url+"/"+uuid;
    location.href = url;
}

