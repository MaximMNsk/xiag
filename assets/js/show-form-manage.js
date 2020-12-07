$(document).ready(()=>{
    setCookie('browserId', 'asdvcxz');
    alert( document.cookie );
    let asd = getCookieByName('browserId');
    alert(asd);
});

