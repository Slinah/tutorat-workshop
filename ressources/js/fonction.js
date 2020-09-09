function clickCloseBtnModal(){
    var modal = document.getElementById("modalId");
    modal.style.opacity = '0';
    modal.style.zIndex = '-1';
}
function clickOpenBtnModal(){
    var modal = document.getElementById("modalId");
    modal.style.opacity = '1';
    modal.style.zIndex = '5';
}
function recuperationTxtModal(){
    var modalTxt = document.getElementById("modalTxt").textContent;
    //    todo faire des trucs avec ça (texte de la balise complète récupéré ^^ )
}
