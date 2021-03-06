<?php
$title = 'Liste des interventions';
ob_start();
?>
<h1>Liste des interventions</h1>

<?php if ($erreur) : ?>
    <p><?= $erreur ?></p>
<?php endif; ?>

<a href="<?=$index_admin?>/intervention/nouveau"><button>Nouveau</button></a>

<form id="f-interv" method="POST" action="#" class="form-filtre">

  <div>
    <label for="f-matricule">Technicien</label>
    <select onchange="submitForm()" name="f_matricule" id="f-matricule">
      <option value="">Tous</option>

      <?php foreach ($all_tech as $tech) : ?>

        <?php // garder affiché le technicien selectionné
        if ($tech['matricule'] == $f_matricule) : ?>
          <option selected value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>

        <?php else : ?>
          <option value="<?= $tech['matricule'] ?>"><?= "$tech[nom] $tech[prenom]" ?></option>
        <?php endif; ?>

      <?php endforeach; ?>

    </select>
  </div>

  <div>
    <label for="f-date-debut">Du</label>
    <input onchange="submitForm()" value="<?= $f_date_debut ?>" name="f_date_debut" id="f-date-debut" type="date" />
    <label for="f-date-fin">au</label>
    <input onchange="submitForm()" value="<?= $f_date_fin ?>" name="f_date_fin" id="f-date-fin" type="date" />
  </div>


  <div>
    <?php // n'activer le bouton reset que si un filtre est actif
    if (!($f_matricule || $f_date_debut || $f_date_fin)) : ?>
      <button disabled type="button" onclick="resetForm()">Effacer</button>
    <?php else : ?>
      <button type="button" onclick="resetForm()">Effacer</button>
    <?php endif; ?>
  </div>
</form>

<table>
  <thead>
    <tr>
      <th>N°</th>
      <th>Client</th>
      <th>Date</th>
      <th>Heure</th>
      <th>Etat</th>
      <th>Technicien</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($all_interv as $interv) : ?>
      <tr class="clickable etat-<?= $interv['e_id'] ?>" onclick="window.location='<?= $index_admin ?>/intervention?id=<?= $interv['id'] ?>'">
        <td><?= "$interv[id]" ?></td>
        <td><?= "$interv[client]" ?></td>
        <td><?= date_locale($interv['date_heure']) ?></td>
        <td><?= heure_courte($interv['date_heure']) ?></td>
        <td><?= "$interv[e_libelle]" ?></td>
        <td><?= "$interv[t_nom] $interv[t_prenom]" ?></td>
        <td>

          <?php // Bouton PDF si l'intervention est affectée ou clôturée
          if ($interv['e_id'] == 2 || $interv['e_id'] == 3) : ?>
            <a href="<?= $index_admin ?>/pdf/intervention?id=<?= $interv['id'] ?>">
              <button>PDF</button>
            </a>
          <?php endif; ?>

        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>

<script>
  function resetForm() {
    document.getElementById('f-matricule').value = "";
    document.getElementById('f-date-debut').value = "";
    document.getElementById('f-date-fin').value = "";
    document.getElementById('f-interv').submit();
  }

  function submitForm() {
    document.getElementById('f-interv').submit();
  }
</script>

<?php
// mettre tout le html écris au-dessus dans la variable $content au lieu de l'afficher
$content = ob_get_clean();
require_once 'templates/base.php';
?>