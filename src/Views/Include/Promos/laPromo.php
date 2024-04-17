 <div class="flex">
     <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Accueil</button>
     <button onclick="afficherSectionPromotions()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</button>

     <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
 </div>

 <div class="my-10">
     <div class="divBtnCreaApprenant flex justify-between">

     </div>
     <p>Informations générales de la <span class="promoSpan"></span></p>
 </div>


 <div class="flex divBtnSousMenuTableau">
     <!-- <button onclick="afficherSectionTableauA()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6] w-96 md:w-80 lg:w-64 ">Tableau apprenants</button>
     <button onclick="afficherSectionRetards()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD] ">Retards</button>
     <button onclick="afficherSectionAbs()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Absences</button>

     <div class="w-full border-b-[1px] border-[#DEE2E6]"></div> -->
 </div>

 <!-- Table responsive wrapper -->
 <section class="overflow-x-auto bg-white">

     <!-- Table -->
     <table class="min-w-full text-left whitespace-nowrap" style="width: 100%;">

         <!-- Table head -->
         <thead class=" tracking-wider border-b-2 border-black">
             <tr>
                 <th scope="col" class="px-6 py-4 font-bold" style="width: 5%;">
                     <input type="checkbox">
                 </th>
                 <th scope="col" class="px-6 py-4 font-bold" style="width: 16%">
                     Nom de famille
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 16%">
                     Prénom
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 20%">
                     Mail
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 12%">
                     Compte activé
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 16%">
                     Rôle
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 15%">

                 </th>
             </tr>
         </thead>

         <!-- Table body -->
         <tbody class="tableauBodyTablA">

         </tbody>

     </table>
     <button class="btnRetourLaPromo py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold right-0 my-4" onclick="fermerLaPromo()">
         Retour
     </button>
 </section>