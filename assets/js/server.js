const ws = require("ws");
const server = new ws.Server({port: 8079});
console.log("Server start--->" + Date());
let onlineCounter = 0;
let sockets = [];
server.on("connection", (socket) => {
    sockets.push(socket);
    ++onlineCounter;
    console.log("Mensen online: " + onlineCounter + ". " + Date());
    socket.on("message", (txt) => {
        txt = txt.toString();
        console.log(txt); //Log
        sockets.forEach(r => {
            if (r.readyState === ws.OPEN && r !== socket) {//Verstuurd data naar alle andere clients behalve degene die hem gestuurd had.
                r.send(txt);
            }
        });
    });
    socket.on("close", () => {
        sockets = sockets.filter(s => s !== socket);
        --onlineCounter;
        console.log("Mensen online: " + onlineCounter + ". " + Date());
    });
});
console.log("Server ready--->" + Date());