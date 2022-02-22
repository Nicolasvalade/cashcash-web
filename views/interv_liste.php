<?php
$title = 'Liste des interventions';
ob_start();
?>
<h1>Liste des interventions</h1>

<form id="f-interv" method="POST" action="#" class="form-filtre">

  <div>
    <label for="f-matricule">Technicien</label>
    <select onchange="submitForm(this)" name="f_matricule" id="f-matricule">
      <option value=""></option>

      <?php foreach ($all_tech as $tech) : ?>

        <?php if ($tech['matricule'] == $f_matricule) : ?>
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

  <?php if ($f_matricule || $f_date_debut || $f_date_fin) : ?>
    <div>
      <button type="button" onclick="resetForm()">Effacer</button>
    </div>
  <?php endif; ?>
</form>

<table>
  <thead>
    <tr>
      <th>N°</th>
      <th>Client</th>
      <th>Prévue le</th>
      <th>Etat</th>
      <th>Technicien</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($all_interv as $interv) : ?>
      <?php if ($interv['e_id'] == 4) : ?>
        <tr class="annulee">
        <?php else : ?>
        <tr class="clickable etat-<?= $interv['e_id'] ?>" onclick="window.location='<?= $index ?>/intervention?id=<?= $interv['id'] ?>'">
        <?php endif; ?>
        <td><?= "$interv[id]" ?></td>
        <td><?= "$interv[client]" ?></td>
        <td><?= "$interv[date_heure]" ?></td>
        <td><?= "$interv[e_libelle]" ?></td>
        <td><?= "$interv[t_nom] $interv[t_prenom]" ?></td>
        <td>
          <?php if ($interv['e_id'] == 2 || $interv['e_id'] == 3) : ?>
            <a href="<?= $index ?>/pdf/intervention?id=<?= $interv['id'] ?>">
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