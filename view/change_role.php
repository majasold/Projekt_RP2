<?php require_once __DIR__ . '/header.php'; ?>

<?php $roleNames = [1 => 'user', 2 => 'employee', 3 => 'admin']; ?>

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
                                <?php foreach ($roleNames as $roleValue => $roleName) : ?>
                                    <option value="<?php echo $roleValue; ?>" <?php echo ($list->role == $roleValue) ? 'selected' : ''; ?>>
                                        <?php echo $roleName; ?>
                                    </option>
                                <?php endforeach; ?>
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