// server.js
const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

app.use(express.static('BuddyMatch/VC'));
io.on('connection', (socket) => {
    socket.on('join', ({ username, room }) => {
        socket.join(room);
        console.log(`${username} joined room ${room}`);

        // Notify other users in the room
        socket.to(room).emit('user-joined', { id: socket.id, username });

        socket.on('signal', (data) => {
            io.to(data.userId).emit('signal', { userId: socket.id, signal: data.signal, username });
        });

        socket.on('disconnect', () => {
            socket.to(room).emit('user-left', socket.id);
        });
    });
});

ip='172.16.9.161';
const PORT = process.env.PORT || 3000;
server.listen(PORT,ip, () => {
    console.log(`Server is running on port ${PORT}`);
});