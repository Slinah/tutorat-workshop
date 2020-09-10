function http_post(url = "", param = {}) {
    console.log("http_post");
    return new Promise(async (resolve, reject) => {
        console.log("Promise");
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded", "Access-Control-Allow-Origin", "https://localhost:4567");
        let data = ""
        for (const [key, value] of Object.entries(param)) {
            console.log("Boucle " + key);
            if (data.length > 0) {
                data += "&";
            }
            console.log(key, value);
            data += key + "=" + value;
        }
        console.log(data);
        await xhttp.send(data);
        await resolve(xhttp.response);
    });
}

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


async function recuperationTxtModal() {
    var content = encodeURIComponent(document.getElementById("modalTxt").textContent);
    var personne_id = document.getElementById("personne_id").value;
    console.log(reply);
    let id_question;
    if (reply) {
        http_post("http://localhost:4567/api/replyComQuestion", {
            "id_personne": personne_id,
            "id_comment": comment,
            "content": content
        }).then(() => {
            console.log("RElOAD");
            location.reload();
        });

    } else {
        id_question = document.URL.split("/").pop();
        http_post("http://localhost:4567/api/postComQuestion", {
            "id_personne": personne_id,
            "id_question": id_question,
            "content": content
        }).then(() => {
            console.log("RELOAD 0 ");
            location.reload();
        });
    }
}


function loadMore(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://localhost:4567/api/replyComQuestion", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("?id_personne=" + personne_id + "&id_comment=" + comment + "&content=" + content);

}
