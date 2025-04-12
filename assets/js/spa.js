document.addEventListener("DOMContentLoaded", function () {
  // Fonction pour charger une page via AJAX
  function loadPage(url) {
    fetch(url)
      .then((response) => {
        if (!response.ok) throw new Error("Erreur de chargement");
        return response.text();
      })
      .then((html) => {
        const content = document.querySelector("#content"); // Sélectionne #content
        if (content) {
          content.innerHTML = html; // Mise à jour du contenu
          window.history.pushState(null, "", url); // Met à jour l'URL dans la barre d'adresse
        }
      })
      .catch((err) => {
        console.error("Erreur de chargement :", err);
      });
  }

  // Gérer les clics sur les liens et les boutons
  document.body.addEventListener("click", function (e) {
    // Si c'est un lien
    const link = e.target.closest("a");
    if (link && !link.classList.contains("no-ajax")) {
      // Ne pas intercepter si la classe 'no-ajax' est présente
      e.preventDefault(); // Empêche le comportement par défaut
      const url = link.getAttribute("href"); // Récupère l'URL
      loadPage(url); // Charge la page via AJAX
    }

    // Si c'est un bouton
    const button = e.target.closest("button");
    if (button && !button.classList.contains("no-ajax")) {
      // Ne pas intercepter si la classe 'no-ajax' est présente
      e.preventDefault(); // Empêche le comportement par défaut
      const form = button.closest("form");
      if (form) {
        const formData = new FormData(form); // Crée un objet FormData avec les données du formulaire
        fetch(form.action, {
          method: "POST",
          body: formData, // Envoie les données du formulaire
        })
          .then((response) => response.text())
          .then((html) => {
            const content = document.querySelector("#content");
            if (content) {
              content.innerHTML = html; // Met à jour le contenu
            }
          })
          .catch((err) => {
            console.error("Erreur de soumission AJAX :", err);
          });
      }
    }
  });

  // Gérer le bouton retour du navigateur
  window.addEventListener("popstate", function () {
    loadPage(location.pathname); // Recharger la page correspondant à l'URL dans l'historique
  });
});
