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

function collectData(){
    
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