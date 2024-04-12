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

<body style="  font-family: 'Roboto', sans-serif " class="text-base">
    <?php
    include __DIR__ . '/Include/navDeconnexion.php'
    ?>

    <section class="Accueil m-4 gap-10">
        <div class="flex">
            <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Accueil</button>
            <button class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]" onclick="afficherSectionPromotions()">Promotions</button>
            <button class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Utilisateurs</button>

            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
        </div>

        <div class="my-10">
            <h3 class="text-2xl my-6">Cours du jour</h3>
        </div>

        <section class="sectionCoursF">

        </section>
    </section>
    <section class="Promotions hidden m-4 gap-10">
        <div class="flex">
            <button onclick="afficherSectionAccueil()" class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Accueil</button>
            <button onclick="afficherSectionPromotions()" class=" rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</button>
            <button class="rounded-t-lg border-b-[1px] py-2 px-4 gap-1 border-[#DEE2E6] text-[#0D6EFD]">Utilisateurs</button>

            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
        </div>
        <div class="my-10">
            <h3 class="text-2xl my-4">Toutes les promotions</h3>
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
    </section>
</body>
<script src=" https://cdn.tailwindcss.com"></script>
<script src="../../Public/assets/scriptTableauDeBordFormateur.js"></script>
<script src="../../Public/assets/scriptTableauDeBordFormateurPromo.js"></script>

</html>