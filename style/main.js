function updateTotal(prix, id_article) {
  var quantite = document.getElementById("quantite_" + id_article).value;
  var prix_total_article = prix * quantite;
  document.getElementById("prix_" + id_article).textContent =
    prix_total_article.toFixed(2);
  updatePrixTotal();
}

function updatePrixTotal() {
  var total = 0;
  var prix_elements = document.getElementsByClassName("prix");
  for (var i = 0; i < prix_elements.length; i++) {
    total += parseFloat(prix_elements[i].textContent);
  }
  document.getElementById("prix_total").textContent = total.toFixed(2);
}
