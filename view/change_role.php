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
                        <td class="projections"><?php echo $list["idKorisnik"]->idKorisnik; ?></td>
                        <td class="projections"><?php echo $list["name"]->name; ?></td>
                        <td class="projections"><?php echo $list["surname"]->surname; ?></td>
                        <td class="projections"><?php echo $list["role"]->role; ?></td>
                    </tr>
                <?php endforeach; ?>  
            </tbody>
        </table>
    </div>
    <button type="submit" class="submit">MAKE CHANGES</button>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>