function invis(id) {
    document.getElementById(id).style.display = "none";
}
function a() {
    invis("amig");
    invis("2");
}
function b() {
    invis("ag");
    invis("1");
}
if (document.getElementById("pagina_blender")) {//Als blender pagina bestaat doe dan...
    document.getElementById("ag").addEventListener("click", () => {
        a();
    });
    document.getElementById("amig").addEventListener("click", () => {
        b();
    });
    document.getElementById("ag").addEventListener("keypress", () => {
        a();
    });
    document.getElementById("amig").addEventListener("keypress", () => {
        b();
    });
}