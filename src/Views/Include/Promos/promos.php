 <div class="flex">
     <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Accueil</button>
     <button onclick="afficherSectionPromotions()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</button>

     <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
 </div>
 <div class="my-10">
     <div class="flex justify-between">
         <h3 class="text-2xl my-4">Toutes les promotions</h3>
         <button class="btnSauvegarderCreaPromo py-1.5 px-3 bg-[#198754] gap-2 rounded text-white w-fit font-bold right-0 mt-4 h-fit" onclick="afficherCreaPromo()">
             Ajouter promotion
         </button>
     </div>
     <p>Tableau des promotions de Simplon</p>
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
                 <th scope="col" class="px-6 py-4 font-bold" style="width: 18%">
                     Promotion
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 18%">
                     Début
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 18%">
                     Fin
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 26%">
                     Places
                 </th>
                 <th scope=" col" class="px-6 py-4 font-bold" style="width: 15%">

                 </th>
             </tr>
         </thead>

         <!-- Table body -->
         <tbody class="tableauBody">

         </tbody>

     </table>

 </section>