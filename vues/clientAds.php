<div class="row">

<?php
$annonces = ads_by_user($db, $_SESSION['client']['id']);
if (0 === count($annonces)) : ?>

    <div class="alert alert-info col-md-12">
        <p>Vous n'avez pas encore publié d'annonces</p>
    </div>

<?php
else :
    foreach ($annonces as $annonce) : ?>

        <div class="col-md-6">
            <div class="card border-dark mb-3">
                <div class="card-header">
                    <p class="float-right">
                        <a href="./editAd.php?ad=<?php echo $annonce['id']; ?>&amp;edit_ad" class="btn btn-secondary btn-sm">Editer</a>
                        <a href="./deleteAd.php?ad=<?php echo $annonce['id']; ?>&amp;delete_ad" class="btn btn-danger btn-sm">&times;</a>
                    </p>
                    <?php echo ucfirst($annonce['type']); ?>
                </div>
                <div class="card-body text-dark">
                    <h4 class="card-title">Surface : <?php echo $annonce['surface']; ?>M<sup>2</sup></h4>
                    <p class="card-text"><strong>Adresse : </strong><?php echo $annonce['adresse']; ?></p>
                </div>
            </div>
        </div>

<?php
    endforeach;
endif; ?>

</div>

