<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./view/template/css/cards.css" />

  <title>Cards</title>
</head>
<header>
  <a href="index.php" class="section-btn"> Atrás </a>
</header>

<body>
  <main>
    <div class="testflex">
      <div class="test">
        <section class="grid-content">

          <?php for ($i = 0; $i < count($dataToView); $i++) {

          ?>

            <article class="card">
              <img class="image" src="https://picsum.photos/200" alt="photo" />
              <h1 class="title"><?php echo $dataToView[$i]->getNombre(); ?></h1>
              <p class="subtitle"><?php echo $dataToView[$i]->getTelefono(); ?></p>
              <p class="description">
                <?php echo $dataToView[$i]->getDescripcion(); ?>
              </p>
              <div class="botones">
                <div class="buttonCont"><a href="index.php?action=verNegocio&id=<?= $dataToView[$i]->getId(); ?>">info</a></div>
                <div class="buttonCont"><a href="index.php?action=verNegocio&id=">Ver Carta</a></div>
              </div>
            </article>
          <?php

          }
          ?>
        </section>
      </div>
    </div>
  </main>
</body>

</html>