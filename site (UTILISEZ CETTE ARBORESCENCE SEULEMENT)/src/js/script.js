// Affiche un popup pour confirmer la suppression d'un enseignant
function confirmDelete(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer l'enseignant?")) {
        window.location.assign('deleteUser.php?id=' + id);
    }
}
