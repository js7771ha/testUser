
<!DOCTYPE html>
<html lang="ko"  class="__topbanner-show" >
<head>

    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="_token" content="d9iTRXltmw0JwpgM41EKkvYij1nGnau1hCqsuocJ">
    <meta name="keywords" content="브랜드 패션&amp;라이프스타일몰. 브랜드 패션. 스트리트. 디자이너. 라이프스타일">
    <meta name="description" content="브랜드 패션&amp;라이프스타일몰. 브랜드 패션. 스트리트. 디자이너. 라이프스타일">

    <meta property="og:title" content="브랜드몰 - 패션&amp;라이프스타일몰">
    <meta property="og:description" content="브랜드 패션&amp;라이프스타일몰. 브랜드 패션. 스트리트. 디자이너. 라이프스타일">
    <meta property="og:url" content="https://mall.mmonstar.co.kr">
    <meta property="og:site_name" content="브랜드몰">



    <title>브랜드몰 - 패션&amp;라이프스타일몰</title>



    <!-- 라이브러리 css -->
    <link rel="stylesheet" href="/pc/css/app-pc-lib.css?id=9e932a073a6ebcb8670b">
    <link rel="stylesheet" href="/pc/css/app-pc.css?id=1993f63ba50d2706d884">
    <link class="link_font" rel="stylesheet" href="/pc/css/fonts.css?id=9d9384af70c9a69fbb01">


    <!-- 페이지 css -->
    <script src="/pc/js/app-pc-lib.js?id=5b7fb197866175bd870d"></script>
    <script src="/js/pc/common/et-common-script.js"></script>

    <script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=default%2CNumber.parseInt"></script>
    <script src="/js/common/common_script.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-67205961-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-67205961-2');
    </script>
    <script src="/pc/js/app-pc.js?id=0e284023c9e435af4982"></script>

    <!-- KAKAO JS SDK 활성화 -->

    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

    <!-- NaverPay JS SDK 활성화 -->
    <script type="text/javascript" src="https://pay.naver.com/customer/js/naverPayButton.js" charset="UTF-8"></script>
