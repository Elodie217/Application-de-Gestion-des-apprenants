 <div class="flex">
     <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Accueil</button>
     <button onclick="afficherSectionPromotions()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</button>

     <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
 </div>
 <div class="my-10">
     <h3 class="text-2xl my-4">Création d'une promotion <span class="promoSpan"></span></h3>
 </div>
 <section class="flex flex-col bg-[#f1f0f0] rounded-[3px] px-[25px] py-[45px] my-6">
     <label class="my-2" for="nomPromo">Nom de la promotion</label>
     <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="text" id='nomPromo' name="nomPromo">

     <label class="my-2" for="dateDebutPromo">Date de début</label>
     <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="date" id='dateDebutPromo' name="dateDebutPromo">

     <label class="my-2" for="dateFinPromo">Date de fin</label>
     <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="date" id='dateFinPromo' name="dateFinPromo">

     <label class="my-2" for="placePromo">Place(s) disponible(s)</label>
     <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="number" id='placePromo' name="placePromo" min=1>
     <div class="messageErreurCreaPromo text-[#ff0000] text-center text-lg"> </div>

     <div class="flex justify-between">
         <button class="btnRetourCreaPromo py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 my-4" onclick="fermercreerPromo()">
             Retour
         </button>
         <button class="btnSauvegarderCreaPromo py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 mt-4" onclick="verifChampsPromo()">
             Sauvegarder
         </button>
     </div>
 </section>