function openTrailer(url) {
    var trailerUrl = url; 
    document.getElementById('trailer').src = trailerUrl; 
    document.getElementById('trailerPopup').style.display = 'block';
}

window.onclick = function(event) {
    var modal = document.getElementById('trailerPopup');
    if (event.target === modal) {
        document.getElementById('trailerPopup').style.display = 'none';
        document.getElementById('trailer').src = "";
    }
};
