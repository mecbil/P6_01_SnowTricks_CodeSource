click = 0;
        
function loadMoreTricks(event) {
    event.preventDefault();
    click++;
    var start = 8 * click;
    const url = "/" + start;
    axios.get(url).then(function(response) {
        $(".tricks").append(response.data);
    }).catch(function (error) {
        if (response.status === 403) {
            window.alert("Vous n'êtes pas autorisé à effectuer cette action !");
        }
        else if (response.status === 404) {
            window.alert("La page appelé n'existe pas");
        }
        else {
            window.alert("Une erreur est survenue !");
        }
    });
}
document.getElementById("loadMoreTricks").addEventListener("click", loadMoreTricks);
