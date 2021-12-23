function doFirst(){
    // 跟HTML物件產生關連，再建事件聆聽功能
    function map(){
        var map = L.map('map').setView([48.85, 2.35], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([48.85, 2.35]).addTo(map)
            // .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            // .openPopup();
    }
    map();


    // const divWidth = document.querySelector(".index_slider_container");
    // const leftBtn = document.querySelector(".fa-arrow-left");
    // const item = document.querySelectorAll('.slider_item');

    // console.log(divWidth);
    // console.log(leftBtn);
    // console.log(item);
    // // let divWidth = document.getElementsByClassName("index_slider_container");
    // // console.log(divWidth);
    // leftBtn.addEventListener('click', function(){
    //     console.log(leftBtn);
    //     let newdivWidth = parseInt(divWidth).width();
    //     console.log(newdivWidth);
    // });


    // ----- lottie 動畫 ----- //
    lottie.loadAnimation({
        wrapper: svgContainer,
        animType: 'svg',
        loop: true,
        path: 'https://assets7.lottiefiles.com/packages/lf20_aiapd4ct.json'
    });
    
    
    function auto(){
        const aniplay = lottie.loadAnimation({
            wrapper: index_travel_svg,
            animType: 'svg',
            autoplay: false,
            loop: true,
            path: 'https://assets1.lottiefiles.com/packages/lf20_wofwoz8o.json'
        });
    
        const svgplay = document.querySelector('#index_travel_svg');
        // console.log(svgplay);
    
        svgplay.addEventListener('click', function(){
            // console.log();
            if(svgplay.className == '-stop'){
                aniplay.play();
                svgplay.classList.add('-on');
                svgplay.classList.remove('-stop');
            }else{
                aniplay.pause();
                svgplay.classList.add('-stop');
                svgplay.classList.remove('-on');
            }
        });
    }
    // auto();
    
    



    // ---- 文字省略 (...) ---- //
    // let len = 15; // 超過15個字以"..."取代
    // $(".Text_len").each(function(i){
    //     if($(this).text().length > len){
    //         $(this).attr("title", $(this).text());
    //         let text = $(this).text().substring(0,len-1) + "...";
    //         $(this).text(text);
    //     }
    // });
    

}
// 多個事件時，要先宣告load
window.addEventListener('load', doFirst);