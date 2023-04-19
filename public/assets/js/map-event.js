//declaration de la carte et du marqueur
let map , marqueur

map = L.map('map').setView([36.866537, 10.164723], 13);

 // On charge les "tuiles"
 window.onload = () =>{
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20
    }).addTo(map)
    map.on("click", mapClickListen)
//ecoute la saisie au niveau de la ville
    document.querySelector("#ville").addEventListener("blur",getCity)

 }

function mapClickListen(e){
    //on recupere les coodonnées du clic
    let pos = e.latlng

    //on ajoute le marqueur
    addMarker(pos)

    //On affiche les coordonnées dans le formulaire
    document.querySelector('#lat').value = pos.lat
    document.querySelector("#lon").value = pos.lng
}

function addMarker(pos){
    //On verifie si un marqueur existe
    if(marqueur != undefined){
        map.removeLayer(marqueur)
    }

    marqueur = L.marker(pos, {
        //on rend le marqueur deplacable
        draggable: true
    })

    //on ecoute le glisse / déposé de la souris
    marqueur.on("dragend", function(e){
        pos = e.target.getLatLng()
        document.querySelector('#lat').value = pos.lat
        document.querySelector("#lon").value = pos.lng
    })
    marqueur.addTo(map)

}


function getCity(){
    //On fabrique l'adresse
    let addresse = document.querySelector("#adresse").value 
    console.log(addresse)

    //on initialise une requete ajax
    const xmlhttp = new XMLHttpRequest

    xmlhttp.onreadystatechange = () => {
        // si la requete est terminé
        if(xmlhttp.readyState == 4){
            //sin on a une reponse
            if(xmlhttp.status == 200){
                //on recupere la réponse
                let response = JSON.parse(xmlhttp.response)

               // console.log(response)
                let lat = response[0]["lat"]
                let lon = response[0]["lon"]
                //on met a jour la latitude et la longitude
                document.querySelector('#lat').value = lat
                document.querySelector("#lon").value = lon

                //on positionne le marqueur sur l'adresse
                let pos = [lat, lon]
                addMarker(pos)

                map.setView(pos, 15)

            }
        }
    }

    //on ouvre la requete
    var url = `https://nominatim.openstreetmap.org/search?format=json&q=${addresse}&
    format=json&addressdetails=1&limit=1&polygon_svg=1`;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

/*
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    // si la requete est terminé et si on a une reponse
  if (this.readyState == 4 && this.status == 200) {
    //on recupere la réponse
    var response = JSON.parse(xmlhttp.response);
    console.log(response[0].display_name);
  }
};

var url = "https://nominatim.openstreetmap.org/search?format=json&q=" + adresse;
xmlhttp.open("GET", url, true);
xmlhttp.send(); */

