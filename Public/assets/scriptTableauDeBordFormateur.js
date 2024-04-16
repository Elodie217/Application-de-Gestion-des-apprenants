function afficherSectionAccueil() {
  document.querySelector(".Accueil").classList.remove("hidden");

  document.querySelector(".Promotions").classList.add("hidden");
}

//Affichage des boutons suivant la date et l'heure

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
      if (signatureEffectuee == 1) {
        signatureFormateur(idCours);
      } else {
        //Ici le cours est en ce moment
        afficherBtn(
          "btnValiserPresence",
          "btnValiserPresenceDesactive",
          "btnSignaturesEnCours",
          "btnSignaturesRecueillies",
          idCours
        );
      }
    } else {
      //Ici le cours est fini
      afficherBtn(
        "btnSignaturesRecueillies",
        "btnValiserPresence",
        "btnValiserPresenceDesactive",
        "btnSignaturesEnCours",
        idCours
      );
    }
  } else {
    //Ici le cours est à venir

    afficherBtn(
      "btnValiserPresenceDesactive",
      "btnValiserPresence",
      "btnSignaturesEnCours",
      "btnSignaturesRecueillies",
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

// Afficher API

function afficherAccueil(CoursPromo) {
  CoursPromo.forEach((element) => {
    document.querySelector(".sectionCoursF").innerHTML +=
      `<section class="flex flex-col bg-[#f1f0f0] rounded-[3px] px-[25px] py-[45px] my-6">
       <div class="flex justify-between">
                <div>
                    <h2 class="promoFormateur text-[32px]">` +
      element["Nom_promo"] +
      ` - ` +
      plageHorraire(element["HeureDebut_cours"]) +
      `</h2>
                    <p class="placePromoF my-5">` +
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
            <div class="flex flex-col items-end ">
        <div class="codeCours` +
      element["Id_cours"] +
      ` font-bold text-[32px]">  </div>
        <button
          class="btnValiserPresence` +
      element["Id_cours"] +
      ` hidden py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4"
          onclick='signatureFormateur(` +
      element["Id_cours"] +
      `)'
        >
          Valider présence
        </button>
        <p
          class="btnValiserPresenceDesactive` +
      element["Id_cours"] +
      ` py-1.5 px-3 bg-[#6c757d] gap-2 rounded text-white w-fit font-bold right-0 mt-4">
          Valider présence
        </p>
        <p
          class="btnSignaturesRecueillies` +
      element["Id_cours"] +
      ` py-1.5 px-3 bg-[#198754] gap-2 rounded text-white w-fit font-bold right-0 mt-4">
          Signatures recueillies
        </p>
        <p
          class="btnSignaturesEnCours` +
      element["Id_cours"] +
      ` py-1.5 px-3 bg-[#ffc107] gap-2 rounded w-fit font-bold right-0 mt-4">
          Signatures en cours
        </p>
      </div>
            
          </section>`;

    // heureActuelle(
    //   element["HeureDebut_cours"],
    //   element["HeureFin_cours"],
    //   element["Id_cours"]
    // );
    verificationCreaCode(
      element["HeureDebut_cours"],
      element["HeureFin_cours"],
      element["Id_cours"]
    );
  });

  function plageHorraire(heure) {
    if (heure == "09:00:00") {
      return "Matin";
    } else if (heure == "13:00:00") {
      return "Après-midi";
    }
  }
}

// Récupérer API

recupererCoursPromo();
function recupererCoursPromo() {
  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/accueil"
  )
    .then((res) => res.text())
    .then((data) => {
      courspromo = JSON.parse(data);
      afficherAccueil(courspromo);
    });
}

//Signature Formateur
function signatureFormateur(Id_cours) {
  afficherBtn(
    "btnSignaturesEnCours",
    "btnValiserPresenceDesactive",
    "btnValiserPresence",
    "btnSignaturesRecueillies",
    Id_cours
  );

  // Récupération du code
  let Cours = {
    Id_cours: Id_cours,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(Cours),
  };

  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/accueil/code",
    params
  )
    .then((res) => res.json())
    .then((data) => {
      let code = JSON.parse(data);

      document.querySelector(".codeCours" + Id_cours).innerHTML = code;
    });
}

//Vérification création code
function verificationCreaCode(HeureDebut_cours, HeureFin_cours, idCours) {
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
    "http://applicationgestionapprenants2/public/tableaudebordFormateur/accueil/verifcodecreer",
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
