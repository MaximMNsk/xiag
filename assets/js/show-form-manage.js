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
});

function collectData(){
    let data = [];
    let userName = $('#user-name').val();
    let answer = $('input[destination="vote"]:checked').attr('id');
    data.push(
        {name: 'userName', value: userName },
        {name: 'answer', value: (answer===undefined) ? "" : answer }
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