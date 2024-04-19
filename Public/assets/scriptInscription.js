let url = document.location.href;

url = url.replace(/\/$/, "");

let fin_url = url.substring(url.lastIndexOf("/") + 1);
console.log(fin_url);

let messageErreurInscription = document.querySelector(
  ".messageErreurInscription"
);

function verificationInscription() {
  let mdpInscription = document.querySelector("#creermotDePasse").value;
  let mdpConfirmation = document.querySelector("#cofimationmotDePasse").value;

  if (mdpInscription !== "" && mdpConfirmation !== "") {
    if (mdpInscription.length >= 6 && mdpConfirmation.length >= 6) {
      messageErreurInscription.innerText = "";
      if (mdpInscription == mdpConfirmation) {
        messageErreurInscription.innerText = "";

        inscription(mdpInscription, mdpConfirmation, fin_url);
      } else {
        messageErreurInscription.innerText =
          "Les mots de passe sont différents";
      }
    } else {
      messageErreurInscription.innerText =
        "Les mots de passe doivent contenir au moins à 6 caractères.";
    }
  } else {
    messageErreurInscription.innerText = "Merci de remplir tous les champs.";
  }
}

function inscription(mdpInscription, mdpConfirmation, fin_url) {
  let userInscription = {
    mdpInscription: mdpInscription,
    mdpConfirmation: mdpConfirmation,
    fin_url: fin_url,
  };

  let params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(userInscription),
  };

  fetch(HOME_URL + "sinscrire/inscription", params)
    .then((res) => res.text())
    .then((data) => reponseInscription(JSON.parse(data)));
}

function reponseInscription(reponse) {
  if (reponse["status"] == "success") {
    window.location.href = HOME_URL + ``;
  } else if (reponse["status"] == "error") {
    messageErreurInscription.innerText = reponse["message"];
  }
}
