<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body style="  font-family: 'Roboto', sans-serif ">
    <?php
    include __DIR__ . '/Include/navConnexion.php'
    ?>

    <main class="flex justify-center">
        <section class=" flex flex-col bg-[#f1f0f0] w-[400px] p-10 gap-10 rounded-[3px] mt-2">

            <h1 class="text-[40px] text-center">Bienvenue</h1>
            <p>Pour clôturer votre inscription et créer votre compte, veuillez choisir un mot de passe.</p>

            <div class="gap-2.5 flex flex-col">
                <label for="creermotDePasse">Mot de passe *</label>
                <input class="py-1.5 px-3 border-[1px] border-[#CED4DA]" type="password" id="creermotDePasse" name="creermotDePasse" placeholder="******">
            </div>

            <div class="gap-2.5 flex flex-col">
                <label for="cofimationmotDePasse">Comfirmation du mot de passe *</label>
                <input class="py-1.5 px-3 border-[1px] border-[#CED4DA]" type="password" id="cofimationmotDePasse" name="cofimationmotDePasse" placeholder="******">
            </div>

            <button class="py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit m-auto font-bold" onclick="verificationInscription()">Sauvegarder</button>
            <div class="messageErreurInscription text-[#ff0000] text-center text-lg"> </div>

    </main>
    </section>
</body>
<script src=" https://cdn.tailwindcss.com"></script>
<script src="../../Public/assets/scriptInscription.js"></script>

</html>