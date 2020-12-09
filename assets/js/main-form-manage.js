import Ajax from './ajax.js';
var ajax = new Ajax();


$(document).on('click', '#save', ()=>{
    let collectedData = collectData();
    $.when(ajax.sendReq( 'main/save/', collectedData )).done(()=>{
        $.when( customAlert( ajax.answer.code, ajax.answer.text ) ).done(()=>{
            if( ajax.answer.code==0 ){
                customRedirect( ajax.answer.addData );
            }
        });
    });
});

$(document).ajaxStart( () => {
    ajax.waiting('start');
});

$(document).ajaxStop( () => {
    ajax.waiting('stop');
});

$(document).on('click', '#add-item', ()=>{
    addItem();
});

$(document).on('click', '#kill-item', () => {
    var id = $(this).attr('item-id');
    $('span[ans-id='+id+']').remove();
});



function addItem(){
    var lastItemId = $('span[ans-id]:last').attr('ans-id')*1;
    var nextItemId = lastItemId+1;
    $('#items').append('<span ans-id="'+nextItemId+'">'+
                        '<span class="col-5">Answer '+nextItemId+':</span>'+
                        '<span><input  class="col-10 form-control d-inline" type="text" id="answer-'+nextItemId+'"></span>'+
                        '<button class="btn btn-primary ml-3" id="kill-item" item-id="'+nextItemId+'">-</button>'+
                        '<hr>'+
                        '</span>');
}


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
    $("#custom-alert").remove();
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

