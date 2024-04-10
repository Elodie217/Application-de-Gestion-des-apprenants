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

    <section class="m-4 gap-10">
        <div class="flex">
            <p class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Accueil</p>
            <p class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Promotions</p>
            <p class="rounded-t-lg border-[1px] border-b-[0px] py-2 px-4 gap-1 border-[#DEE2E6]">Utilisateurs</p>

            <div class="w-full border-b-[1px] border-[#DEE2E6]"></div>
        </div>

        <h3 class="text-2xl my-6">Cours du jour</h3>

        <section class="flex flex-col bg-[#F8F9FA] rounded-[3px] px-[25px] py-[45px]">
            <div class="flex justify-between">
                <div>
                    <h2 class="promoFormateur text-[32px]"></h2>
                    <p class="placePromoF my-5"></p>
                </div>
                <p class="dateDuJour font-bold"></p>
            </div>
            <div class="flex flex-col">
                <label for="code">Code *</label>
                <input class="py-1.5 px-3 border-[1px] border-[#CED4DA] my-4" type="number" id="code" name="code" placeholder="......">
                <div class="relative my-4">
                    <button class="py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit font-bold absolute right-0 ">Valider présence</button>
                </div>
            </div>
        </section>
    </section>

</body>
<script src=" https://cdn.tailwindcss.com"></script>
<script src="../../Public/assets/scriptTableauDeBordFormateur.js"></script>

</html>