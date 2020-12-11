//show-form-votes.js
export function WebSocketVote(){
  var log = false;
  let addr = $("#add-data").attr("wss-addr");
  if(addr!==undefined){
    var socket = new WebSocket("ws://xiag.test:27800");
  }else{
    return false;
  }

  socket.onopen = function(e) {
    if(log) console.info("[open] Connected");
    if(log) console.info("Send message to server");
  };

  let data = { "pollId": $("#add-data").attr("poll-id")};
  setInterval(() => {
    if (socket.bufferedAmount == 0 && socket.readyState==1) {
      socket.send(JSON.stringify(data));
    }
  }, 2000);
  
  var prevMessage;
  socket.onmessage = function(event) {
    if(log) console.info(`[message] Data received: ${event.data}`);
      if(prevMessage!=event.data){
        $("#vote-data").empty();
        $("#vote-data").append( voteTable(event.data) );
      }
      prevMessage = event.data;
  };
  
  socket.onclose = function(event) {
    if (event.wasClean) {
      if(log) console.info(`[close] Connection closed clearly, code=${event.code} reason=${event.reason}`);
    } else {
      if(log) console.info('[close] Connection aborted');
    }
    setTimeout(()=>{
      WebSocketVote();
    }, 5000);
  };
  
  socket.onerror = function(error) {
    if(log) console.info(`[error] ${error.message}`);
    if(log) console.info('[message] Reconnecting...');
  };

  function voteTable( data ){
    data = JSON.parse(data);
    var result;
    var headers = [];
    if( data.poll === undefined || data.votes === undefined ) return 'No data found';
    result = '<table class="table">'+
              '<tr><th class="font-size-4">Name</th>';
    data.poll.forEach( function( item ){
      result = result + `<th class="font-size-4"> ${item.answer} </th>`;
      headers.push(item.id);
    });
    result = result + '</tr>';
    data.votes.forEach( function( item, i ){
      result = result + `<tr><td class="w-1 overflow-hidden font-size-3"> ${item.author} </td>`;
      headers.forEach( function( h ){
        result = result + `<td class="font-size-4"> ${(item.answer_id == h) ? 'X' : '-'} </td>`;
      });
      result = result + '</tr>';
    });
    result = result + '</table>';
    return result;
  }
  
}

