<div class="row">

<?php
$annonces = ads_list($db);
foreach ($annonces as $annonce) : ?>

    <div class="col-md-6">
        <div class="card border-dark mb-3">
            <div class="card-header"><?php echo ucfirst($annonce['type']); ?></div>
            <div class="card-body text-dark">
                <h4 class="card-title">Surface : <?php echo $annonce['surface']; ?>M<sup>2</sup></h4>
                <p class="card-text"><strong>Adresse : </strong><?php echo $annonce['adresse']; ?></p>
            </div>
        </div>
    </div>

<?php
endforeach;
?>

</div>

