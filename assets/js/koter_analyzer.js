//Koter analyzer * begin
const ws = new WebSocket("ws://localhost:8079");
ws.onopen = () => {
    //Hier moet nog iets komen dat de naam en het nummer van het groepje bekent is. Mischien iets met jquery -> Ajax.
    let name = "Koters for live";
    let number = 0;
    ws.send("Client joined the server. " + Date());
    setInterval(() => {//Stuurt elke seconde een ping naar de server met de data.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
        else {
            window.alert("Error: brouwser niet geaccepteerd voor deze trace methode.");
        }
        function showPosition(position) {
            let x = position.coords.latitude;
            let y = position.coords.longitude;
            ws.send(name + "{[:]}" + number + "{[:]}" + x + "{[:]}" + y + "{[:]}" + Date());
        }
    }, 1000);
}
//Koter analyzer * end