window.onload = function () {
    let currentUrl = new URL(window.location.href);
    let itineraryId = currentUrl.searchParams.get("id");
    
    let evalations = getEvalations(itineraryId);

    render_star(evalations);
    render_evalations(evalations);
}

function getEvalations(itineraryId) {
    let result = [];
    $.ajax({
      method: "GET",
      url: "./frontend/getEvaluationsByItinerary.php?itineraryId="+itineraryId,
      data: {},
      async: false,
      success: function (response) {
        result = JSON.parse(response);
      },
      error: function (exception) {
        alert("數據載入失敗: " + exception.status);
        
      },
    });
    return result;
}

function render_star(evalations){
    let avg = 0
    if(evalations.length){
        let total_star = 0;
        evalations.forEach( evalation =>{
            total_star += parseInt(evalation.STAR);
        });
        avg = (total_star / evalations.length).toFixed(1);
        $(".sch_rate").html( avg );
    }
    
    let stars_imgs = "";

    for(let i = 0; i<Math.floor(avg);i++){
        stars_imgs += "<embed src=\"./images/schedule/starred.svg\">";
    }
    for(let i = 0; i<5-Math.floor(avg);i++){
        stars_imgs += "<embed src=\"./images/schedule/star_blank.svg\">";
    }

    $(".sch_rate_star").append(stars_imgs);
}

function render_evalations(evalations){
    
    $.each(evalations, function(index, evaluation) {
        $("#comment_area").append(
        `<div class="sch_comments_area">
            <div class="sch_commemts_member">
                <img src="./images/avatar/${evaluation.PICTURE}">
            </div>
            <div class="sch_member_right">
                <div class="sch_comments_text">
                ${evaluation.CONTENT}
                </div>
                <div class="sch_comments_name">${evaluation.NAME}</div>
            </div>
        </div>`
        );
    });
}