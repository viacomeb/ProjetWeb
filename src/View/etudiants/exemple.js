// Ajoutez un gestionnaire d'événements global pour détecter les clics
document.addEventListener('click', function (event) {
  // Vérifiez si l'utilisateur a cliqué sur un élément avec la classe "box"
  const box = event.target.closest('.box');
  if (box) {
    const boxId = box.id; // Récupérer l'ID de la box cliquée
    console.log(`Box cliquée : ${boxId}`);

    // Afficher un message en fonction de l'ID
    const output = document.getElementById('output');
    switch (boxId) {
      case 'box1':
        output.textContent = 'Vous avez cliqué sur Box 1 (Bleue).';
        break;
      case 'box2':
        output.textContent = 'Vous avez cliqué sur Box 2 (Rouge).';
        break;
      case 'box3':
        output.textContent = 'Vous avez cliqué sur Box 3 (Verte).';
        break;
      default:
        output.textContent = 'Box inconnue.';
    }
  }
});
