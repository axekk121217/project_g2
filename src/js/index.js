function doFirst(){
    // 地圖固定
    window.addEventListener('scroll',function(){
        let index_world = document.querySelector('#map');
        let index_world_start = index_world.offsetTop;
        let index_world_end = document.querySelector('.index_slider').offsetTop;

        // console.log(index_world_end);
        // console.log(this.scrollY);
        if((this.scrollY + 150) > index_world_start){
            index_world.classList.add('index_world_sticky');
        }else{
            index_world.classList.remove('index_world_sticky');
        }
    });


    // 地圖初始化
    const map = L.map('map', {
        center: [55.953721, -3.188269], // 中心點座標
        zoom: 5, // 0 - 18
        zoomControl: false , // 是否秀出 - + 按鈕
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    // 預設位置
    L.marker([55.953721, -3.188269]).addTo(map)
        .bindPopup('英國-愛丁堡')
        .openPopup();

    let world_item = document.querySelectorAll('.index_world_Text');

    // 地圖-英國愛丁堡
    let world_1_map = L.marker([55.953721, -3.188269]).addTo(map);
    let world_1_el = document.querySelector('#world_1');
    // console.log(world_1_el);
    // console.log(world_1_map);
    
    world_1_el.addEventListener('click', function(){      
        for(let i = 0; i < world_item.length; i++){
            world_item[i].classList.remove("-on");
        }
        world_1_el.classList.add("-on");

        map.flyTo(L.latLng(55.953721, -3.188269));
        world_1_map.bindPopup('愛丁堡國際藝術節於每年八月在蘇格蘭首府愛丁堡舉辦， 創辦於1947年，和愛丁堡國際藝穗節在同一時期舉辦， 為世界歷史最悠久、規模最大的國際藝術節之一。');
        world_1_map.openPopup();
    });
    
    // 地圖-加拿大魁北克
    let world_2_map = L.marker([46.82972356148259, -71.201658028829]).addTo(map);
    let world_2_el = document.querySelector('#world_2');
    // console.log(world_2_el);
    // console.log(world_2_map);

    world_2_el.addEventListener('click', function(){
        for(let i = 0; i < world_item.length; i++){
            world_item[i].classList.remove("-on");
        }
        world_2_el.classList.add("-on");

        map.flyTo(L.latLng(46.82972356148259, -71.201658028829));
        world_2_map.bindPopup('魁北克冬季嘉年華在每年一月最後一星期的週五揭開序幕，活動持續三週，到二月中落幕。冬季嘉年華的活動十分豐富，攀登冰山、冰雕、遊行、獨木舟橫越聖羅倫斯河、音樂會、化裝舞會等等，讓冬季熱鬧到最高點。');
        world_2_map.openPopup();
    });

    // 地圖-日本
    let world_3_map = L.marker([34.69219782086431, 135.52516354772914]).addTo(map);
    let world_3_el = document.querySelector('#world_3');
    // console.log(world_2_el);
    // console.log(world_2_map);

    world_3_el.addEventListener('click', function(){
        for(let i = 0; i < world_item.length; i++){
            world_item[i].classList.remove("-on");
        }
        world_3_el.classList.add("-on");
        
        map.flyTo(L.latLng(34.69219782086431, 135.52516354772914));
        world_3_map.bindPopup('日本三大節慶活動之一，是世界上最大規模的水上慶典，神轎、小船、煙火交織而成的夢幻天神祭已有1千多年歷史，祭奉日本的學問與學習之神菅原道。');
        world_3_map.openPopup();
    });

    // 地圖-義大利
    let world_4_map = L.marker([45.44088947132172, 12.319479394693793]).addTo(map);
    let world_4_el = document.querySelector('#world_4');
    // console.log(world_4_el);
    // console.log(world_4_map);

    world_4_el.addEventListener('click', function(){
        for(let i = 0; i < world_item.length; i++){
            world_item[i].classList.remove("-on");
        }
        world_4_el.classList.add("-on");
        
        map.flyTo(L.latLng(45.44088947132172, 12.319479394693793));
        world_4_map.bindPopup('每年都在大齋首日前2個禮拜開始，並在懺悔節結束。在節日期間，人人都帶上一個華麗面具，只露出靈魂的眼睛，穿梭在熱鬧的街道，聚首運河，或是乘坐鳳尾船貢多拉夜遊。');
        world_4_map.openPopup();
    });

    // // 地圖-美國
    let world_5_map = L.marker([41.27415585216357, -119.0372409944071]).addTo(map)
    let world_5_el = document.querySelector('#world_5');
    // console.log(world_5_el);
    // console.log(world_5_map);

    world_5_el.addEventListener('click', function(){
        for(let i = 0; i < world_item.length; i++){
            world_item[i].classList.remove("-on");
        }
        world_5_el.classList.add("-on");
        
        map.flyTo(L.latLng(41.27415585216357, -119.0372409944071));
        world_5_map.bindPopup('參加者會製作服飾、工具和古怪的工藝去開派對，並且會保持這個僻靜的地方如當初發現時般原始。火人節會以燃燒大量的木製男人雕像達到節日的高潮，這是一個不能錯過的一幕。');
        world_5_map.openPopup();
    });

    // 測試用-經緯度
    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(map);
    }
    
    map.on('click', onMapClick);
    
    

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
    // 首頁靈感
    lottie.loadAnimation({
        wrapper: svgContainer,
        animType: 'svg',
        loop: true,
        path: 'https://assets7.lottiefiles.com/packages/lf20_aiapd4ct.json'
    });
    
    // 首頁地球轉動
    const aniplay = lottie.loadAnimation({
        wrapper: index_travel_svg,
        animType: 'svg',
        // autoplay: false,
        loop: true,
        path: 'https://assets1.lottiefiles.com/packages/lf20_wofwoz8o.json'
    });

    const svgplay = document.querySelector('#index_travel_svg');
    // console.log(svgplay);

    svgplay.addEventListener('click', function(){
        // console.log();
        if(svgplay.className == 'index_travel_svg-on'){
            aniplay.pause();
            svgplay.classList.add('index_travel_svg-stop');
            svgplay.classList.remove('index_travel_svg-on');
        }else{
            aniplay.play();
            svgplay.classList.add('index_travel_svg-on');
            svgplay.classList.remove('index_travel_svg-stop');
        }
    });
    
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
