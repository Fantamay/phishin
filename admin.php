<?php
$dataFile = __DIR__ . '/data.json';
$allData = [];

if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $allData = json_decode($json, true) ?: [];
}

// DELETE
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $allData = array_filter($allData, function($entry) use ($deleteId) {
        return ($entry['id'] ?? 0) != $deleteId;
    });
    $allData = array_values($allData);
    file_put_contents($dataFile, json_encode($allData, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit();
}

// COPY
if (isset($_GET['copy']) && is_numeric($_GET['copy'])) {
    $copyId = intval($_GET['copy']);
    foreach ($allData as $entry) {
        if (($entry['id'] ?? 0) == $copyId) {
            $newEntry = $entry;
            $newEntry['id'] = count($allData) + 1;
            $allData[] = $newEntry;
            file_put_contents($dataFile, json_encode($allData, JSON_PRETTY_PRINT));
            break;
        }
    }
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Admin</title>

<style>
body {
    background: #e5e5e5;
    font-family: Arial, sans-serif;
    margin: 0;
}

.container {
    width: 95%;
    margin: 30px auto;
    background: white;
    border: 1px solid #ccc;
    padding: 15px;
}

h1 {
    font-size: 20px;
    margin-bottom: 15px;
}

/* Barre grise */
.topbar {
    background: #eee;
    padding: 8px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    font-size: 14px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th {
    background: linear-gradient(#f3f3f3, #dcdcdc);
    border: 1px solid #c0c0c0;
    padding: 8px;
    text-align: left;
    color: #333;
}

td {
    border: 1px solid #d0d0d0;
    padding: 8px;
}

tr:nth-child(even) {
    background: #f9f9f9;
}

tr:hover {
    background: #eef5ff;
}

/* Actions */
.action-btn {
    text-decoration: none;
    font-size: 13px;
    margin-right: 10px;
    color: #0073aa;
}

.action-btn:hover {
    text-decoration: underline;
}

.action-btn.delete {
    color: #d9534f;
}

.null {
    color: #888;
    font-style: italic;
}
</style>

</head>
<body>

<h1>Page Admin - Toutes les informations collectées</h1>
<div style="display:flex;justify-content:center;max-width:1200px;margin:0 auto 20px auto;">
    <a href="login.php" style="display:inline-block;padding:10px 22px;background:#1976d2;color:#fff;border-radius:6px;text-decoration:none;font-weight:bold;margin-bottom:18px;">
        &#8592; Retour
    </a>
</div>

<div class="admin-table-container">

<div class="container">

<h1>Table: utilisateurs</h1>

<div class="topbar">
    Résultat de la requête
</div>

<table>
    <thead>
        <tr>
            <th></th>
            <th>id</th>
            <th>username</th>
            <th>password</th>
            <th>email</th>
            <th>created_at</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($allData)): ?>
            <tr>
                <td colspan="7">Aucune donnée</td>
            </tr>
        <?php else: ?>
            <?php foreach ($allData as $entry): ?>
                <tr>
                    <td><input type="checkbox"></td>

                    <td><?= htmlspecialchars($entry['id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($entry['username'] ?? '') ?></td>
                    <td><?= htmlspecialchars($entry['password'] ?? '') ?></td>

                    <td>
                        <?php
                        $email = $entry['email'] ?? '';
                        echo ($email === '' || strtolower($email) === 'null')
                            ? '<span class="null">NULL</span>'
                            : htmlspecialchars($email);
                        ?>
                    </td>

                    <td><?= htmlspecialchars($entry['created_at'] ?? '') ?></td>

                    <td>
                        <a href="admin.php?edit=<?= $entry['id'] ?>" class="action-btn">✏️ Éditer</a>
                        <a href="admin.php?copy=<?= $entry['id'] ?>" class="action-btn">📄 Copier</a>
                        <a href="admin.php?delete=<?= $entry['id'] ?>" class="action-btn delete" onclick="return confirm('Supprimer ?')">⛔ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>

</table>

</div>

</div>

</body>
</html>