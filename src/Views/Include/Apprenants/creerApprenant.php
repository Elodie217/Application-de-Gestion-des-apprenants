<div class="flex">
    <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Accueil</button>
    <button onclick="afficherSectionPromotions()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</button>


    <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
</div>

<div class="my-10">
    <h3 class="text-2xl my-4">Création d'un apprenant</h3>
</div>
<section class="flex flex-col bg-[#f1f0f0] rounded-[3px] px-[25px] py-[45px] my-6">
    <label class="my-2" for="nomApprenant">Nom</label>
    <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="text" id='nomApprenant' name="nomApprenant">

    <label class="my-2" for="prenomApprenant">Prénom</label>
    <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="text" id='prenomApprenant' name="prenomApprenant">

    <label class="my-2" for="emailApprenant">Adresse email</label>
    <input class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5" type="email" id='emailApprenant' name="emailApprenant">

    <label for="roleApprenant">Role</label>
    <select id="roleApprenant" name="roleApprenant" type="text" required class="mb-5 border-[#CED4DA] border-[1px] px-3 py-1.5">
        <option class='' value="1">Apprenant(e)</option>
        <option class='' value="2">Formateur(e)</option>
    </select>
    <div class="messageErreurCreaApprenant text-[#ff0000] text-center text-lg"> </div>

    <div class="btnsCreaApprenant flex justify-between">

    </div>
</section>