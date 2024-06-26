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

    <div class="fixed messageReussite hidden text-[#0cdb00] text-center text-xl w-full m-auto top-6"></div>

    <div class="flou hidden fixed w-full h-full top-0 backdrop-blur-sm "></div>

    <div class="divMaintenance hidden fixed w-2/4 bg-[#f1f0f0]  text-xl absolute mx-[25%] pt-3 border-2 border-slate-600 rounded-lg top-18 mb-3">
        <button onclick="enleverMaintenance()" class="ml-[90%]"><i class="fa-regular fa-circle-xmark text-right text-3xl"></i></button>
        <p class="text-center">Désolé, cette partie du site est actuellement en maintenance.</p>
        <img src="<?= HOME_URL ?>assets/medias/img.png" alt="image de maintenance" class="w-4/5 mx-[10%]">
    </div>


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

        <div class="flex divBtnSousMenuRetards">

        </div>

        <section class="overflow-x-auto bg-white">

            <table class="min-w-full text-left whitespace-nowrap" style="width: 100%;">

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

        <div class="flex divBtnSousMenuABS">

        </div>

        <section class="overflow-x-auto bg-white">

            <table class="min-w-full text-left whitespace-nowrap" style="width: 100%;">

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
            <p class="text-center my-6 text-xl">Dans cette promo exemplaire, il n'y a aucun absent.</p>
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
<script src="https://kit.fontawesome.com/97cd5da9a0.js" crossorigin="anonymous"></script>
<script>
    const HOME_URL = "<?= HOME_URL ?>";
</script>
<script type="text/javascript" src="<?= HOME_URL ?>/assets/scriptTableauDeBordFormateur.js"></script>
<script type="text/javascript" src="<?= HOME_URL ?>/assets/scriptTableauDeBordFormateurPromo.js"></script>
<script type="text/javascript" src="<?= HOME_URL ?>/assets/scriptTableauDeBordFormateurAppr.js"></script>
<script type="text/javascript" src="<?= HOME_URL ?>/assets/scriptRetard.js"></script>


</html>