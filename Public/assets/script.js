let messageErreurConnexion = document.querySelector(".messageErreurConnexion");

function verificationconnexion() {
  let email = document.querySelector("#email").value;
  let mdp = document.querySelector("#motDePasse").value;
  if (email !== "" && mdp !== "") {
    messageErreurConnexion.innerText = "";
    if (checkEmail(email)) {
      messageErreurConnexion.innerText = "";
      connexion(email, mdp);
    } else {
      messageErreurConnexion.innerText = "Merci de remplir un email valide";
    }
  } else {
    messageErreurConnexion.innerText = "Merci de remplir tous les champs";
  }
}

function checkEmail(email) {
  let re =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function connexion(email, mdp) {
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

  fetch(HOME_URL + "connexion", params)
    .then((res) => res.text())
    .then((data) => reponseConnexion(JSON.parse(data)));
}

function reponseConnexion(reponse) {
  if (reponse["status"] == "success") {
    if (reponse["role"] == 1) {
      window.location.href = HOME_URL + `tableaudebordApprenant`;
    } else if (reponse["role"] == 2) {
      window.location.href = HOME_URL + `tableaudebordFormateur`;
    }
  } else if (reponse["status"] == "error") {
    messageErreurConnexion.innerText = reponse["message"];
  }
}
