function afficherCreaApprenant(idPromo, nomPromo) {
  document.querySelector(".VoirPromotion").classList.add("hidden");
  document.querySelector(".creerApprenant").classList.remove("hidden");

  document.querySelector(".btnsCreaApprenant").innerHTML =
    `<button class="btnRetourCreaApprenant py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4" onclick="fermercreerApprenant()">
              Retour
          </button>
          <button class="btnSauvegarderCreaApprenant py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4" onclick="verifChampsApprenant(` +
    idPromo +
    `, '` +
    nomPromo +
    `')">
              Sauvegarder
          </button>`;
}
function fermercreerApprenant() {
  document.querySelector(".VoirPromotion").classList.remove("hidden");
  document.querySelector(".creerApprenant").classList.add("hidden");
}

//////////Création Apprenant //////////

function verifChampsApprenant(idPromo, nomPromo) {
  let nomApprenant = document.querySelector("#nomApprenant").value;
  let prenomApprenant = document.querySelector("#prenomApprenant").value;
  let emailApprenant = document.querySelector("#emailApprenant").value;
  let roleApprenant = document.querySelector("#roleApprenant").value;
  let messageErreurCreaApprenant = document.querySelector(
    ".messageErreurCreaApprenant"
  );

  if (nomApprenant !== "" && prenomApprenant !== "" && emailApprenant !== "") {
    messageErreurCreaApprenant.innerText = "";

    if (checkEmail(emailApprenant)) {
      messageErreurCreaApprenant.innerText = "";
      sauvegarderApprenant(
        nomApprenant,
        prenomApprenant,
        emailApprenant,
        roleApprenant,
        idPromo,
        nomPromo
      );
    } else {
      messageErreurCreaApprenant.innerText = "Merci de remplir un email valide";
    }
  } else {
    messageErreurCreaApprenant.innerText = "Merci de remplir tous les champs";
  }
}

