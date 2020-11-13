$(document).ready(()=>{
    // alert('Boo');
});

$(document).on('click', '#add-item', ()=>{
    addItem();
});

$(document).on('click', '#kill-item', function(){
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