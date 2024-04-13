////////////////Afficher Promos////////////////

function afficherSectionPromotions() {
  document.querySelector(".Accueil").classList.add("hidden");
  document.querySelector(".Promotions").classList.remove("hidden");
  afficherSection("Promotions", "VoirRetards", "VoirAbsences", "VoirPromotion");
  recupererPromos();
}

// Afficher API

function afficherPromos(promos) {
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
      ", '" +
      element["Nom_promo"] +
      `')" class="text-[#0D6EFD] mx-2">Voir</button>
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

function recupererPromos() {
  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/promotions"
  )
    .then((res) => res.text())
    .then((data) => {
      promos = JSON.parse(data);
      console.log(promos);
      afficherPromos(promos);
    });
}

////////////////Voir Promo////////////////
// Afficher API
function afficherSectionTableauA() {
  afficherSection("VoirPromotion", "Promotions", "VoirRetards", "VoirAbsences");
}

function afficherApprenants(Apprenants) {
  document.querySelector(".tableauBodyTablA").innerHTML += ``;

  Apprenants.forEach((element) => {
    document.querySelector(".tableauBodyTablA").innerHTML +=
      `<tr class="border-b hover:bg-neutral-100">
                        <td class="px-6 py-4"> <input type="checkbox">
                        </td>
                        <td class="px-6 py-4">` +
      element["Nom_utilisateur"] +
      `</td>
                        <td class="px-6 py-4">` +
      element["Prenom_utilisateur"] +
      `</td>
                        <td class="px-6 py-4">` +
      element["Email_utilisateur"] +
      `</td>
                        <td class="px-6 py-4">` +
      afficherCompteActive(element["Activiation_utilisateur"]) +
      `</td>
                        <td class="Role` +
      element["Id_utilisateur"] +
      ` px-6 py-4"></td>
                        <td class="px-6 py-4">
                            <button class="text-[#0D6EFD] mx-2">Editer</button>
                            <button class="text-[#0D6EFD] mx-2">Supprimer</button>
                        </td>
                    </tr>`;

    recupererRoles(element["Id_role"], element["Id_utilisateur"]);
  });
}

function afficherCompteActive(compteActive) {
  if ((compteActive = 1)) {
    return "Oui";
  } else {
    return "Non";
  }
}

//Récupérer API
function voirPromo(idPromo, nomPromo) {
  afficherSection("VoirPromotion", "Promotions", "VoirRetards", "VoirAbsences");
  let promoSpan = document.querySelectorAll(".promoSpan");

  promoSpan.forEach((element) => {
    element.innerHTML = nomPromo;
  });

  // Récupération Apprenants
  let Promo = {
    Id_promo: idPromo,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(Promo),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/promotions/apprenants",
    params
  )
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      afficherApprenants(data);
    });
}

function recupererRoles(idRoleApprenant, idApprenant) {
  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/promotions/roles"
  )
    .then((res) => res.text())
    .then((data) => {
      let roles = JSON.parse(data);
      console.log(roles);
      let role = roles.find((element) => element["Id_role"] == idRoleApprenant);
      if (role) {
        document.querySelector(".Role" + idApprenant).innerHTML =
          role["Nom_role"];
        // return role["Nom_role"];
      } else {
        return null;
      }
    });
}

function afficherSection(
  sectionAAfficher,
  sectionACacher1,
  sectionACacher2,
  sectionACacher3
) {
  document.querySelector("." + sectionAAfficher).classList.remove("hidden");
  document.querySelector("." + sectionACacher1).classList.add("hidden");
  document.querySelector("." + sectionACacher2).classList.add("hidden");
  document.querySelector("." + sectionACacher3).classList.add("hidden");
}

//Retards
function afficherSectionRetars() {
  afficherSection("VoirRetards", "VoirAbsences", "VoirPromotion", "Promotions");
}

//Abs
function afficherSectionAbs() {
  afficherSection("VoirAbsences", "VoirPromotion", "Promotions", "VoirRetards");
}
