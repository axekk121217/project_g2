window.onload = function () {
  let currentUrl = new URL(window.location.href);
  let account = currentUrl.searchParams.get("account");
  
  let uncompletedItineraries = getUncommentItinerary(account);
  
  renderUncompletedItineraries(uncompletedItineraries);

  starOnClick(uncompletedItineraries);

  sendOnClick(uncompletedItineraries,account);
}

function getUncommentItinerary(account) {
  let result = [];
  $.ajax({
    method: "GET",
    url: "./Frontend/getUncompletedItinerary.php?account="+ account,
    data: {},
    async: false,
    dataType: "json",
    success: function (response) {
      result = response
    },
    error: function (exception) {
      alert("數據載入失敗: " + exception.status);
    },
  });
  return result;
}

function renderUncompletedItineraries(uncompletedItineraries){
    
  $.each(uncompletedItineraries, function(index, row) {
    // 行程照片可能需要換路徑 
    $(".member_commentAll").append(`
    <div class="row">
      <div class="member_commentItem col-md-5">
          <img src="./images/member/${row.IMG}" alt="">
      </div>

      <div class="member_commentContent col-md-7">
          <ul class="member_commentWordAll">
              <li class="member_commenttList">
                  <div class="member_commentWordTitle">
                      <h1 class="member_commentName_Title">[${row.COUNTRY}-${row.CITY}] ${row.NAME}</h1>
                  </div>
              </li>

              <li class="member_commenttList">
                  <p class="member_commentDate"><i class="bi bi-calendar-check-fill"></i>${row.START_DATE} - ${row.END_DATE}</p>
              </li>

              <li class="member_commenttList">
                  <p><i class="bi bi-person-fill"></i>${row.ATTENDEES? row.ATTENDEES : 1 }人</p>
              </li>

              <li class="member_commenttList">
                  <p class="price">TWD ${row.PRICE}</p>
              </li>
          </ul>
      </div>
      <div class="member_commentStar" data-row-index=${index}>
          <p class="member_commentStarCountTitle">請為這次的課程體驗打個星星吧！</p>
          <i data-type='star' data-row-index=${index} data-value=1 class="bi bi-star"></i>
          <i data-type='star' data-row-index=${index} data-value=2 class="bi bi-star"></i>
          <i data-type='star' data-row-index=${index} data-value=3 class="bi bi-star"></i>
          <i data-type='star' data-row-index=${index} data-value=4 class="bi bi-star"></i>
          <i data-type='star' data-row-index=${index} data-value=5 class="bi bi-star"></i>
      </div>
      <div class="member_commentWriteItem">
          <p class="member_commentWriteTitle">將您的心得提供給其他人參考</p>
          <textarea data-row-index=${index} name="member_commentWrite" placeholder="請輸入您的心得"></textarea>
      </div>
      <div class="member_commentButtonAll">
          <button class="btn_sub">存成草稿</button>
          <button data-row-index=${index} class="btn_sub member_commentButton">送出評論</button>
      </div>
  </div>`)
  });
}

function starOnClick(uncompletedItineraries){
  $("[data-type=star]").on('click',function() {
    let index = $(this).attr("data-row-index");
    let value = $(this).attr("data-value");
    
    $(`[data-type=star][data-row-index=${index}]`).each(function(){
      let targetValue = $(this).attr("data-value")
      if(targetValue<=value){
        $(this).removeClass("bi-star")
        $(this).addClass("bi-star-fill")
      }else{
        $(this).removeClass("bi-star-fill")
        $(this).addClass("bi-star")
      }
    });
    uncompletedItineraries[index].STAR = value;
  });
}

function sendOnClick(uncompletedItineraries,account){
  $(".member_commentButton").on('click',function(){
    let index = $(this).attr("data-row-index");
    let content = $(`textarea[data-row-index=${index}]`).val();
    
    fd = new FormData();  
    fd.append( 'account',account);  
    fd.append( 'itineraryId', uncompletedItineraries[index].ID); 
    fd.append( 'star', uncompletedItineraries[index].STAR ? parseInt(uncompletedItineraries[index].STAR):1); 
    fd.append( 'content', content); 
    
    $.ajax({
        method: "POST",
        url: "./Frontend/saveEvaluation.php",
        data: fd,
        async: false,
        processData: false,
        contentType: false,
        success: function (response) {
          alert("成功");
          location.reload()
        },
        error: function (exception) {
          alert("數據載入失敗: " + exception.status);
        },  
    })
});
}
