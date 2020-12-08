$(document).ready(()=>{
    let browserId = getCookieByName('browserId');
    if (browserId===undefined)  setCookie('browserId', makeId(16));
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