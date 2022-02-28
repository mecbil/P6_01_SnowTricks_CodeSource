click = 0;
        
function loadMoreComments(event) {
    event.preventDefault();
    click++;
    var begin = 4 * click;
    const url = '/'+id+"/details" + begin;
    axios.get(url).then(function(response) {
        $(".Comments").append(response.data);
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
document.getElementById("loadMoreComments").addEventListener("click", loadMoreComments);
