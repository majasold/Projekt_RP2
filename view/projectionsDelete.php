<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="projections" >PROJECTIONS</h1>

<form method = "post" action = "index.php?rt=projections/projectionDelete">
  <div class="table-reservations">
      <table class = "projections">
        <thead class="projections">
          <tr>
              <th></th>
              <th>Movie Title</th>
              <th>Date</th>
              <th>Time</th>
              <th>Cimena Hall</th>
          </tr>
        </thead>

        <tbody class = "projections">
        <?php for ($i = 0; $i < sizeof($projections); $i++) : ?>
          <tr>
            <td><input type="checkbox" name="projections[]" value="<?php echo $projections[$i]->id_projection; ?>" class="checkbox"></td>
            <td><?php echo $movies[$i]->name; ?></td>
            <td><?php echo $projections[$i]->date; ?></td>
            <td><?php echo $projections[$i]->time; ?></td>
            <td><?php echo $projections[$i]->id_hall; ?></td>
          </tr>
        <?php endfor; ?>
        </tbody>
      </table>
  </div>
  <button type="submit" class="delete">DELETE</button>
</form>


<?php require_once __DIR__ . '/footer.php'; ?>