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
                            <button class="text-[#0D6EFD] mx-2" onclick="afficherEditPromo(` +
      element["Id_promo"] +
      `)">Editer</button>
                            <button class="text-[#0D6EFD] mx-2" onclick="supprimerPromo(` +
      element["Id_promo"] +
      `)">Supprimer</button>

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
  fetch(HOME_URL + "tableaudebordFormateur/promotions")
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

function afficherApprenants(Apprenants, idPromo, nomPromo) {
  document.querySelector(".divBtnCreaApprenant").innerHTML =
    `<h3 class="text-2xl my-4">Promotion <span class="promoSpan"></span></h3>
     <button class="btnSauvegarderCreaPromo py-1.5 px-3 bg-[#198754] gap-2 rounded text-white w-fit font-bold right-0 mt-4 h-fit" onclick="afficherCreaApprenant(` +
    idPromo +
    `, '` +
    nomPromo +
    `')">
             Ajouter apprenant
         </button>`;

  document.querySelector(".divBtnSousMenuTableau").innerHTML =
    `  <button onclick="afficherSectionTableauA()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6] w-96 md:w-80 lg:w-64 ">Tableau apprenants</button>
     <button onclick="afficherSectionRetards(` +
    idPromo +
    `)" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD] ">Retards</button>
     <button onclick="afficherSectionAbs(` +
    idPromo +
    `)" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Absences</button>

     <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>`;

  document.querySelector(".divBtnSousMenuRetards").innerHTML =
    `<button onclick="afficherSectionTableauA()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD] w-96 md:w-80 lg:w-64 ">Tableau apprenants</button>
            <button onclick="afficherSectionRetards(` +
    idPromo +
    `)" class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Retards</button>
            <button onclick="afficherSectionAbs(` +
    idPromo +
    `)" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Absences</button>

            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>`;

  document.querySelector(".divBtnSousMenuABS").innerHTML =
    `
  <button onclick="afficherSectionTableauA()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD] w-96 md:w-80 lg:w-64 ">Tableau apprenants</button>
            <button onclick="afficherSectionRetards(` +
    idPromo +
    `)" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Retards</button>
            <button onclick="afficherSectionAbs(` +
    idPromo +
    `)" class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Absences</button>

            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>`;

  document.querySelector(".tableauBodyTablA").innerHTML = ``;

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
                            <button class="text-[#0D6EFD] mx-2" onclick="afficherEditApprenant(` +
      element["Id_utilisateur"] +
      `, ` +
      idPromo +
      `, '` +
      nomPromo +
      `')">Editer</button>
                            <button class="text-[#0D6EFD] mx-2" onclick="supprimerApprenant(` +
      element["Id_utilisateur"] +
      `, ` +
      idPromo +
      `, '` +
      nomPromo +
      `')">Supprimer</button>
                        </td>
                    </tr>`;

    recupererRoles(element["Id_role"], element["Id_utilisateur"]);
  });
}

function afficherCompteActive(compteActive) {
  if (compteActive == 1) {
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

  fetch(HOME_URL + "tableaudebordFormateur/promotions/apprenants", params)
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      afficherApprenants(data, idPromo, nomPromo);
    });
}

