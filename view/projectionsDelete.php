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
          <?php foreach ($allProjections as $proj) : ?>
              <tr>
                  <td><input type = "checkbox" name = "projections[]" value = "<?php echo $res["projection"]->id_projection; ?>" class = "checkbox"></td>
                  <td><?php echo $res["movie"]->name; ?></td>
                  <td><?php echo $res["projection"]->date; ?></td>
                  <td><?php echo $res["projection"]->time; ?></td>
                  <td><?php echo $res["projection"]->id_hall; ?></td>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  <button type="submit" class="delete">DELETE</button>
</form>


<?php require_once __DIR__ . '/footer.php'; ?>