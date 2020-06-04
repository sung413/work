var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

app.get('/', (req, res) => {
  res.sendFile('/var/www/html/chattest.html');
});

http.listen(8000, () => {
  console.log('채팅서버 시작!');
});


io.on('connection', (socket) => {
    console.log('a user connected');
    socket.on('disconnect', () => {
        console.log('user disconnected');
    });
});

io.on('connection', (socket) => {
    socket.on('chat message', (msg) => {
        console.log('message: ' + msg.message);
    });
});

io.emit('some event', { someProperty: 'some value', otherProperty: 'other value' }); // This will emit the event to all connected sockets

io.on ( 'connection' , (socket) => { 
    socket.broadcast.emit ( 'hi' ); 
});


io.on ( 'connection' , (socket) => {
    socket.on ( 'chat message' , (msg) => { 
        io.emit ( 'chat message' , msg); 
    }); 
});
