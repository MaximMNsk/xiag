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

$(document).ajaxStart(function () {
    waiting( 'start' );
});

$(document).ajaxStop(function () {
    waiting( 'stop' );
});

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

function waiting( way ) {
    if( way=='start' ){
        $("body").prepend("<div id=\"waiting\"><img src='../assets/img/loading-page.gif' id=\"waiting-img\" /></div>");
        $("#waiting").addClass('position-absolute w-100 h-100').css({"z-index":"500"});
        $("#waiting-img").css( {"top":"10%", "left":"37%"} ).addClass('position-fixed w-25');
        // $("body").attr("disabled", true);
    }else if( way=='stop' ){
        $("body").attr("disabled", false);
        $("#waiting").remove();
    }else{
        return false;
    }
}


function ajaxError(jqXHR, exception){
    var msg = '';
    if (jqXHR.status === 0) {
        msg = 'Can not connect.\n Verify Network.';
    } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
    } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
    } else if (exception === 'timeout') {
        msg = 'Time out error.';
    } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
    } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
    }
    alert( msg + '<br><br>' + jqXHR.responseText, 3 );

}
