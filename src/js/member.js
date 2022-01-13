window.onload = function () {
  showMember();

  let uncompletedItineraries = getUncommentItinerary();

  renderUncompletedItineraries(uncompletedItineraries);
  loadSketch(uncompletedItineraries);

  starOnClick(uncompletedItineraries);
  saveToSketch(uncompletedItineraries);
  sendOnClick(uncompletedItineraries);
};

// 取得未完成評論的行程
function getUncommentItinerary() {
  let result = [];
  $.ajax({
    method: "GET",
    url: "./Frontend/getUncompletedItinerary.php",
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

// 渲染行程畫面
function renderUncompletedItineraries(uncompletedItineraries) {
  $.each(uncompletedItineraries, function (index, row) {
    // 行程照片可能需要換路徑
    $(".member_commentAll").append(`
      <div class="row">
        <div class="member_commentItem col-md-5">
            <img src="./images/summer_camp/${row.IMG}" alt="">
        </div>
  
        <div class="member_commentContent col-md-7">
            <ul class="member_commentWordAll">
                <li class="member_commenttList">
                    <div class="member_commentWordTitle">
                        <h1 class="member_commentName_Title">[${
                          row.COUNTRY
                        }-${row.CITY}] ${row.NAME}</h1>
                    </div>
                </li>
  
                <li class="member_commenttList">
                    <p class="member_commentDate"><i class="bi bi-calendar-check-fill"></i>${
                      row.START_DATE
                    } - ${row.END_DATE}</p>
                </li>
  
                <li class="member_commenttList">
                    <p><i class="bi bi-person-fill"></i>${
                      row.ATTENDEES ? row.ATTENDEES : 1
                    }人</p>
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
            <button data-row-index=${index} class="btn_sub member_save_to_sketch">存成草稿</button>
            <button data-row-index=${index} class="btn_sub member_commentButton">送出評論</button>
        </div>
    </div>`);
  });
}

// 星號點擊事件
function starOnClick(uncompletedItineraries) {
  $("[data-type=star]").on("click", function () {
    let index = $(this).attr("data-row-index");
    let value = $(this).attr("data-value");
    changeStar(index, value, uncompletedItineraries);
  });
}

// 渲染星號
function changeStar(index, value, uncompletedItineraries) {
  $(`[data-type=star][data-row-index=${index}]`).each(function () {
    let targetValue = $(this).attr("data-value");
    if (targetValue <= value) {
      $(this).removeClass("bi-star");
      $(this).addClass("bi-star-fill");
    } else {
      $(this).removeClass("bi-star-fill");
      $(this).addClass("bi-star");
    }
  });
  uncompletedItineraries[index].STAR = value;
}

// 送出評論的點擊事件
function sendOnClick(uncompletedItineraries) {
  $(".member_commentButton").on("click", function () {
    let index = $(this).attr("data-row-index");
    let content = $(`textarea[data-row-index=${index}]`).val();

    let fd = new FormData();
    fd.append("itineraryId", uncompletedItineraries[index].ID);
    fd.append(
      "star",
      uncompletedItineraries[index].STAR
        ? parseInt(uncompletedItineraries[index].STAR)
        : 1
    );
    fd.append("content", content);

    $.ajax({
      method: "POST",
      url: "./Frontend/saveEvaluation.php",
      data: fd,
      async: false,
      processData: false,
      contentType: false,
      success: function (response) {
        alert("成功");
        location.reload();
      },
      error: function (exception) {
        alert("數據載入失敗: " + exception.status);
      },
    });
  });
}

// 儲存草稿事件
function saveToSketch(uncompletedItineraries) {
  $(".member_save_to_sketch").on("click", function () {
    let index = $(this).attr("data-row-index");
    let sketch = localStorage.getItem("sketch") || "[]";
    sketch = JSON.parse(sketch);

    let item = {
      id: uncompletedItineraries[index].ID,
      star: uncompletedItineraries[index].STAR
        ? parseInt(uncompletedItineraries[index].STAR)
        : 1,
      content: $(`textarea[data-row-index=${index}]`).val(),
    };

    let itemIdx = sketch.findIndex(
      (element) => element.id == uncompletedItineraries[index].ID
    );

    if (itemIdx >= 0) {
      sketch[itemIdx] = item;
    } else {
      sketch.push(item);
    }
    localStorage.setItem("sketch", JSON.stringify(sketch));
    alert("成功");
  });
}

// 載入儲存草稿
function loadSketch(uncompletedItineraries) {
  let sketch = localStorage.getItem("sketch");

  if (!sketch) return;
  if (!uncompletedItineraries.length) return;

  sketch = JSON.parse(sketch);
  sketch.forEach((element) => {
    let idx = uncompletedItineraries.findIndex(
      (itinerary) => itinerary.ID == element.id
    );
    if (idx == -1) return;
    changeStar(idx, element.star, uncompletedItineraries);
    $(`textarea[data-row-index=${idx}]`).val(element.content);
  });
}

// 顯示會員資訊
function showMember() {
  $.ajax({
    method: "POST",
    url: "./Frontend/Member.php",
    data: {},
    dataType: "text",
    success: function (response) {
      $(".guest_icon").css("display", "none");
      $(".icon_create").after(response);
      getMemberInfo();
    },
    error: function (exception) {
      alert("數據載入失敗: " + exception.status);
    },
  });
}
// 顯示會員資訊結束

//登入檢查 ---------------------------------------------------------------------------------
function loginCheck(pid) {
  $.ajax({
    method: "POST",
    url: "./Frontend/LoginCheck.php",
    data: {},
    dataType: "text",
    success: function (response) {
      if (response == "") {
        //尚未登入->前往Login.php
        alert("請先登入，將前往登入頁");
        location.href = "/member_signIn.html";
      } else {
        addToCar(pid);
      }
    },
    error: function (exception) {
      alert("數據載入失敗: " + exception.status);
    },
  });
}

// ------ 會員登入抓資料 ----------------- //
function getMemberInfo() {
  $.ajax({
    method: "POST",
    url: "./Frontend/getMemberInfo.php",
    data: {},
    dataType: "json",
    success: function (response) {
      // console.log('aaaaa');
      console.log(response);
      $(".member_editorLogo img").attr("src", response[0]["PICTURE"]);
      $(".member_name").html(response[0]["NAME"]);

      $("#ACCOUNT").val(response[0]["ACCOUNT"]);
      $("#NAME").val(response[0]["NAME"]);
      $("#PHONE").val(response[0]["PHONE"]);
      if (`${response[0]["GENDER"]}` == "男") {
        $('.member_gender input[name="GENDER"]')[0].checked = true;
      } else if (`${response[0]["GENDER"]}` == "女") {
        $('.member_gender input[name="GENDER"]')[1].checked = true;
      } else {
        $('.member_gender input[name="GENDER"]')[2].checked = true;
      }
    },
    error: function (exception) {
      alert("數據載入失敗: " + exception.status);
    },
  });
}

//  ==================== 修改會員資料 ========================
function updateMember() {
  if (
    $("#NAME").val() != "" &&
    $("#PHONE").val() != "" &&
    $("#ACCOUNT").val() != ""
  ) {
    let memberGenderData = $(
      '.member_gender input[name="GENDER"]:checked'
    ).val();
    if (memberGenderData == "男") {
      memberGenderData = "男";
    } else if (memberGenderData == "女") {
      memberGenderData = "女";
    } else {
      memberGenderData = "暫不提供";
    }
  }
  // var name = $('#NAME').val();
  // var phone = $('#PHONE').val();
  // var account = $('#ACCOUNT').val();
  // console.log(memberGenderData, name, phone, account);
  $.ajax({
    method: "POST",
    url: "./Frontend/MemberUpdate.php",
    data: {
      NAME: $("#NAME").val(),
      PHONE: $("#PHONE").val(),
      ACCOUNT: $("#ACCOUNT").val(),
      GENDER: $('.member_gender input[name="GENDER"]:checked').val(),
    },
    dataType: "text",
    success: function (res) {
      getMemberInfo();
      alert("會員資料更改完成");
    },
    error: function (exception) {
      alert("數據載入失敗: " + exception.status);
    },
  });
}

// =================== 修改密碼 ====================
function changePassword() {
  let passwordCheck = [];
  let oldPwd = $("#oldPassword").val();
  let newPwd = $("#newPassword").val();
  let newPwd2 = $("#newPassword2").val();
  if (oldPwd != "") {
    passwordCheck.push("1");
  } else {
    alert("請輸入密碼");
  }

  if (newPwd != "") {
    passwordCheck.push("2");
  } else {
    alert("請輸入密碼");
  }

  if (newPwd2 == newPwd && newPwd != "" && newPwd2 != "") {
    passwordCheck.push("3");
    alert("密碼更改成功");
  } else {
    alert("第二次密碼不相同");
  }
  if (passwordCheck.length === 3) {
    $.ajax({
      method: "post",
      url: "./Frontend/memberPassword.php",
      data: {
        oldPassword: $("#oldPassword").val(),
        newPassword: $("#newPassword").val(),
        // newPassword2: $('#newPassword2').val(),
      },
      dataType: "text",
      success: function (res) {
        getMemberInfo();
      },
      error: function (exception) {
        alert("數據載入失敗: " + exception.status);
      },
    });
  }
}
