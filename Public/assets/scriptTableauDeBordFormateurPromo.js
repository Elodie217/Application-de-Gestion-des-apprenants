////////////////Afficher Promos////////////////

function afficherSectionPromotions() {
  document.querySelector(".Accueil").classList.add("hidden");
  document.querySelector(".Promotions").classList.remove("hidden");

  recupererPromo();
}

// Afficher API

function afficherPromo(promos) {
  document.querySelector(".tableauBody").innerHTML = "";
  promos.forEach((element) => {
    document.querySelector(".tableauBody").innerHTML +=
      `<tr class=" border-b hover:bg-neutral-100">
                        <td class="px-6 py-4"> <input type="checkbox">
                        </td>
                        <td class="px-6 py-4">` +
      element["Nom_promo"] +
      `</td>
                        <td class="px-6 py-4">` +
      afficherDate(element["DateDebut_promo"]) +
      `</td>
                        <td class="px-6 py-4">` +
      afficherDate(element["DateFin_promo"]) +
      `</td>
                        <td class="px-6 py-4">` +
      element["Place_promo"] +
      `</td>
                        <td class="px-6 py-4">
                            <button onclick="voirPromo(` +
      element["Id_promo"] +
      `)" class="text-[#0D6EFD] mx-2">Voir</button>
                            <button class="text-[#0D6EFD] mx-2">Editer</button>
                            <button class="text-[#0D6EFD] mx-2">Supprimer</button>

                        </td>
                    </tr>`;
  });
}

function afficherDate(date) {
  let [annee, mois, jour] = date.split("-").map(Number);

  if (mois < 9) {
    mois = "0" + mois;
  }
  if (jour < 9) {
    jour = "0" + jour;
  }

  return jour + "-" + mois + "-" + annee;
}

//Récupérer API

function recupererPromo() {
  let userConnexion = {
    emailConnexion: email,
    motDePasseConnexion: mdp,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(userConnexion),
  };

  fetch("http://applicationgestionapprenants2/public/connexion", params)
    .then((res) => res.text())
    .then((data) => reponseConnexion(JSON.parse(data)));

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/promotions"
  )
    .then((res) => res.text())
    .then((data) => {
      promos = JSON.parse(data);
      console.log(promos);
      afficherPromo(promos);
    });
}

////////////////Voir Promo////////////////

//Récupérer API
function voirPromo(idPromo) {
  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/promotions"
  )
    .then((res) => res.text())
    .then((data) => {
      promos = JSON.parse(data);
      console.log(promos);
      afficherPromo(promos);
    });
}
