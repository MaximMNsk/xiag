let socket = new WebSocket("ws://xiag.test:27800");

socket.onopen = function(e) {
  console.info("[open] Connected");
  console.info("Send message to server");
  let data = $("#add-data").attr("poll-id");
  setInterval(() => {
    socket.send(data);
  }, 2000);
};


var prevMessage;
socket.onmessage = function(event) {
    console.info(`[message] Data received: ${event.data}`);
    if(prevMessage!=event.data){
      $("#vote-data").empty();
      $("#vote-data").text(event.data);
    }
    prevMessage = event.data;
};

socket.onclose = function(event) {
  if (event.wasClean) {
    console.info(`[close] Connection closed clearly, code=${event.code} reason=${event.reason}`);
  } else {
    // например, сервер убил процесс или сеть недоступна
    // обычно в этом случае event.code 1006
    console.info('[close] Connection aborted');
  }
};

socket.onerror = function(error) {
    console.info(`[error] ${error.message}`);
};