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

var programee = document.querySelector(".programee");
var notProgramee = document.querySelector(".notProgramee");
var dateLivraisonWrapper = document.getElementById("date-livraison-wrapper");

programee.addEventListener("click", function () {
  dateLivraisonWrapper.style.display = "block";
});
notProgramee.addEventListener("click", function () {
  dateLivraisonWrapper.style.display = "none";
});



// // ******************** lotterie


// const styloId = "<?php echo $styloId ?>";
// const stylo = "<?php echo $stylo ?>";
// const styloQty = <?php echo $styloQty ?>;

// const sacId = "<?php echo $sacId ?>";
// const sac = "<?php echo $sac ?>";
// const sacQty = <?php echo $sacQty ?>;

// const cleId = "<?php echo $cleId ?>";
// const cle = "<?php echo $cle ?>";
// const cleQty = <?php echo $cleQty ?>;

// const roseId = "<?php echo $roseId ?>";
// const rose = "<?php echo $rose ?>";
// const roseQty = <?php echo $roseQty ?>;

// const bouquetId = "<?php echo $bouquetId ?>";
// const bouquet = "<?php echo $bouquet ?>";
// const bouquetQty = <?php echo $bouquetQty ?>;

// const playButton = document.getElementById("play");
// const symbols = document.querySelectorAll(".symbol");
// const slots = document.querySelectorAll(".slot");
// const a = document.createElement("a");
// a.textContent = "Retour";

// let hasPlayed = false;

// playButton.addEventListener("click", () => {
//   playButton.parentNode.replaceChild(a, playButton);

//   if (hasPlayed) {
//     return;
//   }

//   let items = [
//             { emoji: "🖊️", quantity: styloQty, id: styloId },  // Émoji stylo
//             { emoji: "👜", quantity: sacQty, id: sacId },   // Émoji sac réutilisable
//             { emoji: "🔑", quantity: cleQty, id: cleId },  // Émoji clé
//             { emoji: "🌹", quantity: roseQty, id: roseId },   // Émoji rose rouge
//             { emoji: "💐", quantity: bouquetQty, id: bouquetId }   // Émoji bouquet de roses
//           ];

//   let quantiteTotal = items.reduce((total, item) => total + item.quantity, 0);

//   let ProduitHasard = () => {
//     let hasard = Math.floor(Math.random() * quantiteTotal);
//     let sum = 0;

//     for (let item of items) {
//       sum += item.quantity;
//       if (hasard < sum) {
//         return item;
//       }
//     }
//   };  

//   const checkWin = () => {
//     const emojis = Array.from(symbols).map((symbol) => symbol.textContent);
//     if (emojis[0] === emojis[1] && emojis[1] === emojis[2]) {
//       let winMessage;
//       switch (emojis[0]) {
//         case "🖊️":
//           winMessage = "Bravo, vous avez gagné un porte-clé “Lafleur”!";
//           a.href = "index.php?uc=account&action=visit&id="+items[0].id;
//           break;
//         case "👜":
//           winMessage = "Bravo, vous avez gagné un sac réutilisable en tissus “Lafleur”!";
//           a.href = "index.php?uc=account&action=visit&id="+items[1].id;
//           break;
//         case "🔑":
//           winMessage = "Bravo, vous avez gagné un porte-clés “Lafleur”!";
//           a.href = "index.php?uc=account&action=visit&id="+items[2].id;
//           break;
//         case "🌹":
//           winMessage = "Bravo, vous avez gagné une rose rouge à offrir!";
//           a.href = "index.php?uc=account&action=visit&id="+items[3].id;
//           break;
//         case "💐":
//           winMessage = "Bravo, vous avez gagné un bouquet de roses!";
//           a.href = "index.php?uc=account&action=visit&id="+items[4].id;
//           break;
//       }

//       symbols.forEach((symbol, index) => {
//         if (index === 0) {
//           setTimeout(() => {
//             symbol.parentNode.classList.add("winner1");
//           }, 10);
//         } else if (index === 1) {
//           setTimeout(() => {
//             symbol.parentNode.classList.add("winner2");
//           }, 20);
//         } else if (index === 2) {
//           setTimeout(() => {
//             symbol.parentNode.classList.add("winner3");

//           }, 30);
//         }
//       });

//       setTimeout(() => {
//         alert(winMessage);
//       }, 500);
//     } else {
//       a.href = "index.php?uc=account&action=visit";

//       slots.forEach((slot) => {
//         slot.classList.remove("winner1", "winner2", "winner3");
//       });
//       alert("Désolé, vous avez perdu !");
//       hasPlayed = true;
//     }
//   };

//   symbols.forEach((symbol) => {
//     symbol.classList.add("animate");
//   });
  
//   let count = 0;
  
//   const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
  
//   const generateCombination = async () => {
//     symbols.forEach((symbol) => {
//       const item = ProduitHasard();
//       symbol.textContent = item.emoji;
//     });
//     count++;
//     if (count < 5) {
//       await delay(500);
//       generateCombination();
//     } else {
//       symbols.forEach((symbol) => {
//         symbol.classList.remove("animate");
//       });
//       await delay(500);
//       symbols.forEach((symbol) => {
//         const item = ProduitHasard();
//         symbol.textContent = item.emoji;
//       });
//       await delay(300); // Ajouter un délai supplémentaire pour permettre l'affichage du résultat
//       checkWin();
//       hasPlayed = true;
//     }
//   };
  
//   generateCombination();
  
// }); 