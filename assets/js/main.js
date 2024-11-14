function addToFavorites(articleId) {
  let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
  if (!favorites.includes(articleId)) {
    favorites.push(articleId);
    localStorage.setItem("favorites", JSON.stringify(favorites));
    alert("Article ajouté aux favoris");
  }
}

function getFavorites() {
  return JSON.parse(localStorage.getItem("favorites")) || [];
}
