function verificationconnexion() {
  let email = document.querySelector("#email").value;
  let mdp = document.querySelector("#motDePasse").value;

  if (email !== "" && mdp !== "") {
    if (checkEmail(email)) {
      connexion(email, mdp);
    } else {
      // afficher message erreur mail
    }
  } else {
    // afficher un message de champ vide
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

  fetch("http://applicationgestionapprenants2/public/connexion", params)
    .then((res) => res.text())
    .then((data) => reponseConnexion(JSON.parse(data)));
}

function reponseConnexion(reponse) {
  if (reponse["status"] == "success") {
    console.log("success");
    window.location.href = `http://applicationgestionapprenants2/public/tableaudebord`;
  } else if (reponse["status"] == "error") {
    console.log(reponse["message"]);
  }
}
