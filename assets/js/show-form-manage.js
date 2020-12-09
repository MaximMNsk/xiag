import Ajax from './ajax.js';
import { Cookie } from './cookie.js';
var ajax = new Ajax();
var cookie = new Cookie();

$(document).ready(()=>{
    let browserId = cookie.getCookie('browserId');
    if (browserId===undefined)  cookie.setCookie('browserId', makeId(16));
    // cookie.deleteCookie('browserId');
    console.info(document.cookie);
});

$(document).on('click', '#vote', ()=>{
    console.info(collectData());
    let collectedData = collectData();
    $.when(ajax.sendReq( '../../vote/save/', collectedData )).done(()=>{
        customAlert( ajax.answer.code, ajax.answer.text );
    });
});

$(document).ajaxStart( () => {
    ajax.waiting('start');
});

$(document).ajaxStop( () => {
    ajax.waiting('stop');
});



function collectData(){
    let data = [];
    let userName = $('#user-name').val();
    let answer = $('input[destination="vote"]:checked').attr('id');
    let browserId = cookie.getCookie('browserId');
    data.push(
        {name: 'userName', value: userName },
        {name: 'answer', value: (answer===undefined) ? "" : answer },
        {name: 'browserId', value: browserId },
    );
    return data;
}

function makeId(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }

 function customAlert( alertCode, alertText ){
    var d = $.Deferred();
    var alertClass = (alertCode==0) ? "alert alert-success" : "alert alert-warning";
    $("#answers").append("<div id='custom-alert'>"+alertText+"</div>");
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