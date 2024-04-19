//////////////// Retards ////////////////
function afficherSectionRetards(idPromo) {
  afficherSection("VoirRetards", "VoirAbsences", "VoirPromotion", "Promotions");

  console.log(idPromo);
  recupererRetards(idPromo);
}

function recupererRetards(idPromo) {
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

  fetch(HOME_URL + "tableaudebordFormateur/retards", params)
    .then((res) => res.text())
    .then((data) => {
      console.log(JSON.parse(data));
      afficherRetards(JSON.parse(data));
    });
}

function afficherRetards(Apprenants) {
  document.querySelector(".tableauBodyTablR").innerHTML = ``;

  Apprenants.forEach((element) => {
    document.querySelector(".tableauBodyTablR").innerHTML +=
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
                        <td class="RoleR` +
      element["Id_utilisateur"] +
      ` px-6 py-4"></td>
                        <td class="px-6 py-4">
                            <button class="text-[#0D6EFD] mx-2" onclick="afficherEditApprenant(` +
      element["Id_utilisateur"] +
      `)">Editer</button>
                            <button class="text-[#0D6EFD] mx-2" onclick="supprimerApprenant(` +
      element["Id_utilisateur"] +
      `)">Supprimer</button>
                        </td>
                    </tr>`;

    recupererRoles(element["Id_role"], element["Id_utilisateur"]);
  });
}

//////////////// Abs ////////////////
function afficherSectionAbs() {
  afficherSection("VoirAbsences", "VoirPromotion", "Promotions", "VoirRetards");
}
