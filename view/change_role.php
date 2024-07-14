<?php require_once __DIR__ . '/header.php'; ?>

<form method="post" action="index.php?rt=home/changeThisRole">
    <div class="projections-container">
        <table class="projections">
            <thead class="projections">
                <tr class="projections">
                    <th class="projections">Name</th>
                    <th class="projections">Surname</th>
                    <th class="projections">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersForChangeRole as $list) : ?>
                    <tr class="projections">
                    <td class="projections" name="idKorisnik"><?php echo $list->name; ?></td>
                        <td class="projections"><?php echo $list->surname; ?></td>
                        <td class="projections">
                            <input type="hidden" name="idKorisnik[]" value="<?php echo $list->id; ?>">
                            <input type="hidden" name="currentRole[]" value="<?php echo $list->role; ?>">
                            <select name="role[]">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="1" <?php echo ($list->role == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($list->role == 2) ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($list->role == 3) ? 'selected' : ''; ?>>3</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            </tbody>
        </table>
    </div>
    <button type="submit" class="submit">MAKE CHANGES</button>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>