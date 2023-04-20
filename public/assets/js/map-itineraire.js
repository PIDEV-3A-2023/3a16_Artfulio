var map = L.map('map').setView([51.505, -0.09], 13);

 // On charge les "tuiles"
 window.onload = () =>{
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20
    }).addTo(map)


 }

let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = () => {
    // si la requete est terminé
    if(xmlhttp.readyState == 4){
        //sin on a une reponse
        if(xmlhttp.status == 200){
            //on recupere la réponse
           // let response = JSON.parse(xmlhttp.response)

            console.log(xmlhttp.responseText)
        //    let lat = response[0]["lat"]
        //    let lon = response[0]["lon"]
            //on met a jour la latitude et la longitude
        //    document.querySelector('#lat').value = lat
         //   document.querySelector("#lon").value = lon

            //on positionne le marqueur sur l'adresse
        //    let pos = [lat, lon]
        //    addMarker(pos)

         //   map.setView(pos, 15)

        }else{
            console.log(xmlhttp.statusText);
        }
    }
}
var url = "http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=arfulio&table=evenement";
var encodedUrl = encodeURIComponent(url);
xmlhttp.open("GET", url,true)
xmlhttp.send(null)