function checkEmail(email) {
  let re =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function sauvegarderApprenant(
  nomApprenant,
  prenomApprenant,
  emailApprenant,
  roleApprenant,
  idPromo,
  nomPromo
) {
  let Apprenant = {
    nomApprenant: nomApprenant,
    prenomApprenant: prenomApprenant,
    emailApprenant: emailApprenant,
    roleApprenant: roleApprenant,
    idPromo: idPromo,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(Apprenant),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/apprenants/newapprenant",
    params
  )
    .then((res) => res.text())
    .then((data) => {
      console.log(data);
      reponseCreationApprenant(JSON.parse(data), idPromo, nomPromo);
    });
}

function reponseCreationApprenant(reponse, idPromo, nomPromo) {
  if (reponse["status"] == "success") {
    document.querySelector(".messageReussite").innerText = reponse["message"];

    document.querySelector(".messageReussite").classList.remove("hidden");
    setTimeout(() => {
      document.querySelector(".messageReussite").classList.add("hidden");
    }, 4000);

    recupererPromos();

    document.querySelector(".VoirPromotion").classList.remove("hidden");
    document.querySelector(".creerApprenant").classList.add("hidden");
    document.querySelector(".editApprenant").classList.add("hidden");
    voirPromo(idPromo, nomPromo);
  } else if (reponse["status"] == "error") {
    document.querySelector(".messageErreurCreaApprenant").innerText =
      reponse["message"];
  }
}

///////////Affichage Edition Apprenant////////////
function afficherEditApprenant(idApprenant, idPromo, nomPromo) {
  console.log("dans afficher Apprennant");

  document.querySelector(".VoirPromotion").classList.add("hidden");
  document.querySelector(".editApprenant").classList.remove("hidden");

  recupererValueApprenant(idApprenant, idPromo, nomPromo);
}

function fermerEditApprenant() {
  document.querySelector(".VoirPromotion").classList.remove("hidden");
  document.querySelector(".editApprenant").classList.add("hidden");
}

function recupererValueApprenant(idApprenant, idPromo, nomPromo) {
  let apprenant = {
    idApprenant: idApprenant,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(apprenant),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/apprenants/affichereditapprenant",
    params
  )
    .then((res) => res.text())
    .then((data) => {
      apprenant = JSON.parse(data);
      remplirValueEditApp(apprenant, idPromo, nomPromo);
      document.querySelector(".apprenantSpanEdition").innerHTML =
        apprenant["Nom_utilisateur"] + " " + apprenant["Prenom_utilisateur"];
    });
}

function remplirValueEditApp(apprenant, idPromo, nomPromo) {
  document.querySelector(".editerApprenantForm").innerHTML =
    `<label class="my-2" for="nomApprenantEdit">Nom</label>
    <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="text" id='nomApprenantEdit' name="nomApprenantEdit" value=` +
    apprenant["Nom_utilisateur"] +
    `>

    <label class="my-2" for="prenomApprenantEdit">Prénom</label>
    <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="text" id='prenomApprenantEdit' name="prenomApprenantEdit" value=` +
    apprenant["Prenom_utilisateur"] +
    `>

    <label class="my-2" for="emailApprenantEdit">Adresse email</label>
    <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="email" id='emailApprenantEdit' name="emailApprenantEdit" value=` +
    apprenant["Email_utilisateur"] +
    `>

    <div>
    <input class="inputCompteAppr mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="checkbox" id='activeApprenantEdit' name="activeApprenantEdit" ` +
    compteActive(apprenant["Activiation_utilisateur"]) +
    `>
    <label class="my-2" for="activeApprenantEdit">Compte activé</label>
    </div>  

    <div class="messageErreurEditApprenant text-[#ff0000] text-center text-lg"> </div>

    <div class="flex justify-between">
                <button class="btnRetourEditPromo py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4" onclick="fermerEditApprenant()">
                    Retour
                </button>
                <div class="flex">
                    <button class="btnSupprPromo py-1.5 px-3 bg-[#ff0000] gap-2 rounded text-white w-fit font-bold right-0 mt-4 mx-6" onclick="supprimerApprenant(` +
    apprenant["Id_utilisateur"] +
    `, ` +
    idPromo +
    `, '` +
    nomPromo +
    `')">
                        Supprimer
                    </button>
                    <button class="btnSauvegarderEditAppr py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4" onclick="verifChampsEditAppr(` +
    apprenant["Id_utilisateur"] +
    `, ` +
    idPromo +
    `, '` +
    nomPromo +
    `'
    )">
                        Sauvegarder
                    </button>
                </div>`;
}

function compteActive(compte) {
  if (compte == 1) {
    return "checked";
  }
}

///////////Edition Apprenant////////////

function verifChampsEditAppr(Id_utilisateur, idPromo, nomPromo) {
  let nomApprenantEdit = document.querySelector("#nomApprenantEdit").value;
  let prenomApprenantEdit = document.querySelector(
    "#prenomApprenantEdit"
  ).value;
  let emailApprenantEdit = document.querySelector("#emailApprenantEdit").value;
  let inputCompteAppr = document.querySelector(".inputCompteAppr");
  let messageErreurEditApprenant = document.querySelector(
    ".messageErreurEditApprenant"
  );

  let compteApprenantEdit = 0;
  if (inputCompteAppr.checked == true) {
    compteApprenantEdit = 1;
  }

  if (
    nomApprenantEdit !== "" &&
    prenomApprenantEdit !== "" &&
    emailApprenantEdit !== ""
  ) {
    messageErreurEditApprenant.innerText = "";

    if (checkEmail(emailApprenantEdit)) {
      messageErreurEditApprenant.innerText = "";
      editApprenant(
        Id_utilisateur,
        nomApprenantEdit,
        prenomApprenantEdit,
        emailApprenantEdit,
        compteApprenantEdit,
        idPromo,
        nomPromo
      );
    } else {
      messageErreurEditApprenant.innerText = "Merci de remplir un email valide";
    }
  } else {
    messageErreurEditApprenant.innerText = "Merci de remplir tous les champs";
  }
}

function editApprenant(
  Id_utilisateur,
  nomApprenantEdit,
  prenomApprenantEdit,
  emailApprenantEdit,
  compteApprenantEdit,
  idPromo,
  nomPromo
) {
  let Apprenant = {
    Id_utilisateur: Id_utilisateur,
    nomApprenantEdit: nomApprenantEdit,
    prenomApprenantEdit: prenomApprenantEdit,
    emailApprenantEdit: emailApprenantEdit,
    compteApprenantEdit: compteApprenantEdit,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(Apprenant),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/apprenants/editapprenant",
    params
  )
    .then((res) => res.text())
    .then((data) => {
      reponseCreationApprenant(JSON.parse(data), idPromo, nomPromo);
    });
}

// console.log(HOME_URL);
//////////////// Supprimer Promo ////////////////

function supprimerApprenant(idApprenant, idPromo, nomPromo) {
  let apprenant = {
    Id_apprenant: idApprenant,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(apprenant),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/apprenants/supprappr",
    params
  )
    .then((res) => res.text())
    .then((data) => {
      reponseCreationApprenant(JSON.parse(data), idPromo, nomPromo);
    });
}