function recupererRoles(idRoleApprenant, idApprenant) {
  fetch(HOME_URL + "tableaudebordFormateur/promotions/roles")
    .then((res) => res.text())
    .then((data) => {
      let roles = JSON.parse(data);
      let role = roles.find((element) => element["Id_role"] == idRoleApprenant);
      if (role) {
        document.querySelector(".Role" + idApprenant).innerHTML =
          role["Nom_role"];
        document.querySelector(".RoleR" + idApprenant).innerHTML =
          role["Nom_role"];
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

function fermerLaPromo() {
  document.querySelector(".Promotions").classList.remove("hidden");
  document.querySelector(".VoirPromotion").classList.add("hidden");
}

//////////////// Création promotion ////////////////
function afficherCreaPromo() {
  document.querySelector(".Promotions").classList.add("hidden");
  document.querySelector(".creerPromo").classList.remove("hidden");
}

function fermercreerPromo() {
  document.querySelector(".Promotions").classList.remove("hidden");
  document.querySelector(".creerPromo").classList.add("hidden");
}

function verifChampsPromo() {
  let nomPromo = document.querySelector("#nomPromo").value;
  let dateDebutPromo = document.querySelector("#dateDebutPromo").value;
  let dateFinPromo = document.querySelector("#dateFinPromo").value;
  let placePromo = document.querySelector("#placePromo").value;
  let messageErreurCreaPromo = document.querySelector(
    ".messageErreurCreaPromo"
  );

  if (
    nomPromo !== "" &&
    dateDebutPromo !== "" &&
    dateFinPromo !== "" &&
    placePromo !== ""
  ) {
    messageErreurCreaPromo.innerText = "";
    if (placePromo > 0 && placePromo < 200) {
      messageErreurCreaPromo.innerText = "";
      sauvegarderPromo(nomPromo, dateDebutPromo, dateFinPromo, placePromo);
    } else {
      messageErreurCreaPromo.innerText =
        "Merci renter un nombre de place correcte";
    }
  } else {
    messageErreurCreaPromo.innerText = "Merci de remplir tous les champs";
  }
}

function sauvegarderPromo(nomPromo, dateDebutPromo, dateFinPromo, placePromo) {
  let promo = {
    nomPromo: nomPromo,
    dateDebutPromo: dateDebutPromo,
    dateFinPromo: dateFinPromo,
    placePromo: placePromo,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(promo),
  };

  fetch(HOME_URL + "tableaudebordFormateur/promotions/newpromo", params)
    .then((res) => res.text())
    .then((data) => {
      reponseCreationPromo(JSON.parse(data));
    });
}

function reponseCreationPromo(reponse) {
  if (reponse["status"] == "success") {
    document.querySelector(".messageReussite").innerText = reponse["message"];

    document.querySelector(".messageReussite").classList.remove("hidden");
    setTimeout(() => {
      document.querySelector(".messageReussite").classList.add("hidden");
    }, 4000);

    recupererPromos();

    document.querySelector(".Promotions").classList.remove("hidden");
    document.querySelector(".creerPromo").classList.add("hidden");
    document.querySelector(".editerPromo").classList.add("hidden");
  } else if (reponse["status"] == "error") {
    document.querySelector(".messageErreurCreaPromo").innerText =
      reponse["message"];
  }
}

//////////////// Edition promotion ////////////////
function afficherEditPromo(idPromo) {
  document.querySelector(".Promotions").classList.add("hidden");
  document.querySelector(".editerPromo").classList.remove("hidden");

  afficherValueEdit(idPromo);
}

function fermerEditPromo() {
  document.querySelector(".Promotions").classList.remove("hidden");
  document.querySelector(".editerPromo").classList.add("hidden");
}

function afficherValueEdit(idPromo) {
  let promo = {
    idPromo: idPromo,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(promo),
  };

  fetch(
    HOME_URL + "tableaudebordFormateur/promotions/affichereditpromo",
    params
  )
    .then((res) => res.text())
    .then((data) => {
      promo = JSON.parse(data);
      remplirValueEdit(promo);
      document.querySelector(".promoSpanEdition").innerText =
        promo["Nom_promo"];
    });
}

function remplirValueEdit(promo) {
  document.querySelector(".editerPromoForm").innerHTML =
    `<label class="my-2" for="nomPromoEdit">Nom de la promotion</label>
            <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="text" id='nomPromoEdit' name="nomPromoEdit" value='` +
    promo["Nom_promo"] +
    `'>

            <label class="my-2" for="dateDebutPromoEdit">Date de début</label>
            <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="date" id='dateDebutPromoEdit' name="dateDebutPromoEdit" value='` +
    promo["DateDebut_promo"] +
    `'>

            <label class="my-2" for="dateFinPromoEdit">Date de fin</label>
            <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="date" id='dateFinPromoEdit' name="dateFinPromoEdit" value='` +
    promo["DateFin_promo"] +
    `'>

            <label class="my-2" for="placePromoEdit">Place(s) disponible(s)</label>
            <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="number" id='placePromoEdit' name="placePromoEdit" min=1 value='` +
    promo["Place_promo"] +
    `'>
            <div class="messageErreurEditPromo text-[#ff0000] text-center text-lg"> </div>

            <div class="flex justify-between">
                <button class="btnRetourEditPromo py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 my-4" onclick="fermerEditPromo()">
                    Retour
                </button>
                <div class="flex">
                    <button class="btnSupprPromo py-1.5 px-3 bg-[#ff0000] gap-2 rounded text-white w-fit font-bold right-0 mt-4 mx-6" onclick="supprimerPromo(` +
    promo["Id_promo"] +
    `)">
                        Supprimer
                    </button>
                    <button class="btnSauvegarderEditPromo py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4" onclick="verifChampsEditPromo(` +
    promo["Id_promo"] +
    `)">
                        Sauvegarder
                    </button>
                </div>
            </div>`;
}

function verifChampsEditPromo(Id_promo) {
  let nomPromoEdit = document.querySelector("#nomPromoEdit").value;
  let dateDebutPromoEdit = document.querySelector("#dateDebutPromoEdit").value;
  let dateFinPromoEdit = document.querySelector("#dateFinPromoEdit").value;
  let placePromoEdit = document.querySelector("#placePromoEdit").value;

  let messageErreurEditPromo = document.querySelector(
    ".messageErreurEditPromo"
  );

  if (
    nomPromoEdit !== "" &&
    dateDebutPromoEdit !== "" &&
    dateFinPromoEdit !== "" &&
    placePromoEdit !== ""
  ) {
    messageErreurEditPromo.innerText = "";
    if (placePromoEdit > 0 && placePromoEdit < 200) {
      messageErreurEditPromo.innerText = "";
      editerPromo(
        Id_promo,
        nomPromoEdit,
        dateDebutPromoEdit,
        dateFinPromoEdit,
        placePromoEdit
      );
    } else {
      messageErreurEditPromo.innerText =
        "Merci renter un nombre de place correcte";
    }
  } else {
    messageErreurEditPromo.innerText = "Merci de remplir tous les champs";
  }
}

function editerPromo(
  Id_promo,
  nomPromoEdit,
  dateDebutPromoEdit,
  dateFinPromoEdit,
  placePromoEdit
) {
  let promo = {
    Id_promo: Id_promo,
    nomPromoEdit: nomPromoEdit,
    dateDebutPromoEdit: dateDebutPromoEdit,
    dateFinPromoEdit: dateFinPromoEdit,
    placePromoEdit: placePromoEdit,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(promo),
  };

  fetch(HOME_URL + "tableaudebordFormateur/promotions/editpromo", params)
    .then((res) => res.text())
    .then((data) => {
      reponseCreationPromo(JSON.parse(data));
    });
}

function reponseEditPromo(reponse) {
  if (reponse["status"] == "success") {
    document.querySelector(".messageReussite").innerText = reponse["message"];

    document.querySelector(".messageReussite").classList.remove("hidden");
    setTimeout(() => {
      document.querySelector(".messageReussite").classList.add("hidden");
    }, 4000);

    recupererPromos();

    document.querySelector(".Promotions").classList.remove("hidden");
    document.querySelector(".creerPromo").classList.add("hidden");
    document.querySelector(".editerPromo").classList.add("hidden");
  } else if (reponse["status"] == "error") {
    document.querySelector(".messageErreurCreaPromo").innerText =
      reponse["message"];
  }
}
//////////////// Supprimer Promo ////////////////

function supprimerPromo(idPromo) {
  let promo = {
    Id_promo: idPromo,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(promo),
  };

  fetch(HOME_URL + "tableaudebordFormateur/promotions/supprpromo", params)
    .then((res) => res.text())
    .then((data) => {
      reponseEditPromo(JSON.parse(data));
    });
}
