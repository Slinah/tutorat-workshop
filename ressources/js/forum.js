function clickCloseBtnModal() {
    var modal = document.getElementById("modalId");
    modal.style.opacity = '0';
    modal.style.zIndex = '-1';
}

let reply = false;
let comment = "";

function clickOpenBtnModal(com = null) {
    var modal = document.getElementById("modalId");
    modal.style.opacity = '1';
    modal.style.zIndex = '5';
    if (com) {
        reply = true;
        comment = com;
    }
}

function recuperationTxtModal() {
    var content = encodeURIComponent(document.getElementById("modalTxt").textContent);
    var personne_id = document.getElementById("personne_id").value;
    var data = new FormData();
    const xhttp = new XMLHttpRequest();
    if (reply) {
        xhttp.open("POST", "http://localhost:4567/api/replyComQuestion", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("?id_personne=" + personne_id + "&id_comment=" + comment + "&content=" + content);
    } else {
        id_question = document.URL.split("/").pop();
        xhttp.open("POST", "http://localhost:4567/api/postComQuestion", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id_personne=" + personne_id + "&id_question=" + id_question + "&content=" + content);

    }
    clickCloseBtnModal();
    location.reload();

    //    todo faire des trucs avec ça (texte de la balise complète récupéré ^^ )
}


function loadMore(id) {



    
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://localhost:4567/api/replyComQuestion", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("?id_personne=" + personne_id + "&id_comment=" + comment + "&content=" + content);

}
