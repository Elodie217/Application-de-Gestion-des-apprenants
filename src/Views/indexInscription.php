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

<body style="  font-family: 'Roboto', sans-serif ">
  <?php
  include './Include/navConnexion.php'
  ?>

  <main class="flex justify-center">
    <section class=" flex flex-col bg-[#f1f0f0] w-[400px] p-10 gap-10 rounded-[3px] mt-[2%]">

      <h1 class="text-[40px] text-center">Bienvenue</h1>
      <p class="text-center text-base leading-[18px]">Pour clôturer votre inscription et créer votre compte, veuillez choisir un mot de passe.</p>


      <div class="gap-2.5 flex flex-col">
        <label for="motDePasseInscription">Mot de passe *</label>
        <input class="py-1.5 px-3 border-[1px] border-[#CED4DA]" type="password" id="motDePasseInscription" name="motDePasseInscription" placeholder="******">
      </div>

      <div class="gap-2.5 flex flex-col">
        <label for="motDePasseConfirmation">Comfirmez mot de passe *</label>
        <input class="py-1.5 px-3 border-[1px] border-[#CED4DA]" type="password" id="motDePasseConfirmation" name="motDePasseConfirmation" placeholder="******">
      </div>

      <button class="py-1.5 px-3 bg-[#0D6EFD] gap-2 rounded text-white w-fit m-auto font-bold">Sauvegarder</button>

  </main>
  </section>
</body>
<script src=" https://cdn.tailwindcss.com"></script>

</html>