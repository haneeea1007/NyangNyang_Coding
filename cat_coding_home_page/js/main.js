// 모든 문서 로딩 후 자동 실행되는 함수
$(function () {

    // 사용될 변수 선언
    var slideshow = $('.slideshow'),
        slides = slideshow.find('.slideshow_slides'),
        anchor = slides.find('a'), // 배열
        slidesCount = anchor.length, // 슬라이드 총 개수
        nav = slideshow.find('.slideshow_nav'),
        indicator = slideshow.find('.slideshow_indicator'),
        prev = nav.find('.prev'),
        next = nav.find('.next'),
        currentIndex = 0, // 현재 슬라이드를 첫번째 화면으로 지정
        interval = 3000,
        timer = null,
        incrementValue = 1;

    // 이벤트 처리 (슬라이드 가로 배치)
    anchor.each(function (i) {
        var newLeft = (i * 100) + '%'; // 슬라이드 1, 2, 3, 4 // 0%, 100%, 200%, 300%
        $(this).css({
            'left': newLeft
        });
    });

    // 슬라이드 화면 이동 ===============================================================================
    function gotoSlide(index) {

        currentIndex = index;
        slides.animate({
            left: (-100 * currentIndex) + '%'
        }, 500, 'easeInOutExpo'); // 이미지 -100% 기준으로 이동

        // index[0] 일 때, prev 숨김 (첫번째화면)
        if (currentIndex == 0) {
            prev.addClass('disabled');

            // index[1],[2],[3] 일 때, prev 보여줌
        } else {
            prev.removeClass('disabled');
        }

        // index[3] 일 때, next 숨김 (마지막화면)
        if (currentIndex == (slidesCount - 1)) {
            next.addClass('disabled');

            // index[0],[1],[2] 일 때, next 보여줌
        } else {
            next.removeClass('disabled');
        }

        indicator.find('a').removeClass('active');
        indicator.find('a').eq(currentIndex).addClass('active');
    }

    // 인디케이터로 이동 ========================================================================
    indicator.find('a').click(function (event) {

        event.preventDefault(); // a 태그 기본기능 막기

        var point = $(this).index();
        gotoSlide(point);

    });

    // 자동 슬라이드 // setInterval(기능함수, 시간)
    function autoDisplayStart() {
        timer = setInterval(function () {
            
            // 0 - 1 - 2 - 3 - 2 - 1 - 0 - 1 ....
            if (currentIndex === 3) {
                incrementValue = -1;
            }

            if (currentIndex === 0) {
                incrementValue = 1;
            }

            var nextIndex = (currentIndex + incrementValue) % slidesCount;
            gotoSlide(nextIndex);

        }, interval);
    }

    // 자동 슬라이드 정지
    function autoDisplayStop() {
        clearInterval(timer);
    }

    // 마우스가 위에 있을때
    slideshow.mouseenter(function(event) {
        autoDisplayStop();
    });

    // 마우스가 위에 없을때
    slideshow.mouseleave(function(event) {
        autoDisplayStart();
    });

    // prev, next 버튼 이벤트 처리 ===============================================================

    // 왼쪽 버튼
    prev.click(function (event) {

        event.preventDefault(); // a 태그 기본기능 막기

        if (currentIndex !== 0) { // 인덱스가 0이 아니면 1을 빼줌 (왼쪽 이미지로 이동)
            currentIndex -= 1;
        }

        gotoSlide(currentIndex);
    });

    // 오른쪽 버튼
    next.click(function (event) {

        event.preventDefault(); // a 태그 기본기능 막기

        if (currentIndex !== (slidesCount - 1)) { // 인덱스가 마지막이 아니면 1을 더해줌 (오른쪽 이미지로 이동) 
            currentIndex += 1;
        }

        gotoSlide(currentIndex);
    });

});