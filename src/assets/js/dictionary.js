$(document).ready(function () {
    const apikey = "4730cd3d-bd84-43a5-a2c8-8f100386e288";
    $("#search").click(function (e) { 
        let word = $("#searchtxt").val();
        const url = `https://dictionaryapi.com/api/v3/references/sd2/json/${word}?key=${apikey}`;
        let text = "";
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                text += `
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl text-yellow-800">${word}</h3>
                    <button><i class="fas fa-volume-up text-yellow-800 text-2xl"></i></button>
                </div>
                <div class="details flex items-center gap-2 mb-4 text-yellow-700">
                    <p>${response[0].fl}</p>
                    <p>/${response[0].hwi.prs[0].mw}/</p>
                </div>`;
                for (let index = 0; index < response[0].def.length; index++) {
                    text += `
                    <p class="wordmeaning mb-4 text-yellow-700">${response[0].def[index].sseq[0][0][1].dt[0][1]}</p>`;
                }
                $(".result").html(text);
            },
            error: function (error) {
                console.error(error.message);
            }
        });
    });
});
