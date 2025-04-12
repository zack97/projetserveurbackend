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
          window.history.pushState(null, "", url);
        }
      })
      .catch((err) => {
        console.error("Erreur de chargement :", err);
      });
  }

  document.body.addEventListener("click", function (e) {
    const link = e.target.closest("a");
    if (link && !link.classList.contains("no-ajax")) {
      e.preventDefault();
      const url = link.getAttribute("href");
      loadPage(url);
    }

    const button = e.target.closest("button");
    if (button && !button.classList.contains("no-ajax")) {
      e.preventDefault();
      const form = button.closest("form");
      if (form) {
        const formData = new FormData(form);
        fetch(form.action, {
          method: "POST",
          body: formData,
        })
          .then((response) => response.text())
          .then((html) => {
            const content = document.querySelector("#content");
            if (content) {
              content.innerHTML = html;
            }
          })
          .catch((err) => {
            console.error("Erreur de soumission AJAX :", err);
          });
      }
    }
  });

  window.addEventListener("popstate", function () {
    loadPage(location.pathname);
  });
});
