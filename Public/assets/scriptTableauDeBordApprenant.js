// Afficher API

function afficherAccueil(NomPromo, PlacePromo) {
  document.querySelector(".promoApprenant").innerText = NomPromo;
  document.querySelector(".placePromo").innerText =
    PlacePromo + " participants";

  let dateDuJour = new Date();
  let dateDuJourJour = dateDuJour.getDate();

  let Mois = dateDuJour.getMonth();
  let dateDuJourMois = dateDuJour.getMonth() + 1;
  if (dateDuJourMois < 9) {
    dateDuJourMois = "0" + dateDuJourMois;
  }
  let dateDuJourAnnee = dateDuJour.getFullYear();

  document.querySelector(".dateDuJour").innerText =
    dateDuJourJour + `-` + dateDuJourMois + `-` + dateDuJourAnnee;
}

recupererPromo();

// Récupérer API
function recupererPromo() {
  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordApprenant/accueil"
  )
    .then((res) => res.text())
    .then((data) => {
      promo = JSON.parse(data);

      afficherAccueil(promo["Nom_promo"], promo["Place_promo"]);
    });
}

//Deconnexion
function deconnexion() {
  fetch("http://applicationgestionapprenants2/public/deconnexion")
    .then((res) => res.text())
    .then((data) => console.log(data));
}
