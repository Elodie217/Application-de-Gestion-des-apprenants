<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body style="  font-family: 'Roboto', sans-serif " class="text-base relative">
    <?php
    include __DIR__ . '/Include/navDeconnexion.php'
    ?>

    <div class="messageReussite hidden text-[#0cdb00] text-center text-xl absolute w-full m-auto top-6"></div>


    <section class="Accueil m-4 gap-10">
        <div class="flex">
            <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Accueil</button>
            <button class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]" onclick="afficherSectionPromotions()">Promotions</button>


            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
        </div>

        <div class="my-10">
            <h3 class="text-2xl my-6">Cours du jour</h3>
        </div>

        <section class="sectionCoursF">

        </section>
    </section>


    <section class="Promotions hidden m-4 gap-10">
        <?php
        include __DIR__ . '/Include/Promos/promos.php'
        ?>
    </section>

    <section class="VoirPromotion hidden m-4 gap-10">
        <?php
        include __DIR__ . '/Include/Promos/laPromo.php'
        ?>
    </section>

    <section class="VoirRetards hidden m-4 gap-10">

        <div class="flex">
            <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Accueil</button>
            <button onclick="afficherSectionPromotions()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</button>


            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
        </div>
        <div class="my-10">
            <h3 class="text-2xl my-4">Promotion <span class="promoSpan"></span></h3>
            <p>Tableau des retards</p>
        </div>

        <div class="flex">
            <button onclick="afficherSectionTableauA()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD] w-96 md:w-80 lg:w-64 ">Tableau apprenants</button>
            <button onclick="afficherSectionRetars()" class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Retards</button>
            <button onclick="afficherSectionAbs()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Absences</button>

            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
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
                <tbody class="tableauBodyTablR">

                </tbody>

            </table>
        </section>
    </section>

    <section class="VoirAbsences hidden m-4 gap-10">
        <div class="flex">
            <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Accueil</button>
            <button onclick="afficherSectionPromotions()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</button>


            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
        </div>
        <div class="my-10">
            <h3 class="text-2xl my-4">Promotion <span class="promoSpan"></span></h3>
            <p>Tableau des absences</p>
        </div>

        <div class="flex">
            <button onclick="afficherSectionTableauA()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD] w-96 md:w-80 lg:w-64 ">Tableau apprenants</button>
            <button onclick="afficherSectionRetars()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Retards</button>
            <button onclick="afficherSectionAbs()" class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Absences</button>

            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
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
                <tbody class="tableauBodyTablR">

                </tbody>

            </table>
        </section>
    </section>

    <section class="creerPromo hidden m-4 gap-10">
        <?php
        include __DIR__ . '/Include/Promos/creerPromo.php'
        ?>
    </section>

    <section class="editerPromo hidden m-4 gap-10">
        <?php
        include __DIR__ . '/Include/Promos/editerPromo.php'
        ?>
    </section>

    <section class="creerApprenant hidden m-4 gap-10">
        <?php
        include __DIR__ . '/Include/Apprenants/creerApprenant.php'
        ?>
    </section>

    <section class="editApprenant hidden m-4 gap-10">
        <?php
        include __DIR__ . '/Include/Apprenants/editerApprenant.php'
        ?>
    </section>


</body>
<script src=" https://cdn.tailwindcss.com"></script>
<script src="../../Public/assets/scriptTableauDeBordFormateur.js"></script>
<script src="../../Public/assets/scriptTableauDeBordFormateurPromo.js"></script>
<script src="../../Public/assets/scriptTableauDeBordFormateurAppr.js"></script>

</html>