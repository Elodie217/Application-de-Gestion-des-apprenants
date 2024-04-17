recupererCoursPromoApprenant();

//Date du jour
let dateDuJour = new Date();
let dateDuJourJour = dateDuJour.getDate();
if (dateDuJourJour < 9) {
  dateDuJourJour = "0" + dateDuJourJour;
}

let dateDuJourMois = dateDuJour.getMonth() + 1;
if (dateDuJourMois < 9) {
  dateDuJourMois = "0" + dateDuJourMois;
}
let dateDuJourAnnee = dateDuJour.getFullYear();

//Afiichage btns
function heureActuelle(
  heureDebutCoursEntier,
  heureFinCoursEntier,
  idCours,
  signatureEffectuee = 0
) {
  let heureActuelle = dateDuJour.getHours();
  let minuteActuelle = dateDuJour.getMinutes();
  let secondeActuelle = dateDuJour.getSeconds();

  // Séparer l'heure donnée en heures, minutes et secondes
  let [heureDonneeHDebut, minuteDonneeDebut, secondeDonneeDebut] =
    heureDebutCoursEntier.split(":").map(Number);
  let [heureDonneeHFin, minuteDonneeFin, secondeDonneeFin] = heureFinCoursEntier
    .split(":")
    .map(Number);

  // Comparer les heures, les minutes et les secondes
  if (
    heureActuelle > heureDonneeHDebut ||
    (heureActuelle === heureDonneeHDebut &&
      minuteActuelle > minuteDonneeDebut) ||
    (heureActuelle === heureDonneeHDebut &&
      minuteActuelle === minuteDonneeDebut &&
      secondeActuelle > secondeDonneeDebut)
  ) {
    //Ici le début du cours est passé

    if (
      heureActuelle < heureDonneeHFin ||
      (heureActuelle === heureDonneeHFin && minuteActuelle < minuteDonneeFin) ||
      (heureActuelle === heureDonneeHFin &&
        minuteActuelle === minuteDonneeFin &&
        secondeActuelle < secondeDonneeFin)
    ) {
      if (
        heureActuelle > heureDonneeHDebut ||
        (heureActuelle === heureDonneeHDebut &&
          minuteActuelle > minuteDonneeDebut + 15) ||
        (heureActuelle === heureDonneeHDebut &&
          minuteActuelle === minuteDonneeDebut + 15 &&
          secondeActuelle > secondeDonneeDebut)
      ) {
        //Ici le cours à commencé depuis 15min
        if (signatureEffectuee == 1) {
          //La signature à déja été faite
          afficherBtn(
            "signatureValidee",
            "btnValiderPresenceAppRetard",
            "btnValiderAppr",
            "btnValiderPresenceAppDesactive",
            idCours
          );
          document
            .querySelector(".CodeApprenant" + idCours)
            .classList.add("hidden");
        } else {
          afficherBtn(
            "btnValiderPresenceAppRetard",
            "btnValiderAppr",
            "btnValiderPresenceAppDesactive",
            "signatureValidee",
            idCours
          );
        }
      } else {
        //Ici le cours est en ce moment
        if (signatureEffectuee == 1) {
          //La signature à déja été faite
          afficherBtn(
            "signatureValidee",
            "btnValiderPresenceAppRetard",
            "btnValiderAppr",
            "btnValiderPresenceAppDesactive",
            idCours
          );
          document
            .querySelector(".CodeApprenant" + idCours)
            .classList.add("hidden");
        } else {
          afficherBtn(
            "btnValiderAppr",
            "btnValiderPresenceAppDesactive",
            "btnValiderPresenceAppRetard",
            "signatureValidee",
            idCours
          );
        }
      }
    } else {
      //Ici le cours est fini
      document
        .querySelector(".CodeApprenant" + idCours)
        .classList.add("hidden");

      afficherBtn(
        "signatureValidee",
        "btnValiderAppr",
        "btnValiderPresenceAppDesactive",
        "btnValiderPresenceAppRetard",
        idCours
      );
    }
  } else {
    //Ici le cours est à venir

    afficherBtn(
      "btnValiderPresenceAppDesactive",
      "btnValiderAppr",
      "btnValiderPresenceAppRetard",
      "signatureValidee",
      idCours
    );
  }
}

function afficherBtn(
  btnAAfficher,
  btnACacher1,
  btnACacher2,
  btnACacher3,
  idCours
) {
  document
    .querySelector("." + btnAAfficher + idCours)
    .classList.remove("hidden");
  document.querySelector("." + btnACacher1 + idCours).classList.add("hidden");
  document.querySelector("." + btnACacher2 + idCours).classList.add("hidden");
  document.querySelector("." + btnACacher3 + idCours).classList.add("hidden");
}

function verificationSignature(HeureDebut_cours, HeureFin_cours, idCours) {
  let Cours = {
    Id_cours: idCours,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(Cours),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordApprenant/accueil/verifsignature",
    params
  )
    .then((res) => res.text())
    .then((data) => {
      let messageRetour = JSON.parse(data);
      if (messageRetour["status"] == "signe") {
        heureActuelle(HeureDebut_cours, HeureFin_cours, idCours, 1);
      } else {
        heureActuelle(HeureDebut_cours, HeureFin_cours, idCours);
      }
    });
}

// Afficher API

function afficherAccueilApprenant(CoursPromo) {
  CoursPromo.forEach((element) => {
    document.querySelector(".sectionCoursA").innerHTML +=
      `<section class="flex flex-col bg-[#f1f0f0] rounded-[3px] px-[25px] py-[45px]">
                <div class="flex justify-between">
                    <div>
                        <h2 class="promoApprenant text-[32px]">` +
      element["Nom_promo"] +
      ` - ` +
      plageHorraire(element["HeureDebut_cours"]) +
      `</h2>
                        <p class="placePromo my-5">` +
      element["Place_promo"] +
      ` participants</p>
                    </div>
                    <p class="dateDuJour font-bold">` +
      dateDuJourJour +
      `-` +
      dateDuJourMois +
      `-` +
      dateDuJourAnnee +
      `</p>
                </div>
                <div class="flex flex-col">
                    <label for="code">Code *</label>
                    <input class="CodeApprenant` +
      element["Id_cours"] +
      `  py-1.5 px-3 border-[1px] border-[#CED4DA] my-4" type="number" id="code" name="code" placeholder="......">
            <div class="messageErreurApprenant` +
      element["Id_cours"] +
      ` text-[#ff0000] text-lg"> </div>

                    <div class="flex flex-col items-end my-4">
                        <button onclick='validerPresenceA(` +
      element["Id_cours"] +
      `)' class="btnValiderAppr` +
      element["Id_cours"] +
      `  py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4">Valider présence</button>
                        <p
                        class="signatureValidee` +
      element["Id_cours"] +
      ` hidden py-1.5 px-3 bg-[#198754] gap-2 rounded text-white w-fit font-bold right-0 mt-4">
                        Signature validée
                      </p>
                      <p
                    class="btnValiderPresenceAppDesactive` +
      element["Id_cours"] +
      ` py-1.5 px-3 bg-[#6c757d] gap-2 rounded text-white w-fit font-bold right-0 mt-4">
                      Valider présence
                    </p>
                    <button onclick='validerPresenceARetard(` +
      element["Id_cours"] +
      `)'
                    class="btnValiderPresenceAppRetard` +
      element["Id_cours"] +
      ` py-1.5 px-3 bg-[#ff1212] gap-2 rounded text-white w-fit font-bold right-0 mt-4">
                      Valider présence (retard)
                    </button>
                    </div>
                </div>
            </section>`;

    verificationSignature(
      element["HeureDebut_cours"],
      element["HeureFin_cours"],
      element["Id_cours"]
    );
  });
}

function plageHorraire(heure) {
  if (heure == "09:00:00") {
    return "Matin";
  } else if (heure == "13:00:00") {
    return "Après-midi";
  }
}

function recupererCoursPromoApprenant() {
  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordApprenant/accueil"
  )
    .then((res) => res.text())
    .then((data) => {
      courspromo = JSON.parse(data);
      afficherAccueilApprenant(courspromo);
    });
}

// Présence
function validerPresenceA(idCours) {
  let CodeCours = document.querySelector(".CodeApprenant" + idCours).value;
  let messageErreurApprenant = document.querySelector(
    ".messageErreurApprenant" + idCours
  );

  if (CodeCours.length == 5) {
    messageErreurApprenant.innerText = "";
    let Cours = {
      Id_cours: idCours,
      Code_cours: CodeCours,
    };

    let params = {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(Cours),
    };

    fetch(
      "http://applicationgestionapprenants2/public/tableaudebordApprenant/accueil/code",
      params
    )
      .then((res) => res.text())
      .then((data) => {
        let messageRetour = JSON.parse(data);
        presenceValidee(messageRetour, idCours);
      });
  } else {
    messageErreurApprenant.innerText = "Merci de rentrer un code valide";
  }
}

function presenceValidee(messageRetour, idCours) {
  if (messageRetour["status"] == "success") {
    document.querySelector(".messageErreurApprenant" + idCours).innerText = "";
    document.querySelector(".CodeApprenant" + idCours).classList.add("hidden");
    document.querySelector(".btnValiderAppr" + idCours).classList.add("hidden");
    document
      .querySelector(".btnValiderPresenceAppRetard" + idCours)
      .classList.add("hidden");
    document
      .querySelector(".signatureValidee" + idCours)
      .classList.remove("hidden");
  } else {
    document.querySelector(".messageErreurApprenant" + idCours).innerText =
      messageRetour["message"];
  }
}

//Présence mais retard
function validerPresenceARetard(idCours) {
  let CodeCours = document.querySelector(".CodeApprenant" + idCours).value;

  let Cours = {
    Id_cours: idCours,
    Code_cours: CodeCours,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(Cours),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordApprenant/accueil/codeRetard",
    params
  )
    .then((res) => res.text())
    .then((data) => {
      let messageRetour = JSON.parse(data);
      presenceValidee(messageRetour, idCours);
    });
}

//Deconnexion
function deconnexion() {
  fetch("http://applicationgestionapprenants2/public/deconnexion")
    .then((res) => res.text())
    .then((data) => {
      if (data) {
        window.location.href = `http://applicationgestionapprenants2/public/`;
      }
    });
}
