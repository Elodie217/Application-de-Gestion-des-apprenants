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

// Afficher API

function afficherAccueilApprenant(CoursPromo) {
  CoursPromo.forEach((element) => {
    document.querySelector(".sectionCoursA").innerHTML +=
      `<section class="flex flex-col bg-[#F8F9FA] rounded-[3px] px-[25px] py-[45px]">
                <div class="flex justify-between">
                    <div>
                        <h2 class="promoApprenant text-[32px]">` +
      element["Nom_promo"] +
      `</h2>
                        <p class="placePromo my-5">` +
      element["Place_promo"] +
      `</p>
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
                    <input class="CodeApprenant py-1.5 px-3 border-[1px] border-[#CED4DA] my-4" type="number" id="code" name="code" placeholder="......">
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
                    </div>
                </div>
            </section>`;
  });
}

function recupererCoursPromoApprenant() {
  fetch(
    "http://applicationgestionapprenants2/public/tableaudebordApprenant/accueil"
  )
    .then((res) => res.text())
    .then((data) => {
      courspromo = JSON.parse(data);
      console.log(courspromo);
      afficherAccueilApprenant(courspromo);
    });
}

// Présence
function validerPresenceA(idCours) {
  let CodeCours = document.querySelector(".CodeApprenant").value;

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
      console.log(messageRetour);
      presenceValidee(messageRetour, idCours);
    });
}

function presenceValidee(messageRetour, idCours) {
  if (messageRetour["status"] == "success") {
    document.querySelector(".CodeApprenant").classList.add("hidden");
    document.querySelector(".btnValiderAppr" + idCours).classList.add("hidden");
    document
      .querySelector(".signatureValidee" + idCours)
      .classList.remove("hidden");
  } else {
    //Afficher message dans une div
  }
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
