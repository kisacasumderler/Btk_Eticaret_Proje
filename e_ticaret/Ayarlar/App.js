$(document).ready(function () {

    // slider 

    let index = 1;
    let maxIndex = $(".slider_img").length;

    $(".prev").click(function () {
        resimdegistir(-1);
    })
    $(".next").click(function () {
        resimdegistir(+1);
    })

    function resimdegistir(deger) {
        index += deger
        if (index > maxIndex) {
            index = 1;
        }
        if (index < 1) {
            index = maxIndex;
        }
        // index-1 / indexe ver 

        $(".slider_img").hide();
        $(".slider_img").eq(index - 1).fadeIn("slow");
        $(".slider_circle").css({ "width": "1.5rem", "height": "1.5rem", "background": "rgba(255, 255, 255, 0.419)" })
        $(".slider_circle").eq(index - 1).css({ "width": "1.5rem", "height": "1.5rem", "background": "white" });

        clearInterval(zaman);
        zaman = window.setInterval(function calistir() {
            index = index + 1;
            if (index > maxIndex) {
                index = 1;
            }
            if (index < 1) {
                index = maxIndex;
            }
            $(".slider_img").hide();
            $(".slider_img").eq(index - 1).fadeIn();
            $(".slider_circle").css({ "width": "1.5rem", "height": "1.5rem", "background": "rgba(255, 255, 255, 0.419)" })
            $(".slider_circle").eq(index - 1).css({ "width": "1.5rem", "height": "1.5rem", "background": "white" });
        }, 4000);

    }

    let zaman = window.setInterval(function calistir() {
        index = index + 1;
        if (index > maxIndex) {
            index = 1;
        }
        if (index < 1) {
            index = maxIndex;
        }
        $(".slider_img").hide();
        $(".slider_img").eq(index - 1).fadeIn();
        $(".slider_circle").css({ "width": "1.5rem", "height": "1.5rem", "background": "rgba(255, 255, 255, 0.419)" })
        $(".slider_circle").eq(index - 1).css({ "width": "1.5rem", "height": "1.5rem", "background": "white" });
    }, 4000);

    // slider mobile 

    let Index2 = 1;
    let maxIndex2 = $(".slider_imgMobile").length;

    $(".Mobileprev").click(function () {
        resimdegistir2(-1);
    })
    $(".Mobilenext").click(function () {
        resimdegistir2(+1);
    })

    function resimdegistir2(deger) {
        Index2 += deger
        if (Index2 > maxIndex2) {
            Index2 = 1;
        }
        if (Index2 < 1) {
            Index2 = maxIndex2;
        }
        // Index2-1 / Index2e ver 

        $(".slider_imgMobile").hide();
        $(".slider_imgMobile").eq(Index2 - 1).fadeIn("slow");
        $(".slider_circleMobile").css({ "width": "1.5rem", "height": "1.5rem", "background": "rgba(255, 255, 255, 0.419)" })
        $(".slider_circleMobile").eq(Index2 - 1).css({ "width": "1.5rem", "height": "1.5rem", "background": "white" });

        clearInterval(zaman2);
        zaman2 = window.setInterval(function calistir() {
            Index2 = Index2 + 1;
            if (Index2 > maxIndex2) {
                Index2 = 1;
            }
            if (Index2 < 1) {
                Index2 = maxIndex2;
            }
            $(".slider_imgMobile").hide();
            $(".slider_imgMobile").eq(Index2 - 1).fadeIn();
            $(".slider_circleMobile").css({ "width": "1.5rem", "height": "1.5rem", "background": "rgba(255, 255, 255, 0.419)" })
            $(".slider_circleMobile").eq(Index2 - 1).css({ "width": "1.5rem", "height": "1.5rem", "background": "white" });
        }, 4000);

    }

    let zaman2 = window.setInterval(function calistir() {
        Index2 = Index2 + 1;
        if (Index2 > maxIndex2) {
            Index2 = 1;
        }
        if (Index2 < 1) {
            Index2 = maxIndex2;
        }
        $(".slider_imgMobile").hide();
        $(".slider_imgMobile").eq(Index2 - 1).fadeIn();
        $(".slider_circleMobile").css({ "width": "1.5rem", "height": "1.5rem", "background": "rgba(255, 255, 255, 0.419)" })
        $(".slider_circleMobile").eq(Index2 - 1).css({ "width": "1.5rem", "height": "1.5rem", "background": "white" });
    }, 4000);
    // urun detay 
    $(".kucukresimler li").click(function () {
        let i = $(this).index();
        $(".b_resim").hide();
        $(".b_resim").eq(i).show();
    })

    $(".DestekItem").click(function () {
        let indexNo = $(this).index();
        $(this).find("p").slideToggle();
        $(this).find("img").toggleClass("tamDondur");
    })
    $(".OnpenIcon").click(function () {
        $(".navbar").slideDown().css("display", "flex");
        $(this).hide();
        $(".closeIcon").css("display", "inline-block");
    })
    $(".closeIcon").click(function () {
        $(".navbar").slideUp();
        $(this).hide();
        $(".OnpenIcon").css("display", "inline-block");
    })
    $(".serchBtn").eq(0).focusin(function () {
        $(".serchBtn").eq(1).css("display", "block");
    })
    $(".serchBtn").eq(0).focusout(function () {
        $(".serchBtn").eq(1).click(function () {
            $(this).hide(2000);
        })
    })
    $(".puan").click(function () {
        $(this).find("label").addClass("active");
        $(this).prevAll().find("label").addClass("active");
        $(this).nextAll().find("label").removeClass("active");
    })
    if ($(window).width() < 600) {
        $(".hesabimRow li").css("display", "none");

        $(".mobileBar").click(function () {
            $(".hesabimRow").find("li").toggle();
            $(this).find("img").toggleClass("tamDondur");
        })
    }
    // buttons css 

    $("#RS_Button, #LS_Button").mousedown(function () {
        $(this).css("background", "#c4c4c4");
    })
    $("#RS_Button, #LS_Button").mouseup(function () {
        $(this).css("background", "#ffff");
    })

    // anasayfa ürünler 
    let degerbir, degeriki, degeruc, degerdort;

    // id en yeni ürünler 
    let boxkapsayici, box, LS_Button, RS_Button;
    boxkapsayici = $("#id .boxkapsayici");
    box = $("#id .box");
    boxWidth = box.outerWidth(true);
    LS_Button = $("#id #LS_Button");
    RS_Button = $("#id #RS_Button");

    degerbir = 0;
    RS_Button.click(function () {
        Scroll_On1(degerbir += boxWidth, boxkapsayici, LS_Button, RS_Button)
    });
    LS_Button.click(function () {
        Scroll_On1(degerbir -= boxWidth, boxkapsayici, LS_Button, RS_Button)
    });

    function Scroll_On1(deger, boxKapsayici, LsButton, RsButton) {
        let maxScroll = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));
        boxKapsayici.scrollLeft(deger);
        if (boxKapsayici.scrollLeft() == 0) {
            LsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() > 0) {
            LsButton.css("display", "flex");
        }
        if (boxKapsayici.scrollLeft() == maxScroll) {
            RsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() < maxScroll) {
            RsButton.css("display", "flex");
        }
        clearInterval(Urun1Zaman);

        Urun1Zaman = window.setInterval(function calistir() {
            degerbir = degerbir + boxWidth;
            maxScrollDeger = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));

            if (degerbir > maxScrollDeger) {
                degerbir = 1;
            }
            if (degerbir < 1) {
                degerbir = maxScrollDeger;
            }
            boxkapsayici.scrollLeft(degerbir);
            LsButton.css("display", "flex");
            RsButton.css("display", "flex");
        }, 4000);

    }

    let Urun1Zaman = window.setInterval(function calistir() {
        degerbir = degerbir + boxWidth;
        maxScrollDeger = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));

        if (degerbir > maxScrollDeger) {
            degerbir = 1;
        }
        if (degerbir < 1) {
            degerbir = maxScrollDeger;
        }

        boxkapsayici.scrollLeft(degerbir);
    }, 4000);

    // toplamsatissayisi 

    let boxkapsayici_, box_, LS_Button_, RS_Button_;
    boxkapsayici_ = $("#ToplamSatisSayisi .boxkapsayici");
    box_ = $("#ToplamSatisSayisi .box");
    LS_Button_ = $("#ToplamSatisSayisi #LS_Button");
    RS_Button_ = $("#ToplamSatisSayisi #RS_Button");

    degeriki = 0;
    RS_Button_.click(function () {
        Scroll_On2(degeriki += boxWidth, boxkapsayici_, LS_Button_, RS_Button_)
    });
    LS_Button_.click(function () {
        Scroll_On2(degeriki -= boxWidth, boxkapsayici_, LS_Button_, RS_Button_)
    });

    function Scroll_On2(deger, boxKapsayici, LsButton, RsButton) {
        let maxScroll = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));
        boxKapsayici.scrollLeft(deger);
        if (boxKapsayici.scrollLeft() == 0) {
            LsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() > 0) {
            LsButton.css("display", "flex");
        }
        if (boxKapsayici.scrollLeft() == maxScroll) {
            RsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() < maxScroll) {
            RsButton.css("display", "flex");
        }
        // console.log(deger);
        clearInterval(urun2Zaman);
        urun2Zaman = window.setInterval(function calistir() {
            degeriki = degeriki + boxWidth;
            maxScrollDeger = ((boxkapsayici_[0].scrollWidth) - (boxkapsayici_[0].clientWidth));

            if (degeriki > maxScrollDeger) {
                degeriki = 1;
            }
            if (degeriki < 1) {
                degeriki = maxScrollDeger;
            }

            boxKapsayici.scrollLeft(degeriki);
            LsButton.css("display", "flex");
            RsButton.css("display", "flex");
        }, 4000);

    }

    let urun2Zaman = window.setInterval(function calistir() {
        degeriki = degerbir + boxWidth;
        maxScrollDeger = ((boxkapsayici_[0].scrollWidth) - (boxkapsayici_[0].clientWidth));

        if (degeriki > maxScrollDeger) {
            degeriki = 1;
        }
        if (degerbir < 1) {
            degeriki = maxScrollDeger;
        }

        boxkapsayici_.scrollLeft(degeriki);
    }, 4000);

    // toplamyorumpuani

    let boxkapsayici__, box__, LS_Button__, RS_Button__;
    boxkapsayici__ = $("#toplamyorumpuani .boxkapsayici");
    box__ = $("#toplamyorumpuani .box");
    LS_Button__ = $("#toplamyorumpuani #LS_Button");
    RS_Button__ = $("#toplamyorumpuani #RS_Button");

    degeruc = 0;
    RS_Button__.click(function () {
        Scroll_On3(degeruc += boxWidth, boxkapsayici__, LS_Button__, RS_Button__)
    });
    LS_Button__.click(function () {
        Scroll_On3(degeruc -= boxWidth, boxkapsayici__, LS_Button__, RS_Button__)
    });

    function Scroll_On3(deger, boxKapsayici, LsButton, RsButton) {
        let maxScroll = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));
        boxKapsayici.scrollLeft(deger);
        if (boxKapsayici.scrollLeft() == 0) {
            LsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() > 0) {
            LsButton.css("display", "flex");
        }
        if (boxKapsayici.scrollLeft() == maxScroll) {
            RsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() < maxScroll) {
            RsButton.css("display", "flex");
        }
        // console.log(deger);
        clearInterval(urun3zaman);
        urun3zaman = window.setInterval(function calistir() {
            degeruc = degerbir + boxWidth;
            maxScrollDeger = ((boxkapsayici__[0].scrollWidth) - (boxkapsayici__[0].clientWidth));

            if (degeruc > maxScrollDeger) {
                degeruc = 1;
            }
            if (degerbir < 1) {
                degeruc = maxScrollDeger;
            }

            boxKapsayici.scrollLeft(degeruc);
            LsButton.css("display", "flex");
            RsButton.css("display", "flex");
        }, 4000);
    }

    let urun3zaman = window.setInterval(function calistir() {
        degeruc = degerbir + boxWidth;
        maxScrollDeger = ((boxkapsayici__[0].scrollWidth) - (boxkapsayici__[0].clientWidth));

        if (degeruc > maxScrollDeger) {
            degeruc = 1;
        }
        if (degerbir < 1) {
            degeruc = maxScrollDeger;
        }

        boxkapsayici__.scrollLeft(degeruc);
    }, 4000);

    // goruntulenmeSayisi

    let _boxkapsayici__, _box__, _LS_Button__, _RS_Button__;
    _boxkapsayici__ = $("#goruntulenmeSayisi .boxkapsayici");
    _box__ = $("#goruntulenmeSayisi .box");
    _LS_Button__ = $("#goruntulenmeSayisi #LS_Button");
    _RS_Button__ = $("#goruntulenmeSayisi #RS_Button");

    degerdort = 0;
    _RS_Button__.click(function () {
        Scroll_On4(degerdort += boxWidth, _boxkapsayici__, _LS_Button__, _RS_Button__);
    });
    _LS_Button__.click(function () {
        Scroll_On4(degerdort -= boxWidth, _boxkapsayici__, _LS_Button__, _RS_Button__);
    });


    function Scroll_On4(deger, boxKapsayici, LsButton, RsButton) {
        let maxScroll = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));
        boxKapsayici.scrollLeft(deger);
        if (boxKapsayici.scrollLeft() == 0) {
            LsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() > 0) {
            LsButton.css("display", "flex");
        }
        if (boxKapsayici.scrollLeft() == maxScroll) {
            RsButton.css("display", "none");
        }
        if (boxKapsayici.scrollLeft() < maxScroll) {
            RsButton.css("display", "flex");
        }
        // console.log(deger);
        clearInterval(urun4Zaman);
        urun4Zaman = window.setInterval(function calistir() {
            degerdort = degerbir + boxWidth;
            maxScrollDeger = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));

            if (degerdort > maxScrollDeger) {
                degerdort = 1;
            }
            if (degerbir < 1) {
                degerdort = maxScrollDeger;
            }

            boxKapsayici.scrollLeft(degerdort);
            LsButton.css("display", "flex");
            RsButton.css("display", "flex");
        }, 4000);
    }

    let urun4Zaman = window.setInterval(function calistir() {
        degerdort = degerbir + boxWidth;
        maxScrollDeger = ((_boxkapsayici__[0].scrollWidth) - (_boxkapsayici__[0].clientWidth));

        if (degerdort > maxScrollDeger) {
            degerdort = 1;
        }
        if (degerbir < 1) {
            degerdort = maxScrollDeger;
        }

        _boxkapsayici__.scrollLeft(degerdort);
    }, 4000);

    // ürün input 
    let f_group = $(".f_group");
    f_group.click(function () {
        $(this).siblings().css("border", "2px solid #c4c4c4");
        $(this).css("border", "2px solid #0088CC");
    });
})
