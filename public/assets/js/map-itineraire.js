var map ;

 // On charge les "tuiles"
 window.onload = () =>{
    map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20
    }).addTo(map)
    //activation de l'itineraire
    L.Routing.control({
        geocoder: L.Control.Geocoder.nominatim()

    }).addTo(map)

 }
/*


// Créer une requête AJAX
var xhr = new XMLHttpRequest();

// Définir la méthode et l'URL de la requête
xhr.open('GET', '/template/evenement/mapAdresse.html.twig');

// Ajouter un événement pour gérer la réponse de la requête
xhr.onload = function() {
  if (xhr.status === 200) {
    // Récupérer la réponse de la requête
    var response = xhr.responseText;
    
    // Utiliser la bibliothèque Twig.js pour parser le contenu de la réponse
    var template = Twig.twig({data: response});
    
    // Récupérer les données de la variable Twig
    var data = template.render({data: null});
    
    // Utiliser les données récupérées
    console.log(data.long);
    console.log(data.lat);
  }
};

// Envoyer la requête
xhr.send();


*/