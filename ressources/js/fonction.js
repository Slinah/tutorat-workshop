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
