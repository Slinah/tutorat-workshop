function http_post(url = "", param = {}) {
    return new Promise(async (resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let data = ""
        for (const [key, value] of Object.entries(param)) {
            if (data.length > 0) {
                data += "&";
            }
            data += key + "=" + value;
        }
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4) {
                resolve(xhttp.response);
            }
        }
        await xhttp.send(data);
    });
}

function http_get(url = "", param = {}) {
    return new Promise(async (resolve, reject) => {
        const xhttp = new XMLHttpRequest();


        if (param.length > 0) {
            url += "?";
            let min = url.length;
            for (const [key, value] of Object.entries(param)) {
                if (url.length > min) {
                    url += "&";
                }
                url += key + "=" + value;
            }
        }
        xhttp.open("GET", url, true);
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4) {
                resolve(JSON.parse(xhttp.response));
            }
        }
        await xhttp.send();
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
    let id_question;
    if (reply) {
        http_post("http://localhost:4567/api/replyComQuestion", {
            "id_personne": personne_id,
            "id_comment": comment,
            "content": content
        }).then(() => {
            location.reload();
        });
    } else {
        id_question = document.URL.split("/").pop();
        http_post("http://localhost:4567/api/postComQuestion", {
            "id_personne": personne_id,
            "id_question": id_question,
            "content": content
        }).then(() => {
            location.reload();
        });
    }
}


function loadMore(id) {
    http_get("http://localhost:4567/api/getCommentaireReply/" + id).then(value => {
        console.log(value);
    });
}
