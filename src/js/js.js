// 可顯示預上傳圖片
// new Vue({
//   el: '#app',
//   data: {
//     image: ''
//   },
//   methods: {
//     onFileChange(e) {
//       var files = e.target.files || e.dataTransfer.files;
//       if (!files.length)
//         return;
//       this.createImage(files[0]);
//     },
//     createImage(file) {
//       var image = new Image();
//       var reader = new FileReader();
//       var vm = this;

//       reader.onload = (e) => {
//         vm.image = e.target.result;
//       };
//       reader.readAsDataURL(file);
//     },
//     removeImage: function (e) {
//       this.image = '';
//     }
//   }
// });


// 日期區間選擇
$("input.datetime").daterangepicker({
  alwaysShowCalendars: true,
  opens: "left",

  showDropdowns: true,
  
  
  locale: {
    format: "YYYY-MM-DD",
    separator: " ~ ",
    applyLabel: "確定",
    cancelLabel: "清除",
    fromLabel: "開始日期",
    toLabel: "結束日期",
    customRangeLabel: "自訂日期區間",
    daysOfWeek: ["日", "一", "二", "三", "四", "五", "六"],
    monthNames: [
      "1月",
      "2月",
      "3月",
      "4月",
      "5月",
      "6月",
      "7月",
      "8月",
      "9月",
      "10月",
      "11月",
      "12月",
    ],
    firstDay: 1,
  },
});
$("input.datetime").on("cancel.daterangepicker", function (ev, picker) {
  $(this).val("");
});



// //觸發彈窗底部頁面禁止滑動
// function fixed(){
//   var scrollTop = document.body.scrollTop;//設定背景元素的位置
//   $('#content').attr('data-top',scrollTop);
//   var contentStyle = document.getElementById("content").style;//content是可以滾動的背景元素id名稱
//   contentStyle.position = 'fixed'; //contentStyle是第二步的變數，設定背景元素的position屬性為‘fixed’
//   contentStyle.top = "-"+scrollTop+"px";
// }

// //關閉彈窗底部頁面恢復滑動
// function fixed_cancel(){
//   var contentStyle = document.getElementById("content").style;
//   var scrollTop = $('#content').attr('data-top');//設定背景元素的位置
//   contentStyle.top = '0px';//恢復背景元素的初始位置
//   contentStyle.position ="static";//恢復背景元素的position屬性（初始值為absolute，就恢復為absolute，以此類推）
//   $(document).scrollTop(scrollTop);//scrollTop,設定滾動條的位置
// }