</head>
<body>
<div id="mm_app" class="mm_app">
    <nav class="mm_skip">
        <ul>
            <li><a href="#mm_body" data-href="anchor">본문바로가기</a></li>
        </ul>
    </nav>


    <!-- 최상단배너 -->
    <div class="mm_topbanner">
        <!--
            (D) 배너가 등록되어 있고, "IS_TOPBANNER_HIDE" 쿠키가 없으면 서버에서 html 요소에 "__topbanner-show" 클래스를 추가합니다.
            왼쪽 배너는 i 요소에 백그라운드로, 오른쪽 배너는 img 요소로 등록합니다.
            왼쪽 배너는 하나만 독립적으로 사용할 수 있습니다.(독립적으로 사용할 경우 배너 내용을 중앙에 맞게 디자인 필요)
            오른쪽 배너는 왼쪽 배너가 있을 때만 세트로 노출하고, 없으면 li 요소를 삭제합니다.
        -->
        <i class="mm_preload image_banner" data-preload="{ '_src': 'https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/upload/display_banner/44/1569288626238.jpg' }"></i>
        <div class="mm_inner">
            <ul class="mm_box-flex __flex_equal__">
                <li>
                    <a href="/product/best" target="_self" data-href="{ '_type': 'link' }">
                        <span class="mm_ir-blind">로켓와우</span>
                    </a>
                </li>
                <li>
                    <a href="/product/deal" target="_self" data-href="{ '_type': 'link' }">
                        <i class="image_banner">
                            <img class="mm_preload" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-preload="{ '_src': 'https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/upload/display_banner/45/1569288657449.jpg' }" alt="이롬">
                        </i>
                    </a>
                </li>
            </ul>
        </div>
        <button type="button" class="btn_topbanner-close" onclick="topbannerHide();"><i class="mco_close"></i><span class="mm_ir-blind">배너 숨기기</span></button>
        <script>
            function topbannerHide() {

                mm.cookie.set('IS_TOPBANNER_HIDE', true, 1, true);// 1일 자정 리셋

                TweenMax.to('.mm_app', mm.times._fast, { 'padding-top': 0, ease: Sine.easeOut });
                TweenMax.to('.mm_topbanner', mm.times._fast, { 'height': 0, ease: Sine.easeOut,
                    onComplete: function() {

                        $('html').removeClass('__topbanner-show');
                        $('.mm_topbanner').remove();

                    }
                });
            }
        </script>
    </div>
    <!--// 최상단배너 -->

    <!-- 화면 -->
    <div class="mm_view">
        <!-- 헤더 -->
        <div class="mm_header">
            <div class="mm_header-top">
                <div class="mm_inner mm_container">
                    <div class="mm_box-rside">
                        <ul>



                            <li><a href="/auth/login" data-href="{ '_type': 'link' }"><span>로그인</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/auth/regist/certificate" data-href="{ '_type': 'link' }"><span>회원가입</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/help" data-href="{ '_type': 'link' }"><span>고객센터</span></a></li>
                        </ul>





















                    </div>
                </div>
            </div>
            <div class="mm_inner">
                <h1><a href="/" data-href="{ '_type': 'link' }"><span class="mm_ir-blind">enter6</span></a></h1>
                <!-- 헤더 검색 -->
                <form id="frm" method="GET" action="/search_keyword">
                    <input type="hidden" name="_token" value="d9iTRXltmw0JwpgM41EKkvYij1nGnau1hCqsuocJ">
                    <input type="hidden" name="keyword"/>
                </form>
                <div class="mm_header-search">
                    <a href="#mm_search" class="btn_search">
                        <span class="mm_ir-blind">검색하기</span>
                        <ul>
                            <li><span>인기검색어</span></li>
                            <li><span>최근검색어</span></li>
                        </ul>
                    </a>
                    <!-- (D) 키워드배너는 돋보기를 클릭할 때만 링크가 이동됩니다. -->
                    <div class="mm_header-search-keyword">
                        <a href="#" data-href="{ '_type': 'link' }" style="z-index:auto"><i class="mco_search"></i><span class="mm_ir-blind">바로가기</span></a>
                    </div>

                    <!-- 전체 검색영역 -->
                    <div id="mm_search" class="mm_search">
                        <div class="mm_inner">
                            <div class="mm_search-form">
                                <div class="mm_form-text">
                                    <button type="button" class="btn_text-clear"><i class="mco_form-clear"></i><span class="mm_ir-blind">지우기</span></button>
                                    <label>
                                        <input type="text" id="dev_search-keyword" class="textfield"><i class="bg_text"></i>
                                        <span class="text_placeholder mm_ir-blind">검색어</span>
                                    </label>
                                </div>
                                <button type="button" class="btn_submit" onclick="search()"><i class="mco_search"></i><span class="mm_ir-blind">검색하기</span></button>
                            </div>

                            <!-- 검색자동완성 -->
                            <div class="mm_search-autocomplete">
                                <!-- (D) 최대 10개까지 노출합니다. -->
                                <div class="mm_search-autocomplete-list" id="search_autocomplete_list">
                                </div>

                                <section class="mm_search-autocomplete-category" id="search_autocomplete_category">
                                </section>

                                <section class="mm_search-autocomplete-brand" id="search_autocomplete_brand">
                                </section>
                            </div>
                            <!--// 검색자동완성 -->

                            <!-- 검색어목록 -->
                            <div class="mm_search-list">
                                <div class="mm_search-list-inner">
                                    <section>
                                        <h6><span>인기 검색어</span></h6>
                                        <ol id="hot_keywords">
                                        </ol>
                                    </section>

                                    <section id="recent_keywords">
                                    </section>
                                </div>
                            </div>
                            <!--// 검색어목록 -->

                            <div class="mm_search-menu">
                                <ul>
                                    <li><a href="https://mall.mmonstar.co.kr/help" data-href="{ '_type': 'link' }"><i class="mco_cs"></i><span>고객센터</span><i class="mco_link __mco_sm__"></i></a></li>
                                    <li><a href="https://mall.mmonstar.co.kr/mypage/index" data-href="{ '_type': 'link' }"><i class="mco_mypage"></i><span>마이페이지</span><i class="mco_link __mco_sm__"></i></a></li>
                                    <li><a href="https://mall.mmonstar.co.kr/mypage/shoppinginfo/ordered" data-href="{ '_type': 'link' }"><i class="mco_order"></i><span>주문/배송조회</span><i class="mco_link __mco_sm__"></i></a></li>
                                    <li><a href="https://mall.mmonstar.co.kr/mypage/ordered/cancel/apply" data-href="{ '_type': 'link' }"><i class="mco_return"></i><span>취소/반품/교환</span><i class="mco_link __mco_sm__"></i></a></li>
                                    <li><a href="https://mall.mmonstar.co.kr/help/qna" data-href="{ '_type': 'link' }"><i class="mco_inquiry"></i><span>1:1 문의하기</span><i class="mco_link __mco_sm__"></i></a></li>
                                </ul>
                            </div>

                            <button type="button" class="btn_search-close"><i class="mco_close"></i><span class="mm_ir-blind">검색창 닫기</span></button>
                        </div>
                    </div>
                    <!--// 전체 검색영역 -->
                </div>

                <!--// 헤더 검색 -->

                <!-- gnb -->
                <nav class="mm_gnb">
                    <div class="mm_gnb-inner">
                        <ul>
                            <li><a href="https://mall.mmonstar.co.kr/product/best" data-href="{ '_type': 'link' }"><span>베스트</span></a></li>

                            <li><a href="https://mall.mmonstar.co.kr/product/deal" data-href="{ '_type': 'link' }"><span>스윗딜</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/product/brandNow" data-href="{ '_type': 'link' }"><span>브랜드 NOW</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/event/event" data-href="{ '_type': 'link' }"><span>이벤트/혜택</span></a></li>
                        </ul>
                    </div>
                </nav>
                <!--// gnb -->

                <div class="mm_header-quick">
                    <ul>
                        <li>
                            <a href="https://mall.mmonstar.co.kr/cart/list" data-href="{ '_type': 'link' }">
                                <i class="mco_cart">
                                    <strong id="cart_count" class="text_badge">2</strong>
                                </i>
                                <span>장바구니</span>
                            </a>
                        </li>
                        <li>


                            <a href="https://mall.mmonstar.co.kr/mypage/index" data-href="{ '_type': 'link' }">
                                <i class="mco_mypage"></i>
                                <span>마이페이지</span>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="mm_dropdown mm_catemenu">
                    <button type="button" class="btn_dropdown btn_catemenu-toggle" title="펼쳐보기"><i class="ico_menu"></i><span>전체 카테고리</span></button>
                    <div class="mm_dropdown-item mm_catemenu-item">
                        <nav class="mm_dropdown-item-inner">
                            <ul class="mm_box-flex __flex_equal__">
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/001000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_woman__"></i>
                                            <span>여성패션</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001004000000000" data-href="{ '_type': 'link' }"><span>블라우스/셔츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001003000000000" data-href="{ '_type': 'link' }"><span>티셔츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001008000000000" data-href="{ '_type': 'link' }"><span>팬츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001009000000000" data-href="{ '_type': 'link' }"><span>스커트</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001001000000000" data-href="{ '_type': 'link' }"><span>원피스</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001002000000000" data-href="{ '_type': 'link' }"><span>니트/카디건</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001005000000000" data-href="{ '_type': 'link' }"><span>자켓</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001006000000000" data-href="{ '_type': 'link' }"><span>점퍼</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001007000000000" data-href="{ '_type': 'link' }"><span>코트</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/001010000000000" data-href="{ '_type': 'link' }"><span>베스트/조끼</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/002000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_man__"></i>
                                            <span>남성패션</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002001000000000" data-href="{ '_type': 'link' }"><span>티셔츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002002000000000" data-href="{ '_type': 'link' }"><span>셔츠/남방</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002004000000000" data-href="{ '_type': 'link' }"><span>팬츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002005000000000" data-href="{ '_type': 'link' }"><span>정장</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002003000000000" data-href="{ '_type': 'link' }"><span>니트/카디건/베스트</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002006000000000" data-href="{ '_type': 'link' }"><span>재킷</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002007000000000" data-href="{ '_type': 'link' }"><span>점퍼</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/002008000000000" data-href="{ '_type': 'link' }"><span>코트</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/003000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_unisex__"></i>
                                            <span>유니섹스/진 캐주얼</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003001000000000" data-href="{ '_type': 'link' }"><span>티셔츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003002000000000" data-href="{ '_type': 'link' }"><span>셔츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003010000000000" data-href="{ '_type': 'link' }"><span>원피스/스커트</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003003000000000" data-href="{ '_type': 'link' }"><span>팬츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003004000000000" data-href="{ '_type': 'link' }"><span>데님팬츠</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003005000000000" data-href="{ '_type': 'link' }"><span>니트/카디건</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003006000000000" data-href="{ '_type': 'link' }"><span>베스트/조끼</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003007000000000" data-href="{ '_type': 'link' }"><span>자켓</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003008000000000" data-href="{ '_type': 'link' }"><span>점퍼</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/003009000000000" data-href="{ '_type': 'link' }"><span>코트</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/004000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_leisure__"></i>
                                            <span>스포츠/레저</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/004001000000000" data-href="{ '_type': 'link' }"><span>스포츠의류</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/004002000000000" data-href="{ '_type': 'link' }"><span>스포츠슈즈</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/004003000000000" data-href="{ '_type': 'link' }"><span>스포츠가방/잡화</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/004004000000000" data-href="{ '_type': 'link' }"><span>아웃도어</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/004005000000000" data-href="{ '_type': 'link' }"><span>캠핑</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/004006000000000" data-href="{ '_type': 'link' }"><span>골프의류/용품</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/005000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_underware__"></i>
                                            <span>언더웨어</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/005001000000000" data-href="{ '_type': 'link' }"><span>여성언더웨어</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/005002000000000" data-href="{ '_type': 'link' }"><span>남성언더웨어</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/005003000000000" data-href="{ '_type': 'link' }"><span>커플언더웨어</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/006000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_kids__"></i>
                                            <span>키즈</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/006001000000000" data-href="{ '_type': 'link' }"><span>신생아의류</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/006002000000000" data-href="{ '_type': 'link' }"><span>유아의류</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/006003000000000" data-href="{ '_type': 'link' }"><span>아동의류</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/007000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_style__"></i>
                                            <span>잡화/명품/뷰티</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/007001000000000" data-href="{ '_type': 'link' }"><span>패션슈즈</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/007002000000000" data-href="{ '_type': 'link' }"><span>핸드백/잡화</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/007003000000000" data-href="{ '_type': 'link' }"><span>기타액세서리</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/007004000000000" data-href="{ '_type': 'link' }"><span>뷰티</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/007005000000000" data-href="{ '_type': 'link' }"><span>해외명품</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>
                                        <a href="https://mall.mmonstar.co.kr/product/category/008000000000000" data-href="{ '_type': 'link' }">
                                            <i class="mm_ico-category __ico_life__"></i>
                                            <span>라이프스타일</span>
                                        </a>
                                    </h6>
                                    <ul>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/008001000000000" data-href="{ '_type': 'link' }"><span>홈데코</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/008002000000000" data-href="{ '_type': 'link' }"><span>주방/욕실</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/008003000000000" data-href="{ '_type': 'link' }"><span>가전/가구</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/008004000000000" data-href="{ '_type': 'link' }"><span>문구/생활잡화</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/008005000000000" data-href="{ '_type': 'link' }"><span>취미</span></a></li>
                                        <li><a href="https://mall.mmonstar.co.kr/product/category/008006000000000" data-href="{ '_type': 'link' }"><span>푸드</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--// 헤더 -->

        <!-- 내용 -->
        <div id="mm_body" class="mm_page">
            <!-- 사이드요소 -->
            <div class="mm_sidebar">
                <div class="mm_inner">
                    <div class="mm_sidebar-lside">
                        <!-- 사이드 슬라이드배너 -->
                        <div class="mm_sidebar-banner">
                            <div class="mm_swiper">
                                <div class="mm_swiper-inner">
                                    <ul class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <a href="/product/brandNow" target="_self" data-href="{ '_type': 'link' }">
                                                <i class="image_banner">
                                                    <img class="mm_preload" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-preload="{ '_src': 'https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/upload/display_banner/46/1569288846575.jpg' }" alt="메이크업">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="swiper-count"></div>
                            </div>
                        </div>
                        <!--// 사이드 슬라이드배너 -->

                        <!-- 사이드 둥둥배너 -->
                        <div class="mm_sidebar-floating">
                            <a href="/event/event" target="_self" data-href="{ '_type': 'link' }">
                                <i class="image_banner">
                                    <img class="mm_preload" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-preload="{ '_src': 'https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/upload/display_banner/47/1569303158957.png' }" alt="마블"></i>
                                <i class="image_expand">
                                    <img class="mm_preload" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-preload="{ '_src': 'https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/upload/display_banner/47/1569303158183.png' }" alt="마블"></i>
                            </a>
                            <button type="button" class="btn_hide"><i class="mco_close"></i><span class="mm_ir-blind">배너 숨기기</span></button>
                        </div>
                        <!--// 사이드 둥둥배너 -->
                    </div>
                    <div class="mm_sidebar-rside">
                        <!-- 사이드 바로온 -->
                        <div class="mm_sidebar-direct __direct-on"><a href="https://mall.mmonstar.co.kr/directon" data-href="{ '_type': 'link' }"><span>바로접속</span><strong>ON</strong></a></div>
                        <!--// 사이드 바로온 -->

                        <!-- 사이드 최근본상품 -->
                        <section class="mm_sidebar-recent">
                            <h6><span>최근 본 상품</span></h6>
                            <div class="mm_swiper" data-swiper="{ 'configs': { 'autoplay': false } }">
                                <div class="mm_swiper-inner">
                                    <ul class="swiper-wrapper">
                                        <li class="swiper-slide">
                                            <ul>
                                                <li>
                                                    <a href="https://mall.mmonstar.co.kr/product/detail/310926" data-href="{ '_type': 'link' }" title="goods">
                                                        <i class="mm_preload mm_bg-contain image_product" data-preload="{ '_src': 'https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/images/product/00/00/31/09/26/s_0000310926.gif' }"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://mall.mmonstar.co.kr/product/detail/310958" data-href="{ '_type': 'link' }" title="goods">
                                                        <i class="mm_preload mm_bg-contain image_product" data-preload="{ '_src': 'https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/images/product/00/00/31/09/58/s_0000310958.gif' }"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="swiper-control">
                                    <div class="mm_box-inline">
                                        <button type="button" class="btn_swiper-prev"><i class="mco_prev __mco_circle__"></i><span class="mm_ir-blind">이전</span></button>
                                        <button type="button" class="btn_swiper-next"><i class="mco_next __mco_circle__"></i><span class="mm_ir-blind">다음</span></button>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--// 사이드 최근본상품 -->

                        <a href="#mm_app" class="btn_anchor-top" data-href="{ '_type': 'anchor' }" title="페이지 처음으로 이동"><i class="mco_up __mco_face__"></i><span>UP</span></a>
                        <a href="#mm_footer" class="btn_anchor-bottom" data-href="{ '_type': 'anchor' }" title="페이지 마지막으로 이동"><i class="mco_down __mco_face__"></i><span>DOWN</span></a>
                    </div>
                </div>
            </div>
            <!--// 사이드요소 -->

            <!-- 본문 -->
            <div class="mm_page-content">
                <!-- (D) 실제 내용을 추가하는 부분입니다. -->
                <div class="mm_inner">
                    <!-- 상단타이틀 -->
                    <div class="mm_box-flex m-order-title">
                        <h3 class="mm_flex-equal"><i class="mco_cart"></i><span>장바구니</span></h3>
                        <div class="m-order-step">
                            <!-- (D) 현재페이지의 li 요소에 "__on" 클래스와 "현재페이지" 타이틀을 추가합니다. -->
                            <ol>
                                <li class="__on" title="현재페이지"><span>1</span>장바구니<i class="mco_next"></i></li>
                                <li><span>2</span>주문서 작성<i class="mco_next"></i></li>
                                <li><span>3</span>주문완료</li>
                            </ol>
                        </div>
                    </div>
                    <!--// 상단타이틀 -->

                    <!-- 장바구니목록 -->
                    <div class="mm_list m-cart-list">
                        <table id="purchase_cart_list">
                            <caption><span>장바구니에 담긴 상품은 3일동안 보관되며, 오래 보관을 원하시는 상품은 찜하기를 눌러주세요</span></caption>
                            <colgroup>
                                <col>
                                <col style="width:100px">
                                <col style="width:100px">
                                <col style="width:100px">
                                <col style="width:100px">
                                <col style="width:100px">
                                <col style="width:100px">
                            </colgroup>
                            <thead>
                            <tr>
                                <th scope="col">
                                    <label class="mm_form-check">
                                        <input type="checkbox" class="check_all" name="dev_check-product" data-check="{ '_type': 'check_all' }" checked>
                                        <b class="mm_box-block">
                                            <i class="mco_form-check"></i>
                                            <span class="text_label mm_ir-blind">전체선택</span>
                                        </b>
                                    </label>
                                    <span>상품</span>
                                </th>
                                <th scope="col"><span>수량</span></th>
                                <th scope="col"><span>상품 금액</span></th>
                                <th scope="col"><span>할인 금액</span></th>
                                <th scope="col"><span>합계</span></th>
                                <th scope="col"><span>배송비/판매자</span></th>
                                <th scope="col"><span>주문</span></th>
                            </tr>
                            </thead>
                            <tbody>





                            <tr class="row" cart-idx="18">
                                <td>
                                    <div class="mm_order-item">
                                        <label class="mm_form-check">
                                            <input type="checkbox" name="dev_check-product" cart-idx="18" data-device="0" data-opt-count="1" data-option-stock="10">
                                            <b class="mm_box-block">
                                                <i class="mco_form-check"></i>
                                                <span class="text_label mm_ir-blind">선택</span>
                                            </b>
                                        </label>
                                        <figure>
                                            <i class="mm_preload mm_bg-contain image_product __preload-loaded" style="background-image: url('https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/images/product/00/00/31/09/26/s_0000310926.gif');"></i>
                                            <figcaption>
                                                <a href="https://mall.mmonstar.co.kr/product/detail/310926" data-href="{}" target="_blank" title="새 창 열림"><span>금귀걸이</span></a>
                                                <span class="text_option">14 </span>
                                                <a href="https://mall.mmonstar.co.kr/cart/list/310926?opt_id=2620887&amp;opt_cnt=1" class="text_option-change" data-href="{ '_type': 'modal' }"><span>옵션/수량 변경<i class="mco_link"></i></span></a>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </td>
                                <td><span class="purchase_count" data-opt-count="1">1</span><br>
                                </td>
                                <td><span class="text_price product" ori-price="40000" amount-price="">40,000</span></td>
                                <td>
											<span class="text_price discount" ori-price="0.00" amount-price="">
												0
											</span>
                                </td>
                                <td><span class="text_price total" amount-price="0"></span></td>

                                <td><span class="text_ship delivery" amount-price="0">무료배송</span><br><span class="text_seller">왕십리_AnDew</span></td>
                                <td>
                                    <div class="mm_btngroup">
                                        <a href="#" class="mm_btn __btn_sm_primary__ direct_order"><span>바로구매</span></a>
                                        <button type="button" id="wish_btn" class="mm_toggle mm_like " data-toggle="{ 'onOn': 'addWishProduct', 'onOnArgs': ['310926'], 'onOff': 'deleteWishProduct' }" wish-idx=""><i class="mco_like"></i><span>찜하기</span></button>
                                        <button type="button" class="btn_remove item_remove"><span>삭제 X</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>



                            <tr class="row" cart-idx="17">
                                <td>
                                    <div class="mm_order-item">
                                        <label class="mm_form-check">
                                            <input type="checkbox" name="dev_check-product" cart-idx="17" data-device="0" data-opt-count="1" data-option-stock="34">
                                            <b class="mm_box-block">
                                                <i class="mco_form-check"></i>
                                                <span class="text_label mm_ir-blind">선택</span>
                                            </b>
                                        </label>
                                        <figure>
                                            <i class="mm_preload mm_bg-contain image_product __preload-loaded" style="background-image: url('https://image.mmonstar.co.kr/data/mmonstar_data/__mmonstar_dev__/images/product/00/00/31/09/58/s_0000310958.gif');"></i>
                                            <figcaption>
                                                <a href="https://mall.mmonstar.co.kr/product/detail/310958" data-href="{}" target="_blank" title="새 창 열림"><span>라임 형광 패치 맨투맨</span></a>
                                                <span class="text_option">라임 L</span>
                                                <a href="https://mall.mmonstar.co.kr/cart/list/310958?opt_id=2620977&amp;opt_cnt=1" class="text_option-change" data-href="{ '_type': 'modal' }"><span>옵션/수량 변경<i class="mco_link"></i></span></a>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </td>
                                <td><span class="purchase_count" data-opt-count="1">1</span><br>
                                </td>
                                <td><span class="text_price product" ori-price="90000" amount-price="">90,000</span></td>
                                <td>
											<span class="text_price discount" ori-price="0.00" amount-price="">
												0
											</span>
                                </td>
                                <td><span class="text_price total" amount-price="0"></span></td>

                                <td><span class="text_ship delivery" amount-price="0">무료배송</span><br><span class="text_seller">왕십리_ADIDAS</span></td>
                                <td>
                                    <div class="mm_btngroup">
                                        <a href="#" class="mm_btn __btn_sm_primary__ direct_order"><span>바로구매</span></a>
                                        <button type="button" id="wish_btn" class="mm_toggle mm_like " data-toggle="{ 'onOn': 'addWishProduct', 'onOnArgs': ['310958'], 'onOff': 'deleteWishProduct' }" wish-idx=""><i class="mco_like"></i><span>찜하기</span></button>
                                        <button type="button" class="btn_remove item_remove"><span>삭제 X</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="mm_list-foot">
                            <div class="mm_box-rside">
                                <button type="button" id="selected_remove_item" class="btn_remove"><span>선택삭제 X</span></button>

                            </div>
                        </div>
                        <div class="mm_attention">
                            <ul>
                                <li>상기 리스트에 노출되는 금액은 개인별 쿠폰 적용 전입니다. 쿠폰 적용 시 결제 금액은 달라질 수 있습니다</li>
                                <li>주문결제 시 같은 셀러별로 상품이 묶일 경우 배송비는 달라질 수 있습니다</li>
                            </ul>
                        </div>
                    </div>
                    <!--// 장바구니목록 -->

                    <!-- 상품결제금액 -->
                    <section class="mm_list m-order-payment">
                        <h4 class="mm_heading"><span>상품 결제금액</span></h4>
                        <table>
                            <colgroup>
                                <col style="width:25%">
                                <col style="width:25%">
                                <col style="width:25%">
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th scope="col"><span>총 상품금액 (상품: <span id="checked_product_cnt"></span>개)</span></th>
                                <th scope="col"><span>총 할인금액</span></th>
                                <th scope="col"><span>총 배송비</span></th>
                                <th scope="col"><span>최종결제 예상금액</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span id="total_product_price" class="text_price">0</span></td>
                                <td><i class="ico_calc-minus"></i><span id="total_discount_price" class="text_price">0</span></td>
                                <td><i class="ico_calc-plus"></i><span id="total_delivery_price" class="text_price">0</span></td>
                                <td><i class="ico_calc-equal"></i><span id="total_amount" class="text_price"><strong>0</strong></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </section>
                    <!--// 상품결제금액 -->

                    <div class="mm_btngroup m-cart-btngroup">
                        <div class="mm_box-inline">
                            <button type="button" id="selected_order" class="mm_btn __btn_xl_line_darkest__"><span>선택상품 주문</span>
                            </button>
                            <button type="button" id="all_products_order" class="mm_btn __btn_xl_primary__"><span>전체상품 주문</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--// 본문 -->

            <!-- 푸터 -->
            <div id="mm_footer" class="mm_footer">
                <!-- 푸터 - 공지사항 -->
                <div class="mm_footer-notice">
                    <div class="mm_inner">
                        <section class="mm_footer-notice-list">
                            <h5><span>공지<br>사항</span></h5>
                            <ul>
                                <li>
                                    <a href="https://mall.mmonstar.co.kr/help/notice/41" data-href="{ '_type': 'link' }">
                                        <p>테스트입니당</p>
                                        <span class="text_date">2018.12.31</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://mall.mmonstar.co.kr/help/notice/40" data-href="{ '_type': 'link' }">
                                        <p>10월 '적립금 페이백 이벤트' 당첨자 발표</p>
                                        <span class="text_date">2018.11.01</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://mall.mmonstar.co.kr/help/notice/23" data-href="{ '_type': 'link' }">
                                        <p>2018년 11월 신용카드 무이자할부 혜택</p>
                                        <span class="text_date">2018.11.01</span>
                                    </a>
                                </li>
                            </ul>
                        </section>
                        <section class="mm_footer-notice-cs">
                            <h5><span>고객<br>센터</span></h5>
                            <p class="text_hours">AM 10:00 ~ PM 5:00</p>
                            <p class="text_tel">1588 <span class="text_tilde">-</span> 1234</p>
                            <p class="text_add">PM 12:00 ~ PM 1:00 및 주말 제외<br>
                                <a href="mailto:help@mmonstar.co.kr" title="새 창 열림"><i class="mco_email"></i>
                                    <span>help@mmonstar.co.kr</span>
                                </a>
                            </p>
                        </section>
                    </div>
                </div>
                <!--// 푸터 - 공지사항 -->

                <!-- 푸터 - 메뉴 -->
                <div class="mm_footer-menu">
                    <div class="mm_inner">
                        <ul>
                            <li><a href="#" data-href="{ '_type': 'link' }"><span>회사소개</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/common/terms/use" data-href="{ '_type': 'link' }"><span>이용약관</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/common/terms/consign" data-href="{ '_type': 'link' }"><span>개인정보처리방침</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/common/terms/teen" data-href="{ '_type': 'link' }"><span>청소년보호정책</span></a></li>
                            <li><a href="https://mall.mmonstar.co.kr/help/alliance" data-href="{ '_type': 'link' }"><span>입점신청</span></a></li>
                        </ul>
                        <div class="mm_form-select mm_footer-menu-family" id="footer_family">
                            <label>
                                <select>
                                    <option value="">브랜드 패션쇼핑몰</option>
                                    <option value="#">Family Site</option>
                                </select>
                                <i class="mco_form-select"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <!--// 푸터 - 메뉴 -->

                <!-- 푸터 - 정보 -->
                <div class="mm_footer-info">
                    <div class="mm_inner">
                        <h6><span>(주)브랜드 패션쇼핑몰</span></h6>
                        <address>
                            <span>경기도 성남시 분당구 판교로 242 PDC C동 401호</span>
                            <span>대표이사: 장한필</span>
                            <span>개인정보담당자: 이희승</span><br>
                            <span>사업자등록번호: 123-45-67890</span>
                            <span>통신판매업신고: 2019-경기분당-9999호 <span>사업자정보확인</span></span>
                        </address>
                        <dl class="mm_footer-info-ascrow">
                            <dt>NICE구매안전(에스크로)서비스</dt>
                            <dd>안전거래를 위해 나이스페이먼츠 구매안전(에스크로)에 가입하여 서비스를 제공하고 있습니다<span>서비스 가입사실 확인</span></dd>
                        </dl>
                        <p class="text_copyright">&copy; (주)브랜드 패션쇼핑몰. all rights reserved.</p>
                        <div class="mm_footer-info-sns">
                            <ul>
                                <li><a href="#" class="btn_facebook" target="_blank" title="새 창 열림"><i class="mco_sns-facebook"></i><span class="mm_ir-blind">페이스북</span></a></li>
                                <li><a href="#" class="btn_instagram" target="_blank" title="새 창 열림"><i class="mco_sns-instagram"></i><span class="mm_ir-blind">인스타그램</span></a></li>
                                <li><a href="#" class="btn_blog" target="_blank" title="새 창 열림"><i class="mco_sns-blog"></i><span class="mm_ir-blind">블로그</span></a></li>
                                <li><a href="#" class="btn_twitter" target="_blank" title="새 창 열림"><i class="mco_sns-twitter"></i><span class="mm_ir-blind">트위터</span></a></li>
                                <li><a href="#" class="btn_kakaostory" target="_blank" title="새 창 열림"><i class="mco_sns-kakaostory"></i><span class="mm_ir-blind">카카오스토리</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--// 푸터 - 정보 -->

                <!-- 푸터 - 수상 -->
                <div class="mm_footer-awards">
                    <ul>
                        <li>
                            <figure>
                                <i class="image_award"><img class="mm_preload" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-preload="{ '_src': '/pc/images/common/award_2014_icsi.png' }" alt=""></i>
                                <figcaption>2019 엠몬스타<br>디자인어워드 금상</figcaption>
                            </figure>
                        </li>
                    </ul>
                </div>

                <!--// 푸터 - 수상 -->
            </div>

            <script>
                $(document).ready(function() {
                    $('#footer_family').change(function(){

                        var link_address = $(this).find('option:selected').val();

                        if(link_address != "")
                        {
                            window.open($(this).find('option:selected').val());
                        }
                    });
                });
            </script>
            <!--// 푸터 -->
        </div>
        <!--// 내용 -->
    </div>
    <!--// 화면 -->

    <!-- 현재 페이지 스크립트 -->
    <script>
        var product_price = 0;
        var discount_price = 0;
        var delivery_price = 0;
        var product_count = 0;
        var product_total_amount = 0;

        var total_product_price = 0;
        var total_discount_price = 0;
        var total_delivery_price = 0;
        var total_amount = 0;

        var isLogin = "";

        $(document).ready(function () {
            // Initialize
            $(".row").each(function () {
                product_count = parseInt($(this).find(".purchase_count").text());                   // 상품갯수
                product_price = parseInt($(this).find(".product").attr("ori-price"));               // 상품가격
                discount_price = parseInt($(this).find(".discount").attr("ori-price"));          // 할인가격
                delivery_price = parseInt($(this).find(".delivery").attr("amount-price"));          // 배송비
                $(this).find(".product").attr("amount-price", product_price * product_count);       // 상품 총액 = 상품가격 * 수량
                $(this).find(".discount").attr("amount-price", discount_price * product_count); 	// 할인 총액 =  할인가격 * 수량
                product_total_amount = (product_count * product_price) - (product_count * discount_price);            // 합계 = (상품가격 * 수량) - (할인가격 * 수량)
                $(this).find(".total").text(numberWithCommas(product_total_amount));

                total_product_price += product_count * product_price;                               // 총 상품금액
                total_discount_price += product_count * discount_price;                            // 총 할인금액
                total_delivery_price += delivery_price;                                             // 총 배송비

                total_amount = total_product_price - total_discount_price + total_delivery_price;   // 최종결제 예상금액

                $("#total_product_price").text(numberWithCommas(total_product_price));
                $("#total_discount_price").text(numberWithCommas(total_discount_price));
                $("#total_delivery_price").text(numberWithCommas(total_delivery_price));
                $("#total_amount > strong").text(numberWithCommas(total_amount));
            });

            // Change product count
            $('.mm_stepper input:text').change(function () {
                product_count = parseInt($(this).parents('tr .mm_stepper').find("input").val());
                product_price = parseInt($(this).parents("tr").find('.product').attr("ori-price"));
                discount_price = parseInt($(this).parents("tr").find('.discount').attr("ori-price"));
                delivery_price = parseInt($(this).parents("tr").find('.delivery').attr("amount-price"));

                product_total_amount = (product_price * product_count) - (discount_price * product_count) + delivery_price;
                $(this).parents("tr").find(".product").attr("amount-price", product_price * product_count);
                $(this).parents("tr").find(".discount").attr("amount-price", discount_price * product_count);
                $(this).parents("tr").find(".total").text(numberWithCommas(product_total_amount));

                total_price();
            });

            // Delete Row
            $(".item_remove").click(function () {
                mm.bom.confirm("선택한 상품을 장바구니에서 삭제하시겠습니까?", del_product, {args: $(this).closest('tr').attr('cart-idx')});

                // Product Delete Function
                function del_product() {
                    var arrTmp = _.values(arguments);
                    var confirmChk = arrTmp[0];
                    var cartIdx = new Array();
                    cartIdx = arrTmp[1].split(',');

                    if (confirmChk) {
                        axios.post('/cart/list/delete', {
                            _token: $("[name='_token']").val(),
                            type: "row",
                            cart_ix: cartIdx
                        })
                            .then(function (response) {
                                mm.bom.alert(response.data.msg, function(){
                                    location.reload();
                                });
                            })
                            .catch(function (response) {
                                // console.log(response)
                            });
                    } else {
                        return false;
                    }
                }
            });

            // Selected Delete
            $("#selected_remove_item").click(function () {
                var arrCartIdx = new Array();
                if ($("#purchase_cart_list").find(".row").length > 0) {
                    arrCartIdx = checked_cart_index_array("deleted");

                    if (arrCartIdx.length > 0) {
                        mm.bom.confirm("선택한 상품을 장바구니에서 삭제하시겠습니까?", del_products, {_title: "확인", args: arrCartIdx});
                        return false;
                    }

                } else {
                    mm.bom.alert("장바구니가 비어있습니다.");
                    return false;
                }

                // Products Delete Function
                function del_products() {
                    var arrCartIdx = _.values(arguments);
                    var confirmChk = arrCartIdx[0];
                    arrCartIdx.shift();

                    if (confirmChk) {
                        axios.post('/cart/list/delete', {
                            _token: $("[name='_token']").val(),
                            type: 'list',
                            cart_ix: arrCartIdx
                        })
                            .then(function (response) {
                                mm.bom.alert(response.data.msg, function(){
                                    location.reload();
                                });
                            })
                            .catch(function (response) {
                                // console.log(response)
                            });
                    }
                }
            });

            // All Seleted
            $(".check_all").change(function () {
                if ($(this).is(":checked") == true) {
                    total_price("checkall");
                } else {
                    $("#checked_product_cnt").text(0);
                    $("#total_product_price").text(0);
                    $("#total_discount_price").text(0);
                    $("#total_delivery_price").text(0);
                    $("#total_amount > strong").text(0);
                    //$("#total_amount").text(0);
                }
            });

            // Each Seleted
            $(".row input[type=checkbox]").click(function () {
                total_price();
            });

            // Direct Order(바로구매)
            $(".direct_order").click(function () {
                var arrCartIdx = new Array();
                var cartIdx = $(this).parents('tr').attr('cart-idx');
                var count = parseInt($(this).parents('tr').find('[name="dev_check-product"]').attr('data-opt-count'));
                var stock = parseInt($(this).parents('tr').find('[name="dev_check-product"]').attr('data-option-stock'));
                var device = parseInt($(this).parents('tr').find('[name="dev_check-product"]').attr('data-device'));

                if (device == -1) {
                    mm.bom.alert("해당 기기에서는 구매가 불가능한 상품입니다.");
                    return false;
                }
                if(count > stock) {
                    mm.bom.alert('재고가 부족합니다. 수량을 확인해 주세요.');
                    return false;
                }

                arrCartIdx = cartIdx.split(',');
                append_form_post_data(arrCartIdx);
            });

            // Selected Product Order(선택상품 주문)
            $("#selected_order").click(function () {
                checked_cart_index_array("checked");
            });

            // All Product Order(전체상품 주문)
            $("#all_products_order").click(function () {
                checked_cart_index_array("all");
            });

            total_price();
        });

        // Form Submit(주문하기)
        function append_form_post_data(idx) {
            var url = "";
            var __token = $('meta[name="_token"]').attr('content');

            if (idx.length < 1 || idx == undefined) {
                mm.bom.alert('선택하신 상품이 없습니다.');
                return false;
            } else {
                if(isLogin) {
                    url = "https://mall.mmonstar.co.kr/order/m_write";
                } else {
                    url = "/auth/pay/order";
                }
            }

            var $form = $("<form action='"+url+"' method='POST'></form>");
            $form.appendTo("body");
            var input_cartIdx = $("<input type='hidden' value='"+idx+"' name='arrIdx'>");
            var input_token = $("<input type='hidden' value='"+__token+"' name='_token'>");

            $form.append(input_cartIdx);
            $form.append(input_token);
            $form.submit();
        }

        // Checked List Cart Index
        function checked_cart_index_array(type) {
            var arrOriCartIdx = new Array();
            var arrCartIndex = new Array();
            var arrRstCartIdx = new Array();
            var check_flag = 0;					// 주문서로 넘기기 위한 구분값(1: 허용 / 0: 제한)

            $('.row').find('input[type=checkbox]').each(function () {
                if(type == "all") {
                    this.checked = "true";
                }

                arrOriCartIdx = $(this).attr("cart-idx").split(',');

                var count = parseInt($(this).attr('data-opt-count'));
                var stock = parseInt($(this).attr('data-option-stock'));
                var device = parseInt($(this).attr('data-device'));

                // Device 전용 상품 Check
                if($(this).prop("checked") && (count <= stock) && (device == -1)){
                    mm.bom.alert("해당 기기에서는 구매가 불가능한 상품입니다.");
                    return false;
                }

                // 재고 수량 Check
                if($(this).prop("checked") && (count > stock) && (type == "checked" || type == "all")) {
                    mm.bom.alert('재고가 부족합니다. 수량을 확인해 주세요.');
                    check_flag = 0;
                    return false;
                } else if(($(this).prop("checked") && (count <= stock)) || ($(this).prop("checked") && type == 'deleted')) {
                    arrCartIndex.push(arrOriCartIdx);
                    check_flag = 1;
                } else {
                    check_flag = 1;
                }
            });

            $.each(arrCartIndex, function(index, item){
                $.each(item, function(idx, v){
                    arrRstCartIdx.push(v);
                });
            });

            if(type == 'deleted') {
                return arrRstCartIdx;
            }

            if(check_flag == 1) {
                append_form_post_data(arrRstCartIdx);
            }
        }

        // Append html
        function append_html_tags() {
            var html_tags = "<tr>" +
                "<td colspan='7'>" +
                "<p class='mm_text-none'>장바구니가 비어있습니다</p>" +
                "</td>" +
                "</tr>";

            $("#purchase_cart_list > tbody").append(html_tags);
            $("input:checkbox[name='dev_check-product']").prop("checked", false);
        }

        // Total Purchase Price Initialize
        function total_price(action) {
            $("#checked_product_cnt").text($('.row input:checkbox:checked').length);
            var total_product_price = 0;
            var total_discount_price = 0;
            var total_delivery_price = 0;

            if (action == 'checkall') {
                $("#checked_product_cnt").text($(".row input[type=checkbox]").length);
            }

            $(".row input[type=checkbox]").each(function () {
                if ($(this).prop("checked") == true || action == "checkall") {
                    total_product_price += parseInt($(this).closest("tr").find(".product").attr("amount-price"));
                    total_discount_price += parseInt($(this).closest("tr").find(".discount").attr("amount-price"));
                    total_delivery_price += parseInt($(this).closest("tr").find(".delivery").attr("amount-price"));
                }
            });

            $("#total_product_price").text(numberWithCommas(total_product_price));
            $("#total_discount_price").text(numberWithCommas(total_discount_price));
            $("#total_delivery_price").text(numberWithCommas(total_delivery_price));

            total_amount = total_product_price - total_discount_price + total_delivery_price;
            $("#total_amount > strong").text(numberWithCommas(total_amount));
        }
    </script>
    <script>
        $(function() {
            cm.builder.buildRecentKeywords("#recent_keywords",'null');
            cm.builder.buildHotKeyword('#hot_keywords', '[]');

            /**
             * Enter Key 를 누를 때 search() 을 실행합니다
             *
             * @author    TaehyunJeong
             * @added      2019-06-07
             * @updated  2019-06-08
             */
            cm.event.onKeypress([new cm.event.onKeyPressObj(cm.event.key.enter, function() {
                return $("#dev_search-keyword")[0] == document.activeElement;
            }, function() {
                mm.bom.alert("다이퀘스트 연결이 필요합니다.");
                return;
                search();
            })]);

            // (D) 검색어 자동완성영역 노출 샘플로 수정해서 적용해주세요.
            $('#dev_search-keyword').on('keyup change', function() {
                var $autocomplete = $('.mm_search-autocomplete');
                if ($.trim($(this).val()).length > 0) {
                    $autocomplete.addClass('__autocomplete-on');

                    /**
                     * key 입력이 발생 하면 자동 완성 목록을 불러옵니다
                     *
                     * @author    TaehyunJeong
                     * @added      2019-04-17
                     * @updated  2019-04-17
                     */
                    callAutoComplete($(this).val());
                }
                else $autocomplete.removeClass('__autocomplete-on');

            });


        });

        /**
         * 검색 버튼을 누를 경우 싫행됩니다
         *
         * @author    TaehyunJeong
         * @added      2019-04-19
         * @updated  2019-04-22
         */
        function search(keyword){
            var value = keyword == null ? $('#dev_search-keyword').val() : keyword;
            if(value == ""){
                mm.bom.alert('검색어가 올바르게 입력되지 않았습니다', function () {
                    mm.focus.in('#dev_search-keyword');
                });
            } else {
                mm.bom.alert("다이퀘스트 연결이 필요합니다.");
                return;
                cm.functions.axios.call({
                    url: "/search_keyword/isNotAllowKeyword/",
                    method: 'GET',
                    responseType: 'json',
                    data: {"keyword" : value},
                    onSuccess: function (response) {
                        if (response.data) {
                            var alert_text = "해당 키워드로 검색할 수 없습니다";
                            mm.form.alert("#dev_search-keyword", alert_text);
                        } else {
                            addRecentKeyword(value);
                        }
                    },
                    onError: function (response) {
                        cm.object.log(response);
                        mm.bom.alert("검색어 검색 여부를 확인 중 문제가 발생하였습니다");
                    }
                });
            }
        }

        /**
         * 입력한 keyword 값을 이용하여 자동완성, 카테고리, 브랜드 데이터를 설정합니다
         * keyword 값은 highlight 됩니다
         *
         * @param      keyword
         * @author    TaehyunJeong
         * @added      2019-04-17
         * @updated  2019-06-07
         */
        function callAutoComplete(keyword) {
            cm.functions.axios.call({
                url: "/search_keyword/autoComplete",
                method: 'GET',
                data: {"keyword" : keyword},
                responseType: 'json',
                onSuccess: function (response) {
                    var result = response.data;

                    changeSearchData(keyword, "#search_autocomplete_list", result['autoResultList'], "", function (element) {
                        return element;
                    }, function (element){
                        return "javascript:search('"+element+"')";
                    }, function() {
                        return "<p class=\"mm_text-none\"><i class=\"mco_none\"></i>추천 검색어가 없습니다</p>";
                    });
                    changeSearchData(keyword, "#search_autocomplete_category", result['categoryResultList'], "<h6><span>추천 카테고리</span></h6>", function (element) {
                        return element['category'];
                    }, function (element){
                        return "/product/category/"+element['categoryID'];
                    }, function() {
                        return "<p class=\"text_none\">추천 카테고리가 없습니다</p>";
                    });
                    changeSearchData(keyword, "#search_autocomplete_brand", result['brandResultList'], "<h6><span>추천 브랜드</span></h6>", function (element) {
                        return element['keyword'];
                    }, function (element){
                        return "/brand/"+element['id'];
                    }, function() {
                        return "<p class=\"text_none\">추천 브랜드가 없습니다</p>";
                    });
                },
                onError: function (result) {
                    cm.object.log(result);
                }
            });
        }

        function changeState(first, second, isFirstShow) {
            if(isFirstShow) {
                $(first).css("display", "block");
                $(second).css("display", "none");
            } else {
                $(first).css("display", "none");
                $(second).css("display", "block");
            }
        }

        /**
         * 자동완성 검색 결과 데이터를 설정합니다
         *
         * @param      keyword
         * @param      selector
         * @param      list
         * @param      title
         * @param      textCallback
         * @author    TaehyunJeong
         * @added      2019-04-18
         * @updated  2019-06-07
         */
        function changeSearchData(keyword, selector, list, title, textCallback, clickCallback, emptyCallback) {
            var target = $(selector);
            var result = title;
            var template = function(text, click){
                return '<li><a href="'+ click +'" data-href="{ \'_type\': \'link\' }" ><span>' + cm.html.textHighlight(text, keyword) + '</span></a></li>'
            };
            if(cm.object.isEmptyArray(list)){
                result += emptyCallback();
            } else {
                result += '<ul>';
                list.forEach(function (element) {
                    var text = textCallback(element);
                    result += template(cm.html.textHighlight(text, keyword), clickCallback(element));
                });
                result += '</ul>';
            }
            $(target).html(result);
        }

        /**
         * 해당 id 를 가진 li tag 를 제거하고
         * 해당 idx 의 최근 검색어를 cookie 에서 제거합니다
         *
         * @param      id
         * 삭제할 최근 검색어 li id 입니다
         * @param      idx
         * 삭세할 검색어 idx 입니다
         * @author    TaehyunJeong
         * @added      2019-04-18
         * @updated  2019-04-18
         */
        function deleteRecentKeyword(id, idx){
            mm.ajax.load("/search_keyword/recentKeyword/delete/"+idx, {
                configs: {
                    method: 'get',
                    responseType: 'json',
                    responseEncoding: 'utf8',
                },
                onComplete: function (response) {
                    if(idx == -1){
                        $("#recent_keywords").html("");
                        cm.builder.buildRecentKeywords("#recent_keywords","");
                    } else {
                        $("#"+id).remove();
                        if($("#ul_recent_keywords").children().length == 0)
                            cm.builder.buildRecentKeywords("#recent_keywords","");
                    }
                }
            });
        }

        /**
         * 최근 검색어에 keyword 를 추가합니다
         *
         * @param      keyword
         * @author    TaehyunJeong
         * @added      2019-04-18
         * @updated  2019-05-30
         */
        function addRecentKeyword(keyword){
            cm.functions.axios.call({
                url: "/search_keyword/recentKeyword/insert",
                method: 'GET',
                data: {"keyword": keyword},
                responseType: 'json',
                onSuccess: function (response) {
                    $("input[name='keyword']").val(keyword);
                    frm.submit();
                },
                onError: function (response) {
                    cm.object.log(response);
                    mm.bom.alert("문제가 발생하였습니다");
                }
            });
        }

    </script>
    <!-- 공통 페이지 스크립트 -->
    <script src="/pc/js/app-pc-page.js?id=57575704e69978907502"></script>
    <!-- 공통 적용 스크립트 , 모든 페이지에 노출되도록 설치. 단 전환페이지 설정값보다 항상 하단에 위치해야함 -->
    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"> </script>
    <script type="text/javascript">
        if (!wcs_add) var wcs_add={};
        wcs_add["wa"] = "s_76833c30f43";
        if (!_nasa) var _nasa={};
        wcs.inflow('enter6.co.kr');
        wcs_do(_nasa);
    </script>
</div>

<!--
(D) 모달은 iframe, script 2가지 방식으로 사용할 수 있습니다.
스크립트 타입 모달은 body 하단에 추가합니다.
모달의 script id는 변경할 수 없습니다.
script id가 mm_modal-item의 class로 적용됩니다.
script 태그를 사용해야 할 경우 ((script))내용((/script)) 처럼 <> 대신 (())을 사용합니다.
-->

<!-- 스크립트 모달샘플 -->

<!--// 스크립트 모달샘플 -->
<!-- 192.168.99.99 -->
</body>
</html>
