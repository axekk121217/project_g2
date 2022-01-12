window.onload = function () {
  let evaluations = getData();
  let filteredEvaluations = evaluations;

  let current_evaluation = null;

  display(filteredEvaluations);

  // 搜尋會員編號事件
  $(".admin_search-btn").on("click", function () {
    let searchId = $("#search").val();
    if (searchId) {
      filteredEvaluations = evaluations.filter(
        (item) => item.MEMBER_ID == searchId
      );
    } else {
      filteredEvaluations = evaluations;
    }
    $("#review_result").empty();
    display(filteredEvaluations);
    $(".admin_order_btn").on("click", order_btn_onclick);
  });

  // 隱藏評論功能
  $("#show_or_hide_btn").on("click", function () {
    if (!current_evaluation) {
      return;
    }
    let fd = new FormData();
    fd.append("visible", !!parseInt(current_evaluation.IS_VISIBLE) ? 0 : 1);
    fd.append("evaluation_id", current_evaluation.ID);

    $.ajax({
      method: "POST",
      url: "./backend/changeEvaluationVisible.php",
      data: fd,
      async: false,
      processData: false,
      contentType: false,
      success: function (response) {
        current_evaluation.IS_VISIBLE = !!parseInt(
          current_evaluation.IS_VISIBLE
        )
          ? 0
          : 1;
        $("#show_or_hide_btn").html(
          !!parseInt(current_evaluation.IS_VISIBLE) ? "隱藏" : "顯示"
        );
      },
      error: function (exception) {
        alert("數據載入失敗: " + exception.status);
      },
    });
  });

  $(".admin_order_btn").on("click", order_btn_onclick);

  // 顯示留言內容資訊
  function order_btn_onclick() {
    let dataIdx = parseInt($(this).attr("data-row-index"));
    current_evaluation = filteredEvaluations[dataIdx];
    $("#itinerary_title").val(current_evaluation.NAME);
    $("#publish_date").val(current_evaluation.DATE);
    $("#comment").val(current_evaluation.CONTENT);
    $("#show_or_hide_btn").html(
      !!parseInt(current_evaluation.IS_VISIBLE) ? "隱藏" : "顯示"
    );
  }
};
// 取得所有評論
function getData() {
  let result = [];
  $.ajax({
    method: "POST",
    url: "./backend/getAllEvaluation.php",
    data: {},
    async: false,
    dataType: "json",
    success: function (response) {
      result = response;
    },
    error: function (exception) {
      alert("數據載入失敗: " + exception.status);
    },
  });
  return result;
}

// 渲染評論
function display(evaluations) {
  //更新html內容(透過jQuery跑迴圈取值)
  $.each(evaluations, function (index, row) {
    $("#review_result").append(
      "<tr>" +
        "<th scope='row'>" +
        row.DATE +
        "</th>" +
        "<td>" +
        row.MEMBER_ID +
        "</td>" +
        "<td>" +
        row.ID +
        "</td>" +
        "<td>" +
        row.ITINERARY_ID +
        "</td>" +
        "<td>" +
        renderStar(parseInt(row.STAR)) +
        "</td>" +
        "<td>" +
        "<button type='button' class='btn admin_order_btn' data-bs-toggle='modal' data-bs-target='#staticBackdrop' data-row-index='" +
        index +
        "'>內容查看&nbsp;&frasl;&nbsp;隱藏</button>" +
        "</td>" +
        "</tr>"
    );
  });
}

// 渲染星星
function renderStar(stars) {
  let result = "";

  for (let i = 0; i < stars; i++) {
    result += "<i class='fas fa-star admin_review_start'></i>";
  }

  return result;
}
