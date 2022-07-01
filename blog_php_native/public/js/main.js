// DOMContentLoaded permette d'éxecuter le js seulement lorsque la page à fini d'étre chargé.
document.addEventListener("DOMContentLoaded", () => {
  console.log("Start JS");
const articleDeletId = document.querySelectorAll(".article_supp_deleted");
articleDeletId.forEach(element => { 
  element.addEventListener("click", findIdArticle);
});
});
//dataset fournit un accès en lecture/écriture aux attributs de données (data-*).
function findIdArticle(event){
  //event.target se réfère à l'élement cliqué (boutton supprimer).
  //dataset.article_id 
  let article_id = event.target.dataset.article_id;
  document.querySelector("#article_deleted_id").value = article_id;
 }



