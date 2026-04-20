(window.url = (function () {
    function e() {
        return new RegExp(
            /(.*?)\.?([^\.]*?)\.?(com|net|org|biz|ws|in|me|co\.uk|co|org\.uk|ltd\.uk|plc\.uk|me\.uk|edu|mil|br\.com|cn\.com|eu\.com|hu\.com|no\.com|qc\.com|sa\.com|se\.com|se\.net|us\.com|uy\.com|ac|co\.ac|gv\.ac|or\.ac|ac\.ac|af|am|as|at|ac\.at|co\.at|gv\.at|or\.at|asn\.au|com\.au|edu\.au|org\.au|net\.au|id\.au|be|ac\.be|adm\.br|adv\.br|am\.br|arq\.br|art\.br|bio\.br|cng\.br|cnt\.br|com\.br|ecn\.br|eng\.br|esp\.br|etc\.br|eti\.br|fm\.br|fot\.br|fst\.br|g12\.br|gov\.br|ind\.br|inf\.br|jor\.br|lel\.br|med\.br|mil\.br|net\.br|nom\.br|ntr\.br|odo\.br|org\.br|ppg\.br|pro\.br|psc\.br|psi\.br|rec\.br|slg\.br|tmp\.br|tur\.br|tv\.br|vet\.br|zlg\.br|br|ab\.ca|bc\.ca|mb\.ca|nb\.ca|nf\.ca|ns\.ca|nt\.ca|on\.ca|pe\.ca|qc\.ca|sk\.ca|yk\.ca|ca|cc|ac\.cn|com\.cn|edu\.cn|gov\.cn|org\.cn|bj\.cn|sh\.cn|tj\.cn|cq\.cn|he\.cn|nm\.cn|ln\.cn|jl\.cn|hl\.cn|js\.cn|zj\.cn|ah\.cn|gd\.cn|gx\.cn|hi\.cn|sc\.cn|gz\.cn|yn\.cn|xz\.cn|sn\.cn|gs\.cn|qh\.cn|nx\.cn|xj\.cn|tw\.cn|hk\.cn|mo\.cn|cn|cx|cz|de|dk|fo|com\.ec|tm\.fr|com\.fr|asso\.fr|presse\.fr|fr|gf|gs|co\.il|net\.il|ac\.il|k12\.il|gov\.il|muni\.il|ac\.in|co\.in|org\.in|ernet\.in|gov\.in|net\.in|res\.in|is|it|ac\.jp|co\.jp|go\.jp|or\.jp|ne\.jp|ac\.kr|co\.kr|go\.kr|ne\.kr|nm\.kr|or\.kr|li|lt|lu|asso\.mc|tm\.mc|com\.mm|org\.mm|net\.mm|edu\.mm|gov\.mm|ms|nl|no|nu|pl|ro|org\.ro|store\.ro|tm\.ro|firm\.ro|www\.ro|arts\.ro|rec\.ro|info\.ro|nom\.ro|nt\.ro|se|si|com\.sg|org\.sg|net\.sg|gov\.sg|sk|st|tf|ac\.th|co\.th|go\.th|mi\.th|net\.th|or\.th|tm|to|com\.tr|edu\.tr|gov\.tr|k12\.tr|net\.tr|org\.tr|com\.tw|org\.tw|net\.tw|ac\.uk|uk\.com|uk\.net|gb\.com|gb\.net|vg|sh|kz|ch|info|ua|gov|name|pro|ie|hk|com\.hk|org\.hk|net\.hk|edu\.hk|us|tk|cd|by|ad|lv|eu\.lv|bz|es|jp|cl|ag|mobi|eu|co\.nz|org\.nz|net\.nz|maori\.nz|iwi\.nz|io|la|md|sc|sg|vc|tw|travel|my|se|tv|pt|com\.pt|edu\.pt|asia|fi|com\.ve|net\.ve|fi|org\.ve|web\.ve|info\.ve|co\.ve|tel|im|gr|ru|net\.ru|org\.ru|hr|com\.hr|ly|xyz)$/
        );
    }

    function t(e, t) {
        var n = e.charAt(0),
            i = t.split(n);
        return n === e ? i : i[(e = parseInt(e.substring(1), 10)) < 0 ? i.length + e : e - 1];
    }

    function n(e, t) {
        for (var n, i = e.charAt(0), r = t.split("&"), o = [], a = {}, s = [], l = e.substring(1), c = 0, u = r.length; c < u; c++)
            if (((o = r[c].match(/(.*?)=(.*)/)) || (o = [r[c], r[c], ""]), "" !== o[1].replace(/\s/g, ""))) {
                if (((o[2] = ((n = o[2] || ""), decodeURIComponent(n.replace(/\+/g, " ")))), l === o[1])) return o[2];
                (s = o[1].match(/(.*)\[([0-9]+)\]/)) ? ((a[s[1]] = a[s[1]] || []), (a[s[1]][s[2]] = o[2])) : (a[o[1]] = o[2]);
            }
        return i === e ? a : a[l];
    }

    return function (i, r) {
        var o,
            a = {};
        if ("tld?" === i) return e();
        if (((r = r || window.location.toString()), !i)) return r;
        if (((i = i.toString()), (o = r.match(/^mailto:([^\/].+)/)))) (a.protocol = "mailto"), (a.email = o[1]);
        else {
            if (((o = r.match(/(.*?)\/#\!(.*)/)) && (r = o[1] + o[2]), (o = r.match(/(.*?)#(.*)/)) && ((a.hash = o[2]), (r = o[1])), a.hash && i.match(/^#/))) return n(i, a.hash);
            if (((o = r.match(/(.*?)\?(.*)/)) && ((a.query = o[2]), (r = o[1])), a.query && i.match(/^\?/))) return n(i, a.query);
            if (
                ((o = r.match(/(.*?)\:?\/\/(.*)/)) && ((a.protocol = o[1].toLowerCase()), (r = o[2])),
                (o = r.match(/(.*?)(\/.*)/)) && ((a.path = o[2]), (r = o[1])),
                    (a.path = (a.path || "").replace(/^([^\/])/, "/$1").replace(/\/$/, "")),
                i.match(/^[\-0-9]+$/) && (i = i.replace(/^([^\/])/, "/$1")),
                    i.match(/^\//))
            )
                return t(i, a.path.substring(1));
            if (
                ((o = t("/-1", a.path.substring(1))) && (o = o.match(/(.*?)\.(.*)/)) && ((a.file = o[0]), (a.filename = o[1]), (a.fileext = o[2])),
                (o = r.match(/(.*)\:([0-9]+)$/)) && ((a.port = o[2]), (r = o[1])),
                (o = r.match(/(.*?)@(.*)/)) && ((a.auth = o[1]), (r = o[2])),
                a.auth && ((o = a.auth.match(/(.*)\:(.*)/)), (a.user = o ? o[1] : a.auth), (a.pass = o ? o[2] : void 0)),
                    (a.hostname = r.toLowerCase()),
                "." === i.charAt(0))
            )
                return t(i, a.hostname);
            e() && (o = a.hostname.match(e())) && ((a.tld = o[3]), (a.domain = o[2] ? o[2] + "." + o[3] : void 0), (a.sub = o[1] || void 0)),
                (a.port = a.port || ("https" === a.protocol ? "443" : "80")),
                (a.protocol = a.protocol || ("443" === a.port ? "https" : "http"));
        }
        return i in a ? a[i] : "{}" === i ? a : void 0;
    };
})()),
"undefined" != typeof jQuery &&
jQuery.extend({
    url: function (e, t) {
        return window.url(e, t);
    },
}),
    jQuery(document).ready(function () {

        var e = OB_CONFIG.base_url;

        if (((n = OB_CONFIG.base_url), "localhost" === jQuery(location).attr("hostname")))
            var t = "http://localhost:8080/index.php/",
                n = "http://localhost:8080/index.php/",
                i = "http://localhost:8080/";
        else if (OB_CONFIG.host !== jQuery(location).attr("hostname")) {
            t = OB_CONFIG.base_url + "outfitbuilder",
                n = OB_CONFIG.base_url,
                i = OB_CONFIG.host + '/';
        } else {
            t = "./outfitbuilder",
                n = "./apps/",
                i = "./";
        }
        if (jQuery("#outfitDesigner").length) {
            r = 0;
            var d,
                h = jQuery("#hirebuytoggle").attr("data-loadcode");
            h = "KSMS7SH2HCZNM8BJ2LH9H";
            //h = "KXGROSH2HCZNMRBJELH5H"; //This code does not exists in the old DB
            if ((jQuery("buytype").hasClass("active") && (h = "KSMS7SH2HCZNM8BJ2LH9B"), url("#ref"))) 21 === (d = url("#ref")).length && (h = d);

            function p() {
                var e = setInterval((function () {
                    jQuery(".select").length && (jQuery(".select").selectric({disableOnMobile: !1, nativeOnMobile: !1}),
                        clearInterval(e));
                }), 100);
            }

            jQuery(".select").selectric({
                disableOnMobile: !1,
                nativeOnMobile: !1
            }),
                p(),
                jQuery(document).on("click", "#hirebuytoggle li", (function (e) {
                    e.preventDefault(),
                    jQuery(this).hasClass("active") || (jQuery("#hirebuytoggle li").removeClass("active"), jQuery(this).addClass("active")), hiretype = "B", $completedCode = "KJP35SI1HCZNZSJJELH6B",
                    jQuery(this).hasClass("hiretype") && (hiretype = "H", $completedCode = "KJP35SH2HCZNZSJJELH6H"),
                        g($completedCode);

                })),
                jQuery(".previewicon").click((function (e) {
                    e.preventDefault(), jQuery("#outfitDesigner .preview_container").hasClass("active") ? jQuery("#outfitDesigner .preview_container").removeClass("active") : jQuery("#outfitDesigner .preview_container").addClass("active")
                }));

            function f() {

                new Swiper(".swiperOptions", {
                    loop: !0,
                    centeredSlides: !1,
                    slidesPerView: 5,
                    spaceBetween: 7,
                    breakpoints: {
                        320: {slidesPerView: 3, spaceBetween: 5},
                        480: {slidesPerView: 5, spaceBetween: 5},
                        640: {slidesPerView: 5, spaceBetween: 5},
                        780: {slidesPerView: 5, spaceBetween: 10},
                        840: {slidesPerView: 5, spaceBetween: 10},
                        1e3: {slidesPerView: 5, spaceBetween: 10, centeredSlides: !1},
                    },
                    pagination: {el: ".swiper-pagination"},
                    navigation: {
                        enabled: !0,
                        nextEl: ".swiper-button-options-next",
                        prevEl: ".swiper-button-options-prev"
                    },
                    scrollbar: {el: ".swiper-scrollbar"},
                }),
                    new Swiper(".optionSlider", {
                        loop: !0,
                        centeredSlides: !1,
                        slidesPerView: 5,
                        spaceBetween: 7,
                        breakpoints: {
                            320: {slidesPerView: 3, spaceBetween: 5},
                            480: {slidesPerView: 5, spaceBetween: 5},
                            640: {slidesPerView: 5, spaceBetween: 5},
                            780: {slidesPerView: 5, spaceBetween: 5},
                            840: {slidesPerView: 5, spaceBetween: 5},
                            2e3: {slidesPerView: 5, spaceBetween: 5},
                        },
                        pagination: {el: ".swiper-pagination"},
                        navigation: {enables: !0, nextEl: ".swiper-button-next2", prevEl: ".swiper-button-prev2"},
                        scrollbar: {el: ".swiper-scrollbar"},
                    });
            }

            function m() {
                var t = null;
                if (jQuery("#tags")) {
                    var e = {
                        source: (jQuery.ajax({
                            async: !1,
                            global: !1,
                            url: n + "outfits/gettartanlist",
                            dataType: "json",
                            success: function (e) {
                                t = e.nameslist;
                            }
                        }), t),
                        minLength: 2,
                        select: function (e, t) {
                            !function (e) {
                                jQuery.ajax({
                                    async: !1,
                                    global: !1,
                                    url: n + "namesearch/getname/" + e,
                                    dataType: "json",
                                    success: function (e) {
                                        console.log(e);
                                        var t = e.family_tartans;
                                        swatchimages = '<ul class="menu_options tartanlist">', jQuery.each(t, (function (e, t) {
                                            swatchclass = "", swatchId = t.tartan_id, swatchImage = t.tartan_swatch, swatchThumbnail = t.tartan_thumbnail, swatchVarientName = t.tartan_varient, swatchClanName = t.tartan_family_name, swatchCode = t.tartan_uniquecode, swatchimages += '<li class="quicktip" data-code="' + swatchCode + '"><img src="' + swatchThumbnail + '" alt="' + swatchClanName + " " + swatchVarientName + '" class="quicktip" data-toggle="tooltip" data-placement="top" title="" width="50" data-original-title="' + swatchClanName + " " + swatchVarientName + '" aria-describedby="tooltip' + swatchCode + '"></li>'
                                        })), swatchimages += "</ul>", jQuery("#searchswatches").html(swatchimages)
                                    },
                                    error: function (e) {
                                        console.error(e);
                                        return "error"
                                    }
                                })
                            }(t.item.item_id)
                        }
                    };

                    jQuery(document).on("keydown.autocomplete", "input#tags", (function () {
                        jQuery(this).autocomplete(e)
                    }));
                }
            }

            function g(e) {

                const container = document.getElementById("outfitDesignerMenu");

                fetch(n + "outfits/loadui/" + e)
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                        document.getElementById("outfit-builder-anchor").classList.add("loaded");
                    })
                    .then(() => {
                        l(e), m(), p(), f()
                    })
                    .catch(error => console.error('Error loading content:', error));
            }

            function handleSendToFriendLink(code) {
                const container = document.querySelector('.link-box');
                const link = container.querySelector('.link');
                const copyBtn = container.querySelector('a.copy-paste');

                // Copy Link to the clipboard
                copyBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    link.select();
                    link.setSelectionRange(0, 99999); // For mobile devices

                    // Copy the text inside the text field
                    navigator.clipboard.writeText(link.value);
                });

                //link.value = 'https://mccalls-highlandwear.myshopify.com/pages/outfit-builder/#ref=' + code;
                link.value = 'https://www.mccalls.co.uk/pages/outfit-builder/#ref=' + code;
            }

            /**
             *
             */
            function appendSizeDataToQuery() {


            }

            /**
             *
             * Inject model
             *
             * @param e
             */
            function l(e) {

                var t = n + "outfits/get/" + e;

                jQuery.ajax({
                    url: t,
                    type: "GET",
                    async: !1,
                    dataType: "json",
                    cache: !1,
                    success: function (r) {
                        const t = r.outputdata;
                        if (1 != t.status) {
                            // Error
                            var n = t.image;
                            jQuery("#previewimage").hide(),
                                jQuery("#previewimageMobile").hide(),
                                jQuery(".total-price").html(t.price),
                                jQuery(".customcode").html('<span class="error">Sorry we could not load this code.<br/>It could contain an item that is available for purchase only or that is no longer available.</span> '),
                                jQuery(".outfit-info").html("").hide();
                        }

                        if (!0 === t.status) {
                            n = t.image;
                            jQuery("#previewimage").removeClass("error"),
                                jQuery("#previewimage").hide().html(n).fadeIn(200),
                                jQuery("#previewimageMobile").removeClass("error"),
                                jQuery("#previewimageMobile").hide().html(n).fadeIn(200),
                                jQuery(".outfit-info").html(t.descHtml).show(),
                                jQuery(".customcode").html(e);


                            let url = 'https://www.mccalls.co.uk/pages/outfits-enquiry-to-mccalls/?code='+e;
                        //    let url = window.location.href.split('?')[0] + '?' + 'code=' + e;

                            jQuery(".sendEnquiryOutfit").attr("href",url);

                            handleSendToFriendLink(e);

                            var i = setInterval(function () {
                                jQuery(".total-price").length &&
                                (jQuery(".total-price").html(t.price),
                                jQuery(".total-price").html().trim().length > 0 &&
                                ("hire" == t.elements.outfittype
                                    ? (console.log("Hire"),
                                        jQuery(".hireOutfitForm .kiltOption").val(t.elements.tartan.tartan_name),
                                        jQuery(".hireOutfitForm .sporranOption").val(t.elements.sporran.product_name),
                                        jQuery(".hireOutfitForm .hoseOption").val(t.elements.hose.product_name),
                                        jQuery(".hireOutfitForm .shirtOption").val(t.elements.shirt.product_name),
                                        jQuery(".hireOutfitForm .neckwearOption").val(t.elements.neckwear.product_name),
                                        jQuery(".hireOutfitForm .jacketOption").val(t.elements.jacket.product_name),
                                        jQuery(".hireOutfitForm .shoeOption").val(t.elements.shoe.product_name),
                                        jQuery(".hireOutfitForm .codeOption").val(t.code),
                                        (upgrade = t.upgradeCost),
                                        (upgradeText = "Custom Upgrades (+ &pound;" + upgrade + ")"),
                                        jQuery(".hireOutfitForm .upgradeOption").val(upgradeText),
                                        jQuery(".hireOutfitForm .upgradeOption").attr("data-pricechange", upgrade))
                                    : (console.log("Purchase"),
                                        jQuery(".purchaseOutfitForm .kiltOption").val(t.elements.tartan.tartan_name),
                                        jQuery(".purchaseOutfitForm .sporranOption").val(t.elements.sporran.product_name),
                                        jQuery(".purchaseOutfitForm .hoseOption").val(t.elements.hose.product_name),
                                        jQuery(".purchaseOutfitForm .shirtOption").val(t.elements.shirt.product_name),
                                        jQuery(".purchaseOutfitForm .neckwearOption").val(t.elements.neckwear.product_name),
                                        jQuery(".purchaseOutfitForm .jacketOption").val(t.elements.jacket.product_name),
                                        jQuery(".purchaseOutfitForm .shoeOption").val(t.elements.shoe.product_name),
                                        jQuery(".purchaseOutfitForm .codeOption").val(t.code),
                                        (upgrade = t.upgradeCost),
                                        (pound = String.fromCharCode("163")),
                                        (upgradeText = "Custom Upgrades (+ " + pound + upgrade + ")"),
                                        jQuery(".purchaseOutfitForm .upgradeOption").val(upgradeText),
                                        jQuery(".purchaseOutfitForm .upgradeOption").attr("data-pricechange", upgrade)),
                                    jQuery(".sharecode").show(),
                                    clearInterval(i)));
                            }, 100);
                        }
                    },
                    error: function (e) {
                        console.error(e);
                    },
                });
            }

            setTimeout(function () {
                    jQuery("#outfitDesignerMenu").hasClass("newui") && f();
                },
                1000
            ),
                jQuery(document).on("click", ".outfit-element-menu ul li", function (e) {
                    console.log("CLICk");
                    e.preventDefault(), jQuery(".outfit-element-menu ul li").removeClass("active"), jQuery(this).addClass("active");

                    var t = jQuery(this).data("option");

                    jQuery(".option-group").removeClass("active"),
                    jQuery(".options-" + t).addClass("active");

                    if(jQuery("#previewimage").hasClass("zoom " + t)){
                        // Zoom out
                        jQuery("#previewimage").attr("class", "");
                        jQuery(".zoomout").addClass("d-none");
                        jQuery(".info-toggle").addClass("active");
                        jQuery(".outfit-info ").removeClass("d-none");
                        jQuery("#previewimage").removeAttr("class");
                    }else {
                        // Zoom in
                        jQuery(".zoomout").removeClass("d-none");
                        jQuery("#previewimage").attr("class", "");
                        jQuery("#previewimage").addClass("zoom " + t);
                        jQuery(".info-toggle").removeClass("active");
                        jQuery(".outfit-info ").addClass("d-none");
                    }
                       /* jQuery("#previewimage").hasClass("zoom " + t)
                            ? (jQuery("#previewimage").attr("class", ""),
                                jQuery(".zoomout").addClass("d-none"),
                                jQuery(".info-toggle").addClass("active"),
                                jQuery(".outfit-info ").removeClass("d-none"),
                                jQuery("#previewimage").removeAttr("class"))
                            : (jQuery(".zoomout").removeClass("d-none"),
                                jQuery("#previewimage").attr("class", ""),
                                jQuery("#previewimage").addClass("zoom " + t),
                                jQuery(".info-toggle").removeClass("active"),
                                jQuery(".outfit-info ").addClass("d-none")),*/

                        jQuery("#previewimageMobile").hasClass("zoom " + t)
                            ? (jQuery("#previewimageMobile").attr("class", ""),
                                jQuery(".zoomout").addClass("d-none"),
                                jQuery(".info-toggle").addClass("active"),
                                jQuery(".outfit-info ").removeClass("d-none"),
                                document.getElementById("previewimageMobile").scrollTo(0,0),
                                jQuery("#previewimageMobile").removeAttr("class"))
                            : (jQuery(".zoomout").removeClass("d-none"),
                                jQuery("#previewimageMobile").attr("class", ""),
                                jQuery("#previewimageMobile").addClass("zoom " + t),
                                console.log('SCROLL TO X', (400 - document.getElementById("previewimageMobile").offsetWidth)/2),
                                document.getElementById("previewimageMobile").scrollTo((400 - document.getElementById("previewimageMobile").offsetWidth)/2, 0),
                                jQuery(".info-toggle").removeClass("active"),
                                jQuery(".outfit-info ").addClass("d-none"));
                }),
                jQuery(document).on("click", ".zoomout", function (e) {
                    console.log("zoomout");
                    jQuery("#previewimage").attr("class", ""),
                        jQuery("#previewimageMobile").attr("class", ""),
                        jQuery(".zoomout").addClass("d-none"),
                        jQuery(".info-toggle").addClass("active"),
                        jQuery(".outfit-info ").removeClass("d-none"),
                        jQuery("#previewimage").removeAttr("class"),
                        jQuery("#previewimageMobile").removeAttr("class");
                        document.getElementById("previewimageMobile").scrollTo(0,0)
                }),
                jQuery(document).on("click", ".menu_options li", function (e) {

                    if ((e.preventDefault(), jQuery(this).hasClass("ignore"))) return !1;

                    jQuery(this).parent("ul").find("li").removeClass("active"),
                    jQuery(this).parent("ul").hasClass("tartanlist") && jQuery(".options-kilt .menu_options li").removeClass("active"),
                    jQuery(this).parent("ul").hasClass("necklist") && jQuery("#neckweartypes .menu_options li").removeClass("active"),
                    jQuery(this).parent("ul").hasClass("hoselist") && jQuery("#hosetypes .menu_options li").removeClass("active"),
                    jQuery(this).parent("ul").hasClass("sporranlist") && jQuery("#cantletypes .menu_options li").removeClass("active"),
                        jQuery(this).addClass("active"),
                        ($completedCode = (function () {
                            var e = jQuery(".options-kilt .menu_options li.active").data("code"),
                                t = jQuery(".options-sporran .menu_options li.active").data("code"),
                                n = jQuery(".options-shirt .menu_options li.active").data("code"),
                                i = jQuery("#neckweartypes").find("li.active").data("code"),
                                r = jQuery(".options-shoes .menu_options li.active").data("code"),
                                o = jQuery(".options-jackets .menu_options li.active").data("code"),
                                a = jQuery(".options-hose .menu_options li.active").data("code"),
                                s = jQuery("#hirebuytoggle").attr("data-type");
                            e || (e = jQuery(".options-kilt .menu_options li.defaultActive").data("code"));
                            t || (t = jQuery(".options-sporran .menu_options li.defaultActive").data("code"));
                            var l = "K" + e + t + "H" + n + "N" + i + r + o + "L" + a + s;
                            return l;
                        })()),
                        l($completedCode),
                        jQuery(".availabilityWarning").empty();
                    var t = jQuery(".options-kilt .menu_options li.active").data("code");
                    ("7OMW" != t && "JP35" != t && "FW5N" != t && "DYZN" != t && "6HWC" != t && "8W5R" != t && "25XC" != t) || jQuery(".availabilityWarning").html("This tartan is also available as trews.");
                    jQuery(".options-jackets .menu_options li.active").data("code");
                }),
                jQuery(document).on("click", ".submitcode", function () {
                    var e = jQuery(".savecode").val();
                    setTimeout(function () {
                        g(e);
                    }, 2e3);
                }),
                jQuery(document).on("click", ".submitcode2", function () {
                    var e = jQuery(".savecode2").val();
                    console.log(e),
                        setTimeout(function () {
                            g(e);
                        }, 2e3);
                }),
                jQuery(document).on("change", ".options-details select", function () {

                    (waistSize = jQuery(".hiddenWaistSize").val()),
                        jQuery(".purchaseOutfitForm .sizeWaistOption").val(waistSize),
                        jQuery(".hireOutfitForm .sizeWaistOption").val(waistSize),
                        (seatSize = jQuery(".hiddenSeatSize").val()),
                        jQuery(".purchaseOutfitForm .sizeSeatption").val(seatSize),
                        jQuery(".hireOutfitForm .sizeSeatption").val(seatSize),
                        (heightSize = jQuery(".hiddenHeightSize").val()),
                        jQuery(".purchaseOutfitForm .sizeHeightOption").val(heightSize),
                        jQuery(".hireOutfitForm .sizeHeightOption").val(heightSize),
                        (lengthSize = jQuery(".hiddenKiltLength").val()),
                        jQuery(".purchaseOutfitForm .sizeLengthOption").val(lengthSize),
                        jQuery(".hireOutfitForm .sizeLengthOption").val(lengthSize),
                        (collarSize = jQuery(".hiddenShirtSize").val()),
                        jQuery(".purchaseOutfitForm .sizeCollarOption").val(collarSize),
                        jQuery(".hireOutfitForm .sizeCollarOption").val(collarSize),
                        (jacketSize = jQuery(".hiddenChestSize").val()),
                        jQuery(".purchaseOutfitForm .sizeJacketOption").val(jacketSize),
                        jQuery(".hireOutfitForm .sizeJacketOption").val(jacketSize),
                        (shoeSize = jQuery(".hiddenShoeSize").val()),
                        jQuery(".purchaseOutfitForm .sizeShoeOption").val(shoeSize),
                        jQuery(".hireOutfitForm .sizeShoeOption").val(shoeSize),
                        console.log(shoeSize);
                }),
                jQuery(document).on("click", ".sendEnquiry", function (e) {

                    const buy = jQuery(this).hasClass('sendBuyEnquiry');

                    if (buy) {

                        e.preventDefault();
                        // Validate if sizes has been selected

                        const waistSize = jQuery(".hiddenWaistSize").val(),
                            seatSize = jQuery(".hiddenSeatSize").val(),
                            heightSize = jQuery(".hiddenHeightSize").val(),
                            lengthSize = jQuery(".hiddenKiltLength").val(),
                            collarSize = jQuery(".hiddenShirtSize").val(),
                            jacketSize = jQuery(".hiddenChestSize").val(),
                            shoeSize = jQuery(".hiddenShoeSize").val();

                        if (waistSize &&
                            seatSize &&
                            heightSize &&
                            lengthSize &&
                            collarSize &&
                            jacketSize &&
                            shoeSize
                        ) {
                            const sizes = {
                                "Seat Size": seatSize,
                                "Height Size": heightSize,
                                "Lenght Size": lengthSize,
                                "Collar Size": collarSize,
                                "Jacket Size": jacketSize,
                                "Shoe Size": shoeSize
                            };

                            const params = new URLSearchParams(document.location.search);
                            const code = params.get('code');
                            const json = btoa(JSON.stringify(sizes));

                            let url = window.location.href.split('?')[0];
                                url += 'code=' + code;

                            url = url + "&size=" + json;
                            console.log(url);
                            window.open(url, '_blank').focus();
                        } else {
                            alert("Please select outfit details (Sizes).");
                        }
                    }
                })
            g(h);

            '<style type="text/css">.st0{fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;}</style>', '<g><path class="st0" stroke-width="2" d="M27.1,16c0,6.1-5,11.1-11.1,11.1S4.9,22.1,4.9,16S9.9,4.9,16,4.9"/></g>', "</svg>";
            '<style type="text/css">.st0{fill:#fff;stroke:#000;stroke-width:2;stroke-miterlimit:10;}.tick{fill:none;stroke:#000;stroke-miterlimit:10; stroke-linecap:round;}</style>',
                '<g><circle class="st0" cx="16" cy="16" r="11.1"/></g>',
                '<path class="tick" stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79"  stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M10,16l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L22,12" style="stroke-dashoffset: 19.79px;"></path>',
                "</svg>",
                jQuery(".info-toggle").on("click", function () {
                    jQuery(this).hasClass("active")
                        ? (jQuery(this).removeClass("active"), jQuery(".outfit-info ").addClass("d-none"), jQuery(".zoomout").addClass("d-none"))
                        : (jQuery(this).addClass("active"),
                            jQuery(".outfit-info ").removeClass("d-none"),
                            jQuery("#previewimage").removeAttr("class"),
                            jQuery("#previewimageMobile").removeAttr("class"),
                            jQuery(".zoomout").addClass("d-none"));
                })
        }
    });

// Bootstrap
(function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports, require("jquery")) : "function" == typeof define && define.amd ? define(["exports", "jquery"], t) : t((e.bootstrap = {}), e.jQuery);
})(this, function (e, t) {
    "use strict";

    function n(e, t) {
        for (var n = 0; n < t.length; n++) {
            var i = t[n];
            (i.enumerable = i.enumerable || !1), (i.configurable = !0), "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i);
        }
    }

    function i(e, t, i) {
        return t && n(e.prototype, t), i && n(e, i), e;
    }

    function r(e) {
        for (var t = 1; t < arguments.length; t++) {
            var n = null != arguments[t] ? arguments[t] : {},
                i = Object.keys(n);
            "function" == typeof Object.getOwnPropertySymbols &&
            (i = i.concat(
                Object.getOwnPropertySymbols(n).filter(function (e) {
                    return Object.getOwnPropertyDescriptor(n, e).enumerable;
                })
            )),
                i.forEach(function (t) {
                    var i, r, o;
                    (i = e), (o = n[(r = t)]), r in i ? Object.defineProperty(i, r, {
                        value: o,
                        enumerable: !0,
                        configurable: !0,
                        writable: !0
                    }) : (i[r] = o);
                });
        }
        return e;
    }

    for (
        var o,
            a,
            s,
            l,
            c,
            u,
            d,
            h,
            p,
            f,
            m,
            g,
            v,
            y,
            _,
            b,
            w,
            j,
            C,
            E,
            Q,
            T,
            S,
            k,
            A,
            D,
            O,
            I,
            N,
            x,
            P,
            L,
            F,
            H,
            M,
            B,
            W,
            q,
            R,
            z,
            U,
            K,
            V,
            Y,
            J,
            Z,
            G,
            X = (function (e) {
                var t = "transitionend";
                var n = {
                    TRANSITION_END: "bsTransitionEnd",
                    getUID: function (e) {
                        for (; (e += ~~(1e6 * Math.random())), document.getElementById(e);) ;
                        return e;
                    },
                    getSelectorFromElement: function (e) {
                        var t = e.getAttribute("data-target");
                        (t && "#" !== t) || (t = e.getAttribute("href") || "");
                        try {
                            return document.querySelector(t) ? t : null;
                        } catch (e) {
                            return null;
                        }
                    },
                    getTransitionDurationFromElement: function (t) {
                        if (!t) return 0;
                        var n = e(t).css("transition-duration");
                        return parseFloat(n) ? ((n = n.split(",")[0]), 1e3 * parseFloat(n)) : 0;
                    },
                    reflow: function (e) {
                        return e.offsetHeight;
                    },
                    triggerTransitionEnd: function (n) {
                        e(n).trigger(t);
                    },
                    supportsTransitionEnd: function () {
                        return Boolean(t);
                    },
                    isElement: function (e) {
                        return (e[0] || e).nodeType;
                    },
                    typeCheckConfig: function (e, t, i) {
                        for (var r in i)
                            if (Object.prototype.hasOwnProperty.call(i, r)) {
                                var o = i[r],
                                    a = t[r],
                                    s =
                                        a && n.isElement(a)
                                            ? "element"
                                            : ((l = a),
                                                {}.toString
                                                    .call(l)
                                                    .match(/\s([a-z]+)/i)[1]
                                                    .toLowerCase());
                                if (!new RegExp(o).test(s)) throw new Error(e.toUpperCase() + ': Option "' + r + '" provided type "' + s + '" but expected type "' + o + '".');
                            }
                        var l;
                    },
                };
                return (
                    (e.fn.emulateTransitionEnd = function (t) {
                        var i = this,
                            r = !1;
                        return (
                            e(this).one(n.TRANSITION_END, function () {
                                r = !0;
                            }),
                                setTimeout(function () {
                                    r || n.triggerTransitionEnd(i);
                                }, t),
                                this
                        );
                    }),
                        (e.event.special[n.TRANSITION_END] = {
                            bindType: t,
                            delegateType: t,
                            handle: function (t) {
                                if (e(t.target).is(this)) return t.handleObj.handler.apply(this, arguments);
                            },
                        }),
                        n
                );
            })((t = t && t.hasOwnProperty("default") ? t.default : t)),
            ee =
                ((a = "alert"),
                    (l = "." + (s = "bs.alert")),
                    (c = (o = t).fn[a]),
                    (u = {CLOSE: "close" + l, CLOSED: "closed" + l, CLICK_DATA_API: "click" + l + ".data-api"}),
                    "alert",
                    "fade",
                    "show",
                    (d = (function () {
                        function e(e) {
                            this._element = e;
                        }

                        var t = e.prototype;
                        return (
                            (t.close = function (e) {
                                var t = this._element;
                                e && (t = this._getRootElement(e)), this._triggerCloseEvent(t).isDefaultPrevented() || this._removeElement(t);
                            }),
                                (t.dispose = function () {
                                    o.removeData(this._element, s), (this._element = null);
                                }),
                                (t._getRootElement = function (e) {
                                    var t = X.getSelectorFromElement(e),
                                        n = !1;
                                    return t && (n = document.querySelector(t)), n || (n = o(e).closest(".alert")[0]), n;
                                }),
                                (t._triggerCloseEvent = function (e) {
                                    var t = o.Event(u.CLOSE);
                                    return o(e).trigger(t), t;
                                }),
                                (t._removeElement = function (e) {
                                    var t = this;
                                    if ((o(e).removeClass("show"), o(e).hasClass("fade"))) {
                                        var n = X.getTransitionDurationFromElement(e);
                                        o(e)
                                            .one(X.TRANSITION_END, function (n) {
                                                return t._destroyElement(e, n);
                                            })
                                            .emulateTransitionEnd(n);
                                    } else this._destroyElement(e);
                                }),
                                (t._destroyElement = function (e) {
                                    o(e).detach().trigger(u.CLOSED).remove();
                                }),
                                (e._jQueryInterface = function (t) {
                                    return this.each(function () {
                                        var n = o(this),
                                            i = n.data(s);
                                        i || ((i = new e(this)), n.data(s, i)), "close" === t && i[t](this);
                                    });
                                }),
                                (e._handleDismiss = function (e) {
                                    return function (t) {
                                        t && t.preventDefault(), e.close(this);
                                    };
                                }),
                                i(e, null, [
                                    {
                                        key: "VERSION",
                                        get: function () {
                                            return "4.1.3";
                                        },
                                    },
                                ]),
                                e
                        );
                    })()),
                    o(document).on(u.CLICK_DATA_API, '[data-dismiss="alert"]', d._handleDismiss(new d())),
                    (o.fn[a] = d._jQueryInterface),
                    (o.fn[a].Constructor = d),
                    (o.fn[a].noConflict = function () {
                        return (o.fn[a] = c), d._jQueryInterface;
                    }),
                    d),
            te =
                ((p = "button"),
                    (m = "." + (f = "bs.button")),
                    (g = ".data-api"),
                    (v = (h = t).fn[p]),
                    (y = "active"),
                    "btn",
                    (_ = '[data-toggle^="button"]'),
                    '[data-toggle="buttons"]',
                    "input",
                    ".active",
                    (b = ".btn"),
                    (w = {CLICK_DATA_API: "click" + m + g, FOCUS_BLUR_DATA_API: "focus" + m + g + " blur" + m + g}),
                    (j = (function () {
                        function e(e) {
                            this._element = e;
                        }

                        var t = e.prototype;
                        return (
                            (t.toggle = function () {
                                var e = !0,
                                    t = !0,
                                    n = h(this._element).closest('[data-toggle="buttons"]')[0];
                                if (n) {
                                    var i = this._element.querySelector("input");
                                    if (i) {
                                        if ("radio" === i.type)
                                            if (i.checked && this._element.classList.contains(y)) e = !1;
                                            else {
                                                var r = n.querySelector(".active");
                                                r && h(r).removeClass(y);
                                            }
                                        if (e) {
                                            if (i.hasAttribute("disabled") || n.hasAttribute("disabled") || i.classList.contains("disabled") || n.classList.contains("disabled")) return;
                                            (i.checked = !this._element.classList.contains(y)), h(i).trigger("change");
                                        }
                                        i.focus(), (t = !1);
                                    }
                                }
                                t && this._element.setAttribute("aria-pressed", !this._element.classList.contains(y)), e && h(this._element).toggleClass(y);
                            }),
                                (t.dispose = function () {
                                    h.removeData(this._element, f), (this._element = null);
                                }),
                                (e._jQueryInterface = function (t) {
                                    return this.each(function () {
                                        var n = h(this).data(f);
                                        n || ((n = new e(this)), h(this).data(f, n)), "toggle" === t && n[t]();
                                    });
                                }),
                                i(e, null, [
                                    {
                                        key: "VERSION",
                                        get: function () {
                                            return "4.1.3";
                                        },
                                    },
                                ]),
                                e
                        );
                    })()),
                    h(document)
                        .on(w.CLICK_DATA_API, _, function (e) {
                            e.preventDefault();
                            var t = e.target;
                            h(t).hasClass("btn") || (t = h(t).closest(b)), j._jQueryInterface.call(h(t), "toggle");
                        })
                        .on(w.FOCUS_BLUR_DATA_API, _, function (e) {
                            var t = h(e.target).closest(b)[0];
                            h(t).toggleClass("focus", /^focus(in)?$/.test(e.type));
                        }),
                    (h.fn[p] = j._jQueryInterface),
                    (h.fn[p].Constructor = j),
                    (h.fn[p].noConflict = function () {
                        return (h.fn[p] = v), j._jQueryInterface;
                    }),
                    j),
            ne =
                ((E = "carousel"),
                    (T = "." + (Q = "bs.carousel")),
                    (S = ".data-api"),
                    (k = (C = t).fn[E]),
                    (A = {interval: 5e3, keyboard: !0, slide: !1, pause: "hover", wrap: !0}),
                    (D = {
                        interval: "(number|boolean)",
                        keyboard: "boolean",
                        slide: "(boolean|string)",
                        pause: "(string|boolean)",
                        wrap: "boolean"
                    }),
                    (O = "next"),
                    (I = "prev"),
                    "left",
                    "right",
                    (N = {
                        SLIDE: "slide" + T,
                        SLID: "slid" + T,
                        KEYDOWN: "keydown" + T,
                        MOUSEENTER: "mouseenter" + T,
                        MOUSELEAVE: "mouseleave" + T,
                        TOUCHEND: "touchend" + T,
                        LOAD_DATA_API: "load" + T + S,
                        CLICK_DATA_API: "click" + T + S,
                    }),
                    "carousel",
                    (x = "active"),
                    "slide",
                    "carousel-item-right",
                    "carousel-item-left",
                    "carousel-item-next",
                    "carousel-item-prev",
                    ".active",
                    (P = ".active.carousel-item"),
                    ".carousel-item",
                    ".carousel-item-next, .carousel-item-prev",
                    ".carousel-indicators",
                    "[data-slide], [data-slide-to]",
                    '[data-ride="carousel"]',
                    (L = (function () {
                        function e(e, t) {
                            (this._items = null),
                                (this._interval = null),
                                (this._activeElement = null),
                                (this._isPaused = !1),
                                (this._isSliding = !1),
                                (this.touchTimeout = null),
                                (this._config = this._getConfig(t)),
                                (this._element = C(e)[0]),
                                (this._indicatorsElement = this._element.querySelector(".carousel-indicators")),
                                this._addEventListeners();
                        }

                        var t = e.prototype;
                        return (
                            (t.next = function () {
                                this._isSliding || this._slide(O);
                            }),
                                (t.nextWhenVisible = function () {
                                    !document.hidden && C(this._element).is(":visible") && "hidden" !== C(this._element).css("visibility") && this.next();
                                }),
                                (t.prev = function () {
                                    this._isSliding || this._slide(I);
                                }),
                                (t.pause = function (e) {
                                    e || (this._isPaused = !0),
                                    this._element.querySelector(".carousel-item-next, .carousel-item-prev") && (X.triggerTransitionEnd(this._element), this.cycle(!0)),
                                        clearInterval(this._interval),
                                        (this._interval = null);
                                }),
                                (t.cycle = function (e) {
                                    e || (this._isPaused = !1),
                                    this._interval && (clearInterval(this._interval), (this._interval = null)),
                                    this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval));
                                }),
                                (t.to = function (e) {
                                    var t = this;
                                    this._activeElement = this._element.querySelector(P);
                                    var n = this._getItemIndex(this._activeElement);
                                    if (!(e > this._items.length - 1 || e < 0))
                                        if (this._isSliding)
                                            C(this._element).one(N.SLID, function () {
                                                return t.to(e);
                                            });
                                        else {
                                            if (n === e) return this.pause(), void this.cycle();
                                            var i = n < e ? O : I;
                                            this._slide(i, this._items[e]);
                                        }
                                }),
                                (t.dispose = function () {
                                    C(this._element).off(T),
                                        C.removeData(this._element, Q),
                                        (this._items = null),
                                        (this._config = null),
                                        (this._element = null),
                                        (this._interval = null),
                                        (this._isPaused = null),
                                        (this._isSliding = null),
                                        (this._activeElement = null),
                                        (this._indicatorsElement = null);
                                }),
                                (t._getConfig = function (e) {
                                    return (e = r({}, A, e)), X.typeCheckConfig(E, e, D), e;
                                }),
                                (t._addEventListeners = function () {
                                    var e = this;
                                    this._config.keyboard &&
                                    C(this._element).on(N.KEYDOWN, function (t) {
                                        return e._keydown(t);
                                    }),
                                    "hover" === this._config.pause &&
                                    (C(this._element)
                                        .on(N.MOUSEENTER, function (t) {
                                            return e.pause(t);
                                        })
                                        .on(N.MOUSELEAVE, function (t) {
                                            return e.cycle(t);
                                        }),
                                    ("ontouchstart" in document.documentElement) &&
                                    C(this._element).on(N.TOUCHEND, function () {
                                        e.pause(),
                                        e.touchTimeout && clearTimeout(e.touchTimeout),
                                            (e.touchTimeout = setTimeout(function (t) {
                                                return e.cycle(t);
                                            }, 500 + e._config.interval));
                                    }));
                                }),
                                (t._keydown = function (e) {
                                    if (!/input|textarea/i.test(e.target.tagName))
                                        switch (e.which) {
                                            case 37:
                                                e.preventDefault(), this.prev();
                                                break;
                                            case 39:
                                                e.preventDefault(), this.next();
                                        }
                                }),
                                (t._getItemIndex = function (e) {
                                    return (this._items = e && e.parentNode ? [].slice.call(e.parentNode.querySelectorAll(".carousel-item")) : []), this._items.indexOf(e);
                                }),
                                (t._getItemByDirection = function (e, t) {
                                    var n = e === O,
                                        i = e === I,
                                        r = this._getItemIndex(t),
                                        o = this._items.length - 1;
                                    if (((i && 0 === r) || (n && r === o)) && !this._config.wrap) return t;
                                    var a = (r + (e === I ? -1 : 1)) % this._items.length;
                                    return -1 === a ? this._items[this._items.length - 1] : this._items[a];
                                }),
                                (t._triggerSlideEvent = function (e, t) {
                                    var n = this._getItemIndex(e),
                                        i = this._getItemIndex(this._element.querySelector(P)),
                                        r = C.Event(N.SLIDE, {relatedTarget: e, direction: t, from: i, to: n});
                                    return C(this._element).trigger(r), r;
                                }),
                                (t._setActiveIndicatorElement = function (e) {
                                    if (this._indicatorsElement) {
                                        var t = [].slice.call(this._indicatorsElement.querySelectorAll(".active"));
                                        C(t).removeClass(x);
                                        var n = this._indicatorsElement.children[this._getItemIndex(e)];
                                        n && C(n).addClass(x);
                                    }
                                }),
                                (t._slide = function (e, t) {
                                    var n,
                                        i,
                                        r,
                                        o = this,
                                        a = this._element.querySelector(P),
                                        s = this._getItemIndex(a),
                                        l = t || (a && this._getItemByDirection(e, a)),
                                        c = this._getItemIndex(l),
                                        u = Boolean(this._interval);
                                    if ((e === O ? ((n = "carousel-item-left"), (i = "carousel-item-next"), (r = "left")) : ((n = "carousel-item-right"), (i = "carousel-item-prev"), (r = "right")), l && C(l).hasClass(x))) this._isSliding = !1;
                                    else if (!this._triggerSlideEvent(l, r).isDefaultPrevented() && a && l) {
                                        (this._isSliding = !0), u && this.pause(), this._setActiveIndicatorElement(l);
                                        var d = C.Event(N.SLID, {relatedTarget: l, direction: r, from: s, to: c});
                                        if (C(this._element).hasClass("slide")) {
                                            C(l).addClass(i), X.reflow(l), C(a).addClass(n), C(l).addClass(n);
                                            var h = X.getTransitionDurationFromElement(a);
                                            C(a)
                                                .one(X.TRANSITION_END, function () {
                                                    C(l)
                                                        .removeClass(n + " " + i)
                                                        .addClass(x),
                                                        C(a).removeClass(x + " " + i + " " + n),
                                                        (o._isSliding = !1),
                                                        setTimeout(function () {
                                                            return C(o._element).trigger(d);
                                                        }, 0);
                                                })
                                                .emulateTransitionEnd(h);
                                        } else C(a).removeClass(x), C(l).addClass(x), (this._isSliding = !1), C(this._element).trigger(d);
                                        u && this.cycle();
                                    }
                                }),
                                (e._jQueryInterface = function (t) {
                                    return this.each(function () {
                                        var n = C(this).data(Q),
                                            i = r({}, A, C(this).data());
                                        "object" == typeof t && (i = r({}, i, t));
                                        var o = "string" == typeof t ? t : i.slide;
                                        if ((n || ((n = new e(this, i)), C(this).data(Q, n)), "number" == typeof t)) n.to(t);
                                        else if ("string" == typeof o) {
                                            if (void 0 === n[o]) throw new TypeError('No method named "' + o + '"');
                                            n[o]();
                                        } else i.interval && (n.pause(), n.cycle());
                                    });
                                }),
                                (e._dataApiClickHandler = function (t) {
                                    var n = X.getSelectorFromElement(this);
                                    if (n) {
                                        var i = C(n)[0];
                                        if (i && C(i).hasClass("carousel")) {
                                            var o = r({}, C(i).data(), C(this).data()),
                                                a = this.getAttribute("data-slide-to");
                                            a && (o.interval = !1), e._jQueryInterface.call(C(i), o), a && C(i).data(Q).to(a), t.preventDefault();
                                        }
                                    }
                                }),
                                i(e, null, [
                                    {
                                        key: "VERSION",
                                        get: function () {
                                            return "4.1.3";
                                        },
                                    },
                                    {
                                        key: "Default",
                                        get: function () {
                                            return A;
                                        },
                                    },
                                ]),
                                e
                        );
                    })()),
                    C(document).on(N.CLICK_DATA_API, "[data-slide], [data-slide-to]", L._dataApiClickHandler),
                    C(window).on(N.LOAD_DATA_API, function () {
                        for (var e = [].slice.call(document.querySelectorAll('[data-ride="carousel"]')), t = 0, n = e.length; t < n; t++) {
                            var i = C(e[t]);
                            L._jQueryInterface.call(i, i.data());
                        }
                    }),
                    (C.fn[E] = L._jQueryInterface),
                    (C.fn[E].Constructor = L),
                    (C.fn[E].noConflict = function () {
                        return (C.fn[E] = k), L._jQueryInterface;
                    }),
                    L),
            ie =
                ((H = "collapse"),
                    (B = "." + (M = "bs.collapse")),
                    (W = (F = t).fn[H]),
                    (q = {toggle: !0, parent: ""}),
                    (R = {toggle: "boolean", parent: "(string|element)"}),
                    (z = {
                        SHOW: "show" + B,
                        SHOWN: "shown" + B,
                        HIDE: "hide" + B,
                        HIDDEN: "hidden" + B,
                        CLICK_DATA_API: "click" + B + ".data-api"
                    }),
                    (U = "show"),
                    (K = "collapse"),
                    (V = "collapsing"),
                    (Y = "collapsed"),
                    (J = "width"),
                    "height",
                    ".show, .collapsing",
                    (Z = '[data-toggle="collapse"]'),
                    (G = (function () {
                        function e(e, t) {
                            (this._isTransitioning = !1),
                                (this._element = e),
                                (this._config = this._getConfig(t)),
                                (this._triggerArray = F.makeArray(document.querySelectorAll('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]')));
                            for (var n = [].slice.call(document.querySelectorAll(Z)), i = 0, r = n.length; i < r; i++) {
                                var o = n[i],
                                    a = X.getSelectorFromElement(o),
                                    s = [].slice.call(document.querySelectorAll(a)).filter(function (t) {
                                        return t === e;
                                    });
                                null !== a && 0 < s.length && ((this._selector = a), this._triggerArray.push(o));
                            }
                            (this._parent = this._config.parent ? this._getParent() : null), this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle();
                        }

                        var t = e.prototype;
                        return (
                            (t.toggle = function () {
                                F(this._element).hasClass(U) ? this.hide() : this.show();
                            }),
                                (t.show = function () {
                                    var t,
                                        n,
                                        i = this;
                                    if (
                                        !(
                                            this._isTransitioning ||
                                            F(this._element).hasClass(U) ||
                                            (this._parent &&
                                            0 ===
                                            (t = [].slice.call(this._parent.querySelectorAll(".show, .collapsing")).filter(function (e) {
                                                return e.getAttribute("data-parent") === i._config.parent;
                                            })).length &&
                                            (t = null),
                                            t && (n = F(t).not(this._selector).data(M)) && n._isTransitioning)
                                        )
                                    ) {
                                        var r = F.Event(z.SHOW);
                                        if ((F(this._element).trigger(r), !r.isDefaultPrevented())) {
                                            t && (e._jQueryInterface.call(F(t).not(this._selector), "hide"), n || F(t).data(M, null));
                                            var o = this._getDimension();
                                            F(this._element).removeClass(K).addClass(V), (this._element.style[o] = 0), this._triggerArray.length && F(this._triggerArray).removeClass(Y).attr("aria-expanded", !0), this.setTransitioning(!0);
                                            var a = "scroll" + (o[0].toUpperCase() + o.slice(1)),
                                                s = X.getTransitionDurationFromElement(this._element);
                                            F(this._element)
                                                .one(X.TRANSITION_END, function () {
                                                    F(i._element).removeClass(V).addClass(K).addClass(U), (i._element.style[o] = ""), i.setTransitioning(!1), F(i._element).trigger(z.SHOWN);
                                                })
                                                .emulateTransitionEnd(s),
                                                (this._element.style[o] = this._element[a] + "px");
                                        }
                                    }
                                }),
                                (t.hide = function () {
                                    var e = this;
                                    if (!this._isTransitioning && F(this._element).hasClass(U)) {
                                        var t = F.Event(z.HIDE);
                                        if ((F(this._element).trigger(t), !t.isDefaultPrevented())) {
                                            var n = this._getDimension();
                                            (this._element.style[n] = this._element.getBoundingClientRect()[n] + "px"), X.reflow(this._element), F(this._element).addClass(V).removeClass(K).removeClass(U);
                                            var i = this._triggerArray.length;
                                            if (0 < i)
                                                for (var r = 0; r < i; r++) {
                                                    var o = this._triggerArray[r],
                                                        a = X.getSelectorFromElement(o);
                                                    null !== a && (F([].slice.call(document.querySelectorAll(a))).hasClass(U) || F(o).addClass(Y).attr("aria-expanded", !1));
                                                }
                                            this.setTransitioning(!0), (this._element.style[n] = "");
                                            var s = X.getTransitionDurationFromElement(this._element);
                                            F(this._element)
                                                .one(X.TRANSITION_END, function () {
                                                    e.setTransitioning(!1), F(e._element).removeClass(V).addClass(K).trigger(z.HIDDEN);
                                                })
                                                .emulateTransitionEnd(s);
                                        }
                                    }
                                }),
                                (t.setTransitioning = function (e) {
                                    this._isTransitioning = e;
                                }),
                                (t.dispose = function () {
                                    F.removeData(this._element, M), (this._config = null), (this._parent = null), (this._element = null), (this._triggerArray = null), (this._isTransitioning = null);
                                }),
                                (t._getConfig = function (e) {
                                    return ((e = r({}, q, e)).toggle = Boolean(e.toggle)), X.typeCheckConfig(H, e, R), e;
                                }),
                                (t._getDimension = function () {
                                    return F(this._element).hasClass(J) ? J : "height";
                                }),
                                (t._getParent = function () {
                                    var t = this,
                                        n = null;
                                    X.isElement(this._config.parent) ? ((n = this._config.parent), void 0 !== this._config.parent.jquery && (n = this._config.parent[0])) : (n = document.querySelector(this._config.parent));
                                    var i = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
                                        r = [].slice.call(n.querySelectorAll(i));
                                    return (
                                        F(r).each(function (n, i) {
                                            t._addAriaAndCollapsedClass(e._getTargetFromElement(i), [i]);
                                        }),
                                            n
                                    );
                                }),
                                (t._addAriaAndCollapsedClass = function (e, t) {
                                    if (e) {
                                        var n = F(e).hasClass(U);
                                        t.length && F(t).toggleClass(Y, !n).attr("aria-expanded", n);
                                    }
                                }),
                                (e._getTargetFromElement = function (e) {
                                    var t = X.getSelectorFromElement(e);
                                    return t ? document.querySelector(t) : null;
                                }),
                                (e._jQueryInterface = function (t) {
                                    return this.each(function () {
                                        var n = F(this),
                                            i = n.data(M),
                                            o = r({}, q, n.data(), "object" == typeof t && t ? t : {});
                                        if ((!i && o.toggle && /show|hide/.test(t) && (o.toggle = !1), i || ((i = new e(this, o)), n.data(M, i)), "string" == typeof t)) {
                                            if (void 0 === i[t]) throw new TypeError('No method named "' + t + '"');
                                            i[t]();
                                        }
                                    });
                                }),
                                i(e, null, [
                                    {
                                        key: "VERSION",
                                        get: function () {
                                            return "4.1.3";
                                        },
                                    },
                                    {
                                        key: "Default",
                                        get: function () {
                                            return q;
                                        },
                                    },
                                ]),
                                e
                        );
                    })()),
                    F(document).on(z.CLICK_DATA_API, Z, function (e) {
                        "A" === e.currentTarget.tagName && e.preventDefault();
                        var t = F(this),
                            n = X.getSelectorFromElement(this),
                            i = [].slice.call(document.querySelectorAll(n));
                        F(i).each(function () {
                            var e = F(this),
                                n = e.data(M) ? "toggle" : t.data();
                            G._jQueryInterface.call(e, n);
                        });
                    }),
                    (F.fn[H] = G._jQueryInterface),
                    (F.fn[H].Constructor = G),
                    (F.fn[H].noConflict = function () {
                        return (F.fn[H] = W), G._jQueryInterface;
                    }),
                    G),
            re = "undefined" != typeof window && "undefined" != typeof document,
            oe = ["Edge", "Trident", "Firefox"],
            ae = 0,
            se = 0;
        se < oe.length;
        se += 1
    )
        if (re && 0 <= navigator.userAgent.indexOf(oe[se])) {
            ae = 1;
            break;
        }
    var le =
        re && window.Promise
            ? function (e) {
                var t = !1;
                return function () {
                    t ||
                    ((t = !0),
                        window.Promise.resolve().then(function () {
                            (t = !1), e();
                        }));
                };
            }
            : function (e) {
                var t = !1;
                return function () {
                    t ||
                    ((t = !0),
                        setTimeout(function () {
                            (t = !1), e();
                        }, ae));
                };
            };

    function ce(e) {
        return e && "[object Function]" === {}.toString.call(e);
    }

    function ue(e, t) {
        if (1 !== e.nodeType) return [];
        var n = getComputedStyle(e, null);
        return t ? n[t] : n;
    }

    function de(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host;
    }

    function he(e) {
        if (!e) return document.body;
        switch (e.nodeName) {
            case "HTML":
            case "BODY":
                return e.ownerDocument.body;
            case "#document":
                return e.body;
        }
        var t = ue(e),
            n = t.overflow,
            i = t.overflowX,
            r = t.overflowY;
        return /(auto|scroll|overlay)/.test(n + r + i) ? e : he(de(e));
    }

    var pe = re && !(!window.MSInputMethodContext || !document.documentMode),
        fe = re && /MSIE 10/.test(navigator.userAgent);

    function me(e) {
        return 11 === e ? pe : 10 === e ? fe : pe || fe;
    }

    function ge(e) {
        if (!e) return document.documentElement;
        for (var t = me(10) ? document.body : null, n = e.offsetParent; n === t && e.nextElementSibling;) n = (e = e.nextElementSibling).offsetParent;
        var i = n && n.nodeName;
        return i && "BODY" !== i && "HTML" !== i ? (-1 !== ["TD", "TABLE"].indexOf(n.nodeName) && "static" === ue(n, "position") ? ge(n) : n) : e ? e.ownerDocument.documentElement : document.documentElement;
    }

    function ve(e) {
        return null !== e.parentNode ? ve(e.parentNode) : e;
    }

    function ye(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
        var n = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = n ? e : t,
            r = n ? t : e,
            o = document.createRange();
        o.setStart(i, 0), o.setEnd(r, 0);
        var a,
            s,
            l = o.commonAncestorContainer;
        if ((e !== l && t !== l) || i.contains(r)) return "BODY" === (s = (a = l).nodeName) || ("HTML" !== s && ge(a.firstElementChild) !== a) ? ge(l) : l;
        var c = ve(e);
        return c.host ? ye(c.host, t) : ye(e, ve(t).host);
    }

    function _e(e) {
        var t = "top" === (1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top") ? "scrollTop" : "scrollLeft",
            n = e.nodeName;
        if ("BODY" === n || "HTML" === n) {
            var i = e.ownerDocument.documentElement;
            return (e.ownerDocument.scrollingElement || i)[t];
        }
        return e[t];
    }

    function be(e, t) {
        var n = "x" === t ? "Left" : "Top",
            i = "Left" === n ? "Right" : "Bottom";
        return parseFloat(e["border" + n + "Width"], 10) + parseFloat(e["border" + i + "Width"], 10);
    }

    function we(e, t, n, i) {
        return Math.max(
            t["offset" + e],
            t["scroll" + e],
            n["client" + e],
            n["offset" + e],
            n["scroll" + e],
            me(10) ? n["offset" + e] + i["margin" + ("Height" === e ? "Top" : "Left")] + i["margin" + ("Height" === e ? "Bottom" : "Right")] : 0
        );
    }

    function je() {
        var e = document.body,
            t = document.documentElement,
            n = me(10) && getComputedStyle(t);
        return {height: we("Height", e, t, n), width: we("Width", e, t, n)};
    }

    var Ce = (function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var i = t[n];
                    (i.enumerable = i.enumerable || !1), (i.configurable = !0), "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i);
                }
            }

            return function (t, n, i) {
                return n && e(t.prototype, n), i && e(t, i), t;
            };
        })(),
        Ee = function (e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : (e[t] = n), e;
        },
        Qe =
            Object.assign ||
            function (e) {
                for (var t = 1; t < arguments.length; t++) {
                    var n = arguments[t];
                    for (var i in n) Object.prototype.hasOwnProperty.call(n, i) && (e[i] = n[i]);
                }
                return e;
            };

    function Te(e) {
        return Qe({}, e, {right: e.left + e.width, bottom: e.top + e.height});
    }

    function Se(e) {
        var t = {};
        try {
            if (me(10)) {
                t = e.getBoundingClientRect();
                var n = _e(e, "top"),
                    i = _e(e, "left");
                (t.top += n), (t.left += i), (t.bottom += n), (t.right += i);
            } else t = e.getBoundingClientRect();
        } catch (e) {
        }
        var r = {left: t.left, top: t.top, width: t.right - t.left, height: t.bottom - t.top},
            o = "HTML" === e.nodeName ? je() : {},
            a = o.width || e.clientWidth || r.right - r.left,
            s = o.height || e.clientHeight || r.bottom - r.top,
            l = e.offsetWidth - a,
            c = e.offsetHeight - s;
        if (l || c) {
            var u = ue(e);
            (l -= be(u, "x")), (c -= be(u, "y")), (r.width -= l), (r.height -= c);
        }
        return Te(r);
    }

    function ke(e, t) {
        var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
            i = me(10),
            r = "HTML" === t.nodeName,
            o = Se(e),
            a = Se(t),
            s = he(e),
            l = ue(t),
            c = parseFloat(l.borderTopWidth, 10),
            u = parseFloat(l.borderLeftWidth, 10);
        n && "HTML" === t.nodeName && ((a.top = Math.max(a.top, 0)), (a.left = Math.max(a.left, 0)));
        var d = Te({top: o.top - a.top - c, left: o.left - a.left - u, width: o.width, height: o.height});
        if (((d.marginTop = 0), (d.marginLeft = 0), !i && r)) {
            var h = parseFloat(l.marginTop, 10),
                p = parseFloat(l.marginLeft, 10);
            (d.top -= c - h), (d.bottom -= c - h), (d.left -= u - p), (d.right -= u - p), (d.marginTop = h), (d.marginLeft = p);
        }
        return (
            (i && !n ? t.contains(s) : t === s && "BODY" !== s.nodeName) &&
            (d = (function (e, t) {
                var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
                    i = _e(t, "top"),
                    r = _e(t, "left"),
                    o = n ? -1 : 1;
                return (e.top += i * o), (e.bottom += i * o), (e.left += r * o), (e.right += r * o), e;
            })(d, t)),
                d
        );
    }

    function Ae(e) {
        if (!e || !e.parentElement || me()) return document.documentElement;
        for (var t = e.parentElement; t && "none" === ue(t, "transform");) t = t.parentElement;
        return t || document.documentElement;
    }

    function De(e, t, n, i) {
        var r = 4 < arguments.length && void 0 !== arguments[4] && arguments[4],
            o = {top: 0, left: 0},
            a = r ? Ae(e) : ye(e, t);
        if ("viewport" === i)
            o = (function (e) {
                var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
                    n = e.ownerDocument.documentElement,
                    i = ke(e, n),
                    r = Math.max(n.clientWidth, window.innerWidth || 0),
                    o = Math.max(n.clientHeight, window.innerHeight || 0),
                    a = t ? 0 : _e(n),
                    s = t ? 0 : _e(n, "left");
                return Te({top: a - i.top + i.marginTop, left: s - i.left + i.marginLeft, width: r, height: o});
            })(a, r);
        else {
            var s = void 0;
            "scrollParent" === i ? "BODY" === (s = he(de(t))).nodeName && (s = e.ownerDocument.documentElement) : (s = "window" === i ? e.ownerDocument.documentElement : i);
            var l = ke(s, a, r);
            if (
                "HTML" !== s.nodeName ||
                (function e(t) {
                    var n = t.nodeName;
                    return "BODY" !== n && "HTML" !== n && ("fixed" === ue(t, "position") || e(de(t)));
                })(a)
            )
                o = l;
            else {
                var c = je(),
                    u = c.height,
                    d = c.width;
                (o.top += l.top - l.marginTop), (o.bottom = u + l.top), (o.left += l.left - l.marginLeft), (o.right = d + l.left);
            }
        }
        return (o.left += n), (o.top += n), (o.right -= n), (o.bottom -= n), o;
    }

    function Oe(e, t, n, i, r) {
        var o = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
        if (-1 === e.indexOf("auto")) return e;
        var a = De(n, i, o, r),
            s = {
                top: {width: a.width, height: t.top - a.top},
                right: {width: a.right - t.right, height: a.height},
                bottom: {width: a.width, height: a.bottom - t.bottom},
                left: {width: t.left - a.left, height: a.height}
            },
            l = Object.keys(s)
                .map(function (e) {
                    return Qe({key: e}, s[e], {area: ((t = s[e]), t.width * t.height)});
                    var t;
                })
                .sort(function (e, t) {
                    return t.area - e.area;
                }),
            c = l.filter(function (e) {
                var t = e.width,
                    i = e.height;
                return t >= n.clientWidth && i >= n.clientHeight;
            }),
            u = 0 < c.length ? c[0].key : l[0].key,
            d = e.split("-")[1];
        return u + (d ? "-" + d : "");
    }

    function Ie(e, t, n) {
        var i = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : null;
        return ke(n, i ? Ae(t) : ye(t, n), i);
    }

    function Ne(e) {
        var t = getComputedStyle(e),
            n = parseFloat(t.marginTop) + parseFloat(t.marginBottom),
            i = parseFloat(t.marginLeft) + parseFloat(t.marginRight);
        return {width: e.offsetWidth + i, height: e.offsetHeight + n};
    }

    function xe(e) {
        var t = {left: "right", right: "left", bottom: "top", top: "bottom"};
        return e.replace(/left|right|bottom|top/g, function (e) {
            return t[e];
        });
    }

    function Pe(e, t, n) {
        n = n.split("-")[0];
        var i = Ne(e),
            r = {width: i.width, height: i.height},
            o = -1 !== ["right", "left"].indexOf(n),
            a = o ? "top" : "left",
            s = o ? "left" : "top",
            l = o ? "height" : "width",
            c = o ? "width" : "height";
        return (r[a] = t[a] + t[l] / 2 - i[l] / 2), (r[s] = n === s ? t[s] - i[c] : t[xe(s)]), r;
    }

    function Le(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0];
    }

    function Fe(e, t, n) {
        return (
            (void 0 === n
                    ? e
                    : e.slice(
                        0,
                        (function (e, t, n) {
                            if (Array.prototype.findIndex)
                                return e.findIndex(function (e) {
                                    return e[t] === n;
                                });
                            var i = Le(e, function (e) {
                                return e[t] === n;
                            });
                            return e.indexOf(i);
                        })(e, "name", n)
                    )
            ).forEach(function (e) {
                e.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
                var n = e.function || e.fn;
                e.enabled && ce(n) && ((t.offsets.popper = Te(t.offsets.popper)), (t.offsets.reference = Te(t.offsets.reference)), (t = n(t, e)));
            }),
                t
        );
    }

    function He(e, t) {
        return e.some(function (e) {
            var n = e.name;
            return e.enabled && n === t;
        });
    }

    function Me(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], n = e.charAt(0).toUpperCase() + e.slice(1), i = 0; i < t.length; i++) {
            var r = t[i],
                o = r ? "" + r + n : e;
            if (void 0 !== document.body.style[o]) return o;
        }
        return null;
    }

    function Be(e) {
        var t = e.ownerDocument;
        return t ? t.defaultView : window;
    }

    function We() {
        var e, t;
        this.state.eventsEnabled &&
        (cancelAnimationFrame(this.scheduleUpdate),
            (this.state =
                ((e = this.reference),
                    (t = this.state),
                    Be(e).removeEventListener("resize", t.updateBound),
                    t.scrollParents.forEach(function (e) {
                        e.removeEventListener("scroll", t.updateBound);
                    }),
                    (t.updateBound = null),
                    (t.scrollParents = []),
                    (t.scrollElement = null),
                    (t.eventsEnabled = !1),
                    t)));
    }

    function qe(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e);
    }

    function Re(e, t) {
        Object.keys(t).forEach(function (n) {
            var i = "";
            -1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(n) && qe(t[n]) && (i = "px"), (e.style[n] = t[n] + i);
        });
    }

    function ze(e, t, n) {
        var i = Le(e, function (e) {
                return e.name === t;
            }),
            r =
                !!i &&
                e.some(function (e) {
                    return e.name === n && e.enabled && e.order < i.order;
                });
        if (!r) {
            var o = "`" + t + "`",
                a = "`" + n + "`";
            console.warn(a + " modifier is required by " + o + " modifier in order to work, be sure to include it before " + o + "!");
        }
        return r;
    }

    var Ue = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        Ke = Ue.slice(3);

    function Ve(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            n = Ke.indexOf(e),
            i = Ke.slice(n + 1).concat(Ke.slice(0, n));
        return t ? i.reverse() : i;
    }

    var $e = {
            placement: "bottom",
            positionFixed: !1,
            eventsEnabled: !0,
            removeOnDestroy: !1,
            onCreate: function () {
            },
            onUpdate: function () {
            },
            modifiers: {
                shift: {
                    order: 100,
                    enabled: !0,
                    fn: function (e) {
                        var t = e.placement,
                            n = t.split("-")[0],
                            i = t.split("-")[1];
                        if (i) {
                            var r = e.offsets,
                                o = r.reference,
                                a = r.popper,
                                s = -1 !== ["bottom", "top"].indexOf(n),
                                l = s ? "left" : "top",
                                c = s ? "width" : "height",
                                u = {start: Ee({}, l, o[l]), end: Ee({}, l, o[l] + o[c] - a[c])};
                            e.offsets.popper = Qe({}, a, u[i]);
                        }
                        return e;
                    },
                },
                offset: {
                    order: 200,
                    enabled: !0,
                    fn: function (e, t) {
                        var n,
                            i = t.offset,
                            r = e.placement,
                            o = e.offsets,
                            a = o.popper,
                            s = o.reference,
                            l = r.split("-")[0];
                        return (
                            (n = qe(+i)
                                ? [+i, 0]
                                : (function (e, t, n, i) {
                                    var r = [0, 0],
                                        o = -1 !== ["right", "left"].indexOf(i),
                                        a = e.split(/(\+|\-)/).map(function (e) {
                                            return e.trim();
                                        }),
                                        s = a.indexOf(
                                            Le(a, function (e) {
                                                return -1 !== e.search(/,|\s/);
                                            })
                                        );
                                    a[s] && -1 === a[s].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
                                    var l = /\s*,\s*|\s+/,
                                        c = -1 !== s ? [a.slice(0, s).concat([a[s].split(l)[0]]), [a[s].split(l)[1]].concat(a.slice(s + 1))] : [a];
                                    return (
                                        (c = c.map(function (e, i) {
                                            var r = (1 === i ? !o : o) ? "height" : "width",
                                                a = !1;
                                            return e
                                                .reduce(function (e, t) {
                                                    return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? ((e[e.length - 1] = t), (a = !0), e) : a ? ((e[e.length - 1] += t), (a = !1), e) : e.concat(t);
                                                }, [])
                                                .map(function (e) {
                                                    return (function (e, t, n, i) {
                                                        var r = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                                                            o = +r[1],
                                                            a = r[2];
                                                        if (!o) return e;
                                                        if (0 === a.indexOf("%")) {
                                                            return (Te("%p" === a ? n : i)[t] / 100) * o;
                                                        }
                                                        return "vh" === a || "vw" === a
                                                            ? (("vh" === a ? Math.max(document.documentElement.clientHeight, window.innerHeight || 0) : Math.max(document.documentElement.clientWidth, window.innerWidth || 0)) / 100) * o
                                                            : o;
                                                    })(e, r, t, n);
                                                });
                                        })).forEach(function (e, t) {
                                            e.forEach(function (n, i) {
                                                qe(n) && (r[t] += n * ("-" === e[i - 1] ? -1 : 1));
                                            });
                                        }),
                                            r
                                    );
                                })(i, a, s, l)),
                                "left" === l
                                    ? ((a.top += n[0]), (a.left -= n[1]))
                                    : "right" === l
                                    ? ((a.top += n[0]), (a.left += n[1]))
                                    : "top" === l
                                        ? ((a.left += n[0]), (a.top -= n[1]))
                                        : "bottom" === l && ((a.left += n[0]), (a.top += n[1])),
                                (e.popper = a),
                                e
                        );
                    },
                    offset: 0,
                },
                preventOverflow: {
                    order: 300,
                    enabled: !0,
                    fn: function (e, t) {
                        var n = t.boundariesElement || ge(e.instance.popper);
                        e.instance.reference === n && (n = ge(n));
                        var i = Me("transform"),
                            r = e.instance.popper.style,
                            o = r.top,
                            a = r.left,
                            s = r[i];
                        (r.top = ""), (r.left = ""), (r[i] = "");
                        var l = De(e.instance.popper, e.instance.reference, t.padding, n, e.positionFixed);
                        (r.top = o), (r.left = a), (r[i] = s), (t.boundaries = l);
                        var c = t.priority,
                            u = e.offsets.popper,
                            d = {
                                primary: function (e) {
                                    var n = u[e];
                                    return u[e] < l[e] && !t.escapeWithReference && (n = Math.max(u[e], l[e])), Ee({}, e, n);
                                },
                                secondary: function (e) {
                                    var n = "right" === e ? "left" : "top",
                                        i = u[n];
                                    return u[e] > l[e] && !t.escapeWithReference && (i = Math.min(u[n], l[e] - ("right" === e ? u.width : u.height))), Ee({}, n, i);
                                },
                            };
                        return (
                            c.forEach(function (e) {
                                var t = -1 !== ["left", "top"].indexOf(e) ? "primary" : "secondary";
                                u = Qe({}, u, d[t](e));
                            }),
                                (e.offsets.popper = u),
                                e
                        );
                    },
                    priority: ["left", "right", "top", "bottom"],
                    padding: 5,
                    boundariesElement: "scrollParent",
                },
                keepTogether: {
                    order: 400,
                    enabled: !0,
                    fn: function (e) {
                        var t = e.offsets,
                            n = t.popper,
                            i = t.reference,
                            r = e.placement.split("-")[0],
                            o = Math.floor,
                            a = -1 !== ["top", "bottom"].indexOf(r),
                            s = a ? "right" : "bottom",
                            l = a ? "left" : "top",
                            c = a ? "width" : "height";
                        return n[s] < o(i[l]) && (e.offsets.popper[l] = o(i[l]) - n[c]), n[l] > o(i[s]) && (e.offsets.popper[l] = o(i[s])), e;
                    },
                },
                arrow: {
                    order: 500,
                    enabled: !0,
                    fn: function (e, t) {
                        var n;
                        if (!ze(e.instance.modifiers, "arrow", "keepTogether")) return e;
                        var i = t.element;
                        if ("string" == typeof i) {
                            if (!(i = e.instance.popper.querySelector(i))) return e;
                        } else if (!e.instance.popper.contains(i)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;
                        var r = e.placement.split("-")[0],
                            o = e.offsets,
                            a = o.popper,
                            s = o.reference,
                            l = -1 !== ["left", "right"].indexOf(r),
                            c = l ? "height" : "width",
                            u = l ? "Top" : "Left",
                            d = u.toLowerCase(),
                            h = l ? "left" : "top",
                            p = l ? "bottom" : "right",
                            f = Ne(i)[c];
                        s[p] - f < a[d] && (e.offsets.popper[d] -= a[d] - (s[p] - f)), s[d] + f > a[p] && (e.offsets.popper[d] += s[d] + f - a[p]), (e.offsets.popper = Te(e.offsets.popper));
                        var m = s[d] + s[c] / 2 - f / 2,
                            g = ue(e.instance.popper),
                            v = parseFloat(g["margin" + u], 10),
                            y = parseFloat(g["border" + u + "Width"], 10),
                            _ = m - e.offsets.popper[d] - v - y;
                        return (_ = Math.max(Math.min(a[c] - f, _), 0)), (e.arrowElement = i), (e.offsets.arrow = (Ee((n = {}), d, Math.round(_)), Ee(n, h, ""), n)), e;
                    },
                    element: "[x-arrow]",
                },
                flip: {
                    order: 600,
                    enabled: !0,
                    fn: function (e, t) {
                        if (He(e.instance.modifiers, "inner")) return e;
                        if (e.flipped && e.placement === e.originalPlacement) return e;
                        var n = De(e.instance.popper, e.instance.reference, t.padding, t.boundariesElement, e.positionFixed),
                            i = e.placement.split("-")[0],
                            r = xe(i),
                            o = e.placement.split("-")[1] || "",
                            a = [];
                        switch (t.behavior) {
                            case "flip":
                                a = [i, r];
                                break;
                            case "clockwise":
                                a = Ve(i);
                                break;
                            case "counterclockwise":
                                a = Ve(i, !0);
                                break;
                            default:
                                a = t.behavior;
                        }
                        return (
                            a.forEach(function (s, l) {
                                if (i !== s || a.length === l + 1) return e;
                                (i = e.placement.split("-")[0]), (r = xe(i));
                                var c,
                                    u = e.offsets.popper,
                                    d = e.offsets.reference,
                                    h = Math.floor,
                                    p = ("left" === i && h(u.right) > h(d.left)) || ("right" === i && h(u.left) < h(d.right)) || ("top" === i && h(u.bottom) > h(d.top)) || ("bottom" === i && h(u.top) < h(d.bottom)),
                                    f = h(u.left) < h(n.left),
                                    m = h(u.right) > h(n.right),
                                    g = h(u.top) < h(n.top),
                                    v = h(u.bottom) > h(n.bottom),
                                    y = ("left" === i && f) || ("right" === i && m) || ("top" === i && g) || ("bottom" === i && v),
                                    _ = -1 !== ["top", "bottom"].indexOf(i),
                                    b = !!t.flipVariations && ((_ && "start" === o && f) || (_ && "end" === o && m) || (!_ && "start" === o && g) || (!_ && "end" === o && v));
                                (p || y || b) &&
                                ((e.flipped = !0),
                                (p || y) && (i = a[l + 1]),
                                b && (o = "end" === (c = o) ? "start" : "start" === c ? "end" : c),
                                    (e.placement = i + (o ? "-" + o : "")),
                                    (e.offsets.popper = Qe({}, e.offsets.popper, Pe(e.instance.popper, e.offsets.reference, e.placement))),
                                    (e = Fe(e.instance.modifiers, e, "flip")));
                            }),
                                e
                        );
                    },
                    behavior: "flip",
                    padding: 5,
                    boundariesElement: "viewport",
                },
                inner: {
                    order: 700,
                    enabled: !1,
                    fn: function (e) {
                        var t = e.placement,
                            n = t.split("-")[0],
                            i = e.offsets,
                            r = i.popper,
                            o = i.reference,
                            a = -1 !== ["left", "right"].indexOf(n),
                            s = -1 === ["top", "left"].indexOf(n);
                        return (r[a ? "left" : "top"] = o[n] - (s ? r[a ? "width" : "height"] : 0)), (e.placement = xe(t)), (e.offsets.popper = Te(r)), e;
                    },
                },
                hide: {
                    order: 800,
                    enabled: !0,
                    fn: function (e) {
                        if (!ze(e.instance.modifiers, "hide", "preventOverflow")) return e;
                        var t = e.offsets.reference,
                            n = Le(e.instance.modifiers, function (e) {
                                return "preventOverflow" === e.name;
                            }).boundaries;
                        if (t.bottom < n.top || t.left > n.right || t.top > n.bottom || t.right < n.left) {
                            if (!0 === e.hide) return e;
                            (e.hide = !0), (e.attributes["x-out-of-boundaries"] = "");
                        } else {
                            if (!1 === e.hide) return e;
                            (e.hide = !1), (e.attributes["x-out-of-boundaries"] = !1);
                        }
                        return e;
                    },
                },
                computeStyle: {
                    order: 850,
                    enabled: !0,
                    fn: function (e, t) {
                        var n = t.x,
                            i = t.y,
                            r = e.offsets.popper,
                            o = Le(e.instance.modifiers, function (e) {
                                return "applyStyle" === e.name;
                            }).gpuAcceleration;
                        void 0 !== o && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                        var a,
                            s,
                            l = void 0 !== o ? o : t.gpuAcceleration,
                            c = Se(ge(e.instance.popper)),
                            u = {position: r.position},
                            d = {
                                left: Math.floor(r.left),
                                top: Math.round(r.top),
                                bottom: Math.round(r.bottom),
                                right: Math.floor(r.right)
                            },
                            h = "bottom" === n ? "top" : "bottom",
                            p = "right" === i ? "left" : "right",
                            f = Me("transform");
                        if (((s = "bottom" === h ? -c.height + d.bottom : d.top), (a = "right" === p ? -c.width + d.right : d.left), l && f))
                            (u[f] = "translate3d(" + a + "px, " + s + "px, 0)"), (u[h] = 0), (u[p] = 0), (u.willChange = "transform");
                        else {
                            var m = "bottom" === h ? -1 : 1,
                                g = "right" === p ? -1 : 1;
                            (u[h] = s * m), (u[p] = a * g), (u.willChange = h + ", " + p);
                        }
                        var v = {"x-placement": e.placement};
                        return (e.attributes = Qe({}, v, e.attributes)), (e.styles = Qe({}, u, e.styles)), (e.arrowStyles = Qe({}, e.offsets.arrow, e.arrowStyles)), e;
                    },
                    gpuAcceleration: !0,
                    x: "bottom",
                    y: "right",
                },
                applyStyle: {
                    order: 900,
                    enabled: !0,
                    fn: function (e) {
                        var t, n;
                        return (
                            Re(e.instance.popper, e.styles),
                                (t = e.instance.popper),
                                (n = e.attributes),
                                Object.keys(n).forEach(function (e) {
                                    !1 !== n[e] ? t.setAttribute(e, n[e]) : t.removeAttribute(e);
                                }),
                            e.arrowElement && Object.keys(e.arrowStyles).length && Re(e.arrowElement, e.arrowStyles),
                                e
                        );
                    },
                    onLoad: function (e, t, n, i, r) {
                        var o = Ie(r, t, e, n.positionFixed),
                            a = Oe(n.placement, o, t, e, n.modifiers.flip.boundariesElement, n.modifiers.flip.padding);
                        return t.setAttribute("x-placement", a), Re(t, {position: n.positionFixed ? "fixed" : "absolute"}), n;
                    },
                    gpuAcceleration: void 0,
                },
            },
        },
        Ye = (function () {
            function e(t, n) {
                var i = this,
                    r = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
                !(function (e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
                })(this, e),
                    (this.scheduleUpdate = function () {
                        return requestAnimationFrame(i.update);
                    }),
                    (this.update = le(this.update.bind(this))),
                    (this.options = Qe({}, e.Defaults, r)),
                    (this.state = {isDestroyed: !1, isCreated: !1, scrollParents: []}),
                    (this.reference = t && t.jquery ? t[0] : t),
                    (this.popper = n && n.jquery ? n[0] : n),
                    (this.options.modifiers = {}),
                    Object.keys(Qe({}, e.Defaults.modifiers, r.modifiers)).forEach(function (t) {
                        i.options.modifiers[t] = Qe({}, e.Defaults.modifiers[t] || {}, r.modifiers ? r.modifiers[t] : {});
                    }),
                    (this.modifiers = Object.keys(this.options.modifiers)
                        .map(function (e) {
                            return Qe({name: e}, i.options.modifiers[e]);
                        })
                        .sort(function (e, t) {
                            return e.order - t.order;
                        })),
                    this.modifiers.forEach(function (e) {
                        e.enabled && ce(e.onLoad) && e.onLoad(i.reference, i.popper, i.options, e, i.state);
                    }),
                    this.update();
                var o = this.options.eventsEnabled;
                o && this.enableEventListeners(), (this.state.eventsEnabled = o);
            }

            return (
                Ce(e, [
                    {
                        key: "update",
                        value: function () {
                            return function () {
                                if (!this.state.isDestroyed) {
                                    var e = {
                                        instance: this,
                                        styles: {},
                                        arrowStyles: {},
                                        attributes: {},
                                        flipped: !1,
                                        offsets: {}
                                    };
                                    (e.offsets.reference = Ie(this.state, this.popper, this.reference, this.options.positionFixed)),
                                        (e.placement = Oe(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding)),
                                        (e.originalPlacement = e.placement),
                                        (e.positionFixed = this.options.positionFixed),
                                        (e.offsets.popper = Pe(this.popper, e.offsets.reference, e.placement)),
                                        (e.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute"),
                                        (e = Fe(this.modifiers, e)),
                                        this.state.isCreated ? this.options.onUpdate(e) : ((this.state.isCreated = !0), this.options.onCreate(e));
                                }
                            }.call(this);
                        },
                    },
                    {
                        key: "destroy",
                        value: function () {
                            return function () {
                                return (
                                    (this.state.isDestroyed = !0),
                                    He(this.modifiers, "applyStyle") &&
                                    (this.popper.removeAttribute("x-placement"),
                                        (this.popper.style.position = ""),
                                        (this.popper.style.top = ""),
                                        (this.popper.style.left = ""),
                                        (this.popper.style.right = ""),
                                        (this.popper.style.bottom = ""),
                                        (this.popper.style.willChange = ""),
                                        (this.popper.style[Me("transform")] = "")),
                                        this.disableEventListeners(),
                                    this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper),
                                        this
                                );
                            }.call(this);
                        },
                    },
                    {
                        key: "enableEventListeners",
                        value: function () {
                            return function () {
                                this.state.eventsEnabled ||
                                (this.state = (function (e, t, n, i) {
                                    (n.updateBound = i), Be(e).addEventListener("resize", n.updateBound, {passive: !0});
                                    var r = he(e);
                                    return (
                                        (function e(t, n, i, r) {
                                            var o = "BODY" === t.nodeName,
                                                a = o ? t.ownerDocument.defaultView : t;
                                            a.addEventListener(n, i, {passive: !0}), o || e(he(a.parentNode), n, i, r), r.push(a);
                                        })(r, "scroll", n.updateBound, n.scrollParents),
                                            (n.scrollElement = r),
                                            (n.eventsEnabled = !0),
                                            n
                                    );
                                })(this.reference, this.options, this.state, this.scheduleUpdate));
                            }.call(this);
                        },
                    },
                    {
                        key: "disableEventListeners",
                        value: function () {
                            return We.call(this);
                        },
                    },
                ]),
                    e
            );
        })();
    (Ye.Utils = ("undefined" != typeof window ? window : global).PopperUtils), (Ye.placements = Ue), (Ye.Defaults = $e);
    var Je,
        Ze,
        Ge,
        Xe,
        et,
        tt,
        nt,
        it,
        rt,
        ot,
        at,
        st,
        lt,
        ct,
        ut,
        dt,
        ht,
        pt,
        ft,
        mt,
        gt,
        vt,
        yt,
        _t,
        bt,
        wt,
        jt,
        Ct,
        Et,
        Qt,
        Tt,
        St,
        kt,
        At,
        Dt,
        Ot,
        It,
        Nt,
        xt,
        Pt,
        Lt,
        Ft,
        Ht,
        Mt,
        Bt,
        Wt,
        qt,
        Rt,
        zt,
        Ut,
        Kt,
        Vt,
        $t,
        Yt,
        Jt,
        Zt,
        Gt,
        Xt,
        en,
        tn,
        nn,
        rn,
        on,
        an,
        sn,
        ln,
        cn,
        un,
        dn,
        hn,
        pn,
        fn,
        mn,
        gn,
        vn,
        yn,
        _n,
        bn,
        wn,
        jn,
        Cn,
        En,
        Qn,
        Tn =
            ((Ze = "dropdown"),
                (Xe = "." + (Ge = "bs.dropdown")),
                (et = ".data-api"),
                (tt = (Je = t).fn[Ze]),
                (nt = new RegExp("38|40|27")),
                (it = {
                    HIDE: "hide" + Xe,
                    HIDDEN: "hidden" + Xe,
                    SHOW: "show" + Xe,
                    SHOWN: "shown" + Xe,
                    CLICK: "click" + Xe,
                    CLICK_DATA_API: "click" + Xe + et,
                    KEYDOWN_DATA_API: "keydown" + Xe + et,
                    KEYUP_DATA_API: "keyup" + Xe + et
                }),
                (rt = "disabled"),
                (ot = "show"),
                "dropup",
                "dropright",
                "dropleft",
                (at = "dropdown-menu-right"),
                "position-static",
                (st = '[data-toggle="dropdown"]'),
                ".dropdown form",
                (lt = ".dropdown-menu"),
                ".navbar-nav",
                ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
                "top-start",
                "top-end",
                "bottom-start",
                "bottom-end",
                "right-start",
                "left-start",
                (ct = {offset: 0, flip: !0, boundary: "scrollParent", reference: "toggle", display: "dynamic"}),
                (ut = {
                    offset: "(number|string|function)",
                    flip: "boolean",
                    boundary: "(string|element)",
                    reference: "(string|element)",
                    display: "string"
                }),
                (dt = (function () {
                    function e(e, t) {
                        (this._element = e), (this._popper = null), (this._config = this._getConfig(t)), (this._menu = this._getMenuElement()), (this._inNavbar = this._detectNavbar()), this._addEventListeners();
                    }

                    var t = e.prototype;
                    return (
                        (t.toggle = function () {
                            if (!this._element.disabled && !Je(this._element).hasClass(rt)) {
                                var t = e._getParentFromElement(this._element),
                                    n = Je(this._menu).hasClass(ot);
                                if ((e._clearMenus(), !n)) {
                                    var i = {relatedTarget: this._element},
                                        r = Je.Event(it.SHOW, i);
                                    if ((Je(t).trigger(r), !r.isDefaultPrevented())) {
                                        if (!this._inNavbar) {
                                            if (void 0 === Ye) throw new TypeError("Bootstrap dropdown require Popper.js (https://popper.js.org)");
                                            var o = this._element;
                                            "parent" === this._config.reference ? (o = t) : X.isElement(this._config.reference) && ((o = this._config.reference), void 0 !== this._config.reference.jquery && (o = this._config.reference[0])),
                                            "scrollParent" !== this._config.boundary && Je(t).addClass("position-static"),
                                                (this._popper = new Ye(o, this._menu, this._getPopperConfig()));
                                        }
                                        "ontouchstart" in document.documentElement && 0 === Je(t).closest(".navbar-nav").length && Je(document.body).children().on("mouseover", null, Je.noop),
                                            this._element.focus(),
                                            this._element.setAttribute("aria-expanded", !0),
                                            Je(this._menu).toggleClass(ot),
                                            Je(t).toggleClass(ot).trigger(Je.Event(it.SHOWN, i));
                                    }
                                }
                            }
                        }),
                            (t.dispose = function () {
                                Je.removeData(this._element, Ge), Je(this._element).off(Xe), (this._element = null), (this._menu = null) !== this._popper && (this._popper.destroy(), (this._popper = null));
                            }),
                            (t.update = function () {
                                (this._inNavbar = this._detectNavbar()), null !== this._popper && this._popper.scheduleUpdate();
                            }),
                            (t._addEventListeners = function () {
                                var e = this;
                                Je(this._element).on(it.CLICK, function (t) {
                                    t.preventDefault(), t.stopPropagation(), e.toggle();
                                });
                            }),
                            (t._getConfig = function (e) {
                                return (e = r({}, this.constructor.Default, Je(this._element).data(), e)), X.typeCheckConfig(Ze, e, this.constructor.DefaultType), e;
                            }),
                            (t._getMenuElement = function () {
                                if (!this._menu) {
                                    var t = e._getParentFromElement(this._element);
                                    t && (this._menu = t.querySelector(lt));
                                }
                                return this._menu;
                            }),
                            (t._getPlacement = function () {
                                var e = Je(this._element.parentNode),
                                    t = "bottom-start";
                                return (
                                    e.hasClass("dropup")
                                        ? ((t = "top-start"), Je(this._menu).hasClass(at) && (t = "top-end"))
                                        : e.hasClass("dropright")
                                        ? (t = "right-start")
                                        : e.hasClass("dropleft")
                                            ? (t = "left-start")
                                            : Je(this._menu).hasClass(at) && (t = "bottom-end"),
                                        t
                                );
                            }),
                            (t._detectNavbar = function () {
                                return 0 < Je(this._element).closest(".navbar").length;
                            }),
                            (t._getPopperConfig = function () {
                                var e = this,
                                    t = {};
                                "function" == typeof this._config.offset
                                    ? (t.fn = function (t) {
                                        return (t.offsets = r({}, t.offsets, e._config.offset(t.offsets) || {})), t;
                                    })
                                    : (t.offset = this._config.offset);
                                var n = {
                                    placement: this._getPlacement(),
                                    modifiers: {
                                        offset: t,
                                        flip: {enabled: this._config.flip},
                                        preventOverflow: {boundariesElement: this._config.boundary}
                                    }
                                };
                                return "static" === this._config.display && (n.modifiers.applyStyle = {enabled: !1}), n;
                            }),
                            (e._jQueryInterface = function (t) {
                                return this.each(function () {
                                    var n = Je(this).data(Ge);
                                    if ((n || ((n = new e(this, "object" == typeof t ? t : null)), Je(this).data(Ge, n)), "string" == typeof t)) {
                                        if (void 0 === n[t]) throw new TypeError('No method named "' + t + '"');
                                        n[t]();
                                    }
                                });
                            }),
                            (e._clearMenus = function (t) {
                                if (!t || (3 !== t.which && ("keyup" !== t.type || 9 === t.which)))
                                    for (var n = [].slice.call(document.querySelectorAll(st)), i = 0, r = n.length; i < r; i++) {
                                        var o = e._getParentFromElement(n[i]),
                                            a = Je(n[i]).data(Ge),
                                            s = {relatedTarget: n[i]};
                                        if ((t && "click" === t.type && (s.clickEvent = t), a)) {
                                            var l = a._menu;
                                            if (Je(o).hasClass(ot) && !(t && (("click" === t.type && /input|textarea/i.test(t.target.tagName)) || ("keyup" === t.type && 9 === t.which)) && Je.contains(o, t.target))) {
                                                var c = Je.Event(it.HIDE, s);
                                                Je(o).trigger(c),
                                                c.isDefaultPrevented() ||
                                                ("ontouchstart" in document.documentElement && Je(document.body).children().off("mouseover", null, Je.noop),
                                                    n[i].setAttribute("aria-expanded", "false"),
                                                    Je(l).removeClass(ot),
                                                    Je(o).removeClass(ot).trigger(Je.Event(it.HIDDEN, s)));
                                            }
                                        }
                                    }
                            }),
                            (e._getParentFromElement = function (e) {
                                var t,
                                    n = X.getSelectorFromElement(e);
                                return n && (t = document.querySelector(n)), t || e.parentNode;
                            }),
                            (e._dataApiKeydownHandler = function (t) {
                                if (
                                    (/input|textarea/i.test(t.target.tagName) ? !(32 === t.which || (27 !== t.which && ((40 !== t.which && 38 !== t.which) || Je(t.target).closest(lt).length))) : nt.test(t.which)) &&
                                    (t.preventDefault(), t.stopPropagation(), !this.disabled && !Je(this).hasClass(rt))
                                ) {
                                    var n = e._getParentFromElement(this),
                                        i = Je(n).hasClass(ot);
                                    if ((i || (27 === t.which && 32 === t.which)) && (!i || (27 !== t.which && 32 !== t.which))) {
                                        var r = [].slice.call(n.querySelectorAll(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)"));
                                        if (0 !== r.length) {
                                            var o = r.indexOf(t.target);
                                            38 === t.which && 0 < o && o--, 40 === t.which && o < r.length - 1 && o++, o < 0 && (o = 0), r[o].focus();
                                        }
                                    } else {
                                        if (27 === t.which) {
                                            var a = n.querySelector(st);
                                            Je(a).trigger("focus");
                                        }
                                        Je(this).trigger("click");
                                    }
                                }
                            }),
                            i(e, null, [
                                {
                                    key: "VERSION",
                                    get: function () {
                                        return "4.1.3";
                                    },
                                },
                                {
                                    key: "Default",
                                    get: function () {
                                        return ct;
                                    },
                                },
                                {
                                    key: "DefaultType",
                                    get: function () {
                                        return ut;
                                    },
                                },
                            ]),
                            e
                    );
                })()),
                Je(document)
                    .on(it.KEYDOWN_DATA_API, st, dt._dataApiKeydownHandler)
                    .on(it.KEYDOWN_DATA_API, lt, dt._dataApiKeydownHandler)
                    .on(it.CLICK_DATA_API + " " + it.KEYUP_DATA_API, dt._clearMenus)
                    .on(it.CLICK_DATA_API, st, function (e) {
                        e.preventDefault(), e.stopPropagation(), dt._jQueryInterface.call(Je(this), "toggle");
                    })
                    .on(it.CLICK_DATA_API, ".dropdown form", function (e) {
                        e.stopPropagation();
                    }),
                (Je.fn[Ze] = dt._jQueryInterface),
                (Je.fn[Ze].Constructor = dt),
                (Je.fn[Ze].noConflict = function () {
                    return (Je.fn[Ze] = tt), dt._jQueryInterface;
                }),
                dt),
        Sn =
            ((pt = "modal"),
                (mt = "." + (ft = "bs.modal")),
                (gt = (ht = t).fn[pt]),
                (vt = {backdrop: !0, keyboard: !0, focus: !0, show: !0}),
                (yt = {backdrop: "(boolean|string)", keyboard: "boolean", focus: "boolean", show: "boolean"}),
                (_t = {
                    HIDE: "hide" + mt,
                    HIDDEN: "hidden" + mt,
                    SHOW: "show" + mt,
                    SHOWN: "shown" + mt,
                    FOCUSIN: "focusin" + mt,
                    RESIZE: "resize" + mt,
                    CLICK_DISMISS: "click.dismiss" + mt,
                    KEYDOWN_DISMISS: "keydown.dismiss" + mt,
                    MOUSEUP_DISMISS: "mouseup.dismiss" + mt,
                    MOUSEDOWN_DISMISS: "mousedown.dismiss" + mt,
                    CLICK_DATA_API: "click" + mt + ".data-api",
                }),
                "modal-scrollbar-measure",
                "modal-backdrop",
                (bt = "modal-open"),
                (wt = "fade"),
                (jt = "show"),
                ".modal-dialog",
                '[data-toggle="modal"]',
                '[data-dismiss="modal"]',
                (Ct = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top"),
                (Et = ".sticky-top"),
                (Qt = (function () {
                    function e(e, t) {
                        (this._config = this._getConfig(t)),
                            (this._element = e),
                            (this._dialog = e.querySelector(".modal-dialog")),
                            (this._backdrop = null),
                            (this._isShown = !1),
                            (this._isBodyOverflowing = !1),
                            (this._ignoreBackdropClick = !1),
                            (this._scrollbarWidth = 0);
                    }

                    var t = e.prototype;
                    return (
                        (t.toggle = function (e) {
                            return this._isShown ? this.hide() : this.show(e);
                        }),
                            (t.show = function (e) {
                                var t = this;
                                if (!this._isTransitioning && !this._isShown) {
                                    ht(this._element).hasClass(wt) && (this._isTransitioning = !0);
                                    var n = ht.Event(_t.SHOW, {relatedTarget: e});
                                    ht(this._element).trigger(n),
                                    this._isShown ||
                                    n.isDefaultPrevented() ||
                                    ((this._isShown = !0),
                                        this._checkScrollbar(),
                                        this._setScrollbar(),
                                        this._adjustDialog(),
                                        ht(document.body).addClass(bt),
                                        this._setEscapeEvent(),
                                        this._setResizeEvent(),
                                        ht(this._element).on(_t.CLICK_DISMISS, '[data-dismiss="modal"]', function (e) {
                                            return t.hide(e);
                                        }),
                                        ht(this._dialog).on(_t.MOUSEDOWN_DISMISS, function () {
                                            ht(t._element).one(_t.MOUSEUP_DISMISS, function (e) {
                                                ht(e.target).is(t._element) && (t._ignoreBackdropClick = !0);
                                            });
                                        }),
                                        this._showBackdrop(function () {
                                            return t._showElement(e);
                                        }));
                                }
                            }),
                            (t.hide = function (e) {
                                var t = this;
                                if ((e && e.preventDefault(), !this._isTransitioning && this._isShown)) {
                                    var n = ht.Event(_t.HIDE);
                                    if ((ht(this._element).trigger(n), this._isShown && !n.isDefaultPrevented())) {
                                        this._isShown = !1;
                                        var i = ht(this._element).hasClass(wt);
                                        if (
                                            (i && (this._isTransitioning = !0),
                                                this._setEscapeEvent(),
                                                this._setResizeEvent(),
                                                ht(document).off(_t.FOCUSIN),
                                                ht(this._element).removeClass(jt),
                                                ht(this._element).off(_t.CLICK_DISMISS),
                                                ht(this._dialog).off(_t.MOUSEDOWN_DISMISS),
                                                i)
                                        ) {
                                            var r = X.getTransitionDurationFromElement(this._element);
                                            ht(this._element)
                                                .one(X.TRANSITION_END, function (e) {
                                                    return t._hideModal(e);
                                                })
                                                .emulateTransitionEnd(r);
                                        } else this._hideModal();
                                    }
                                }
                            }),
                            (t.dispose = function () {
                                ht.removeData(this._element, ft),
                                    ht(window, document, this._element, this._backdrop).off(mt),
                                    (this._config = null),
                                    (this._element = null),
                                    (this._dialog = null),
                                    (this._backdrop = null),
                                    (this._isShown = null),
                                    (this._isBodyOverflowing = null),
                                    (this._ignoreBackdropClick = null),
                                    (this._scrollbarWidth = null);
                            }),
                            (t.handleUpdate = function () {
                                this._adjustDialog();
                            }),
                            (t._getConfig = function (e) {
                                return (e = r({}, vt, e)), X.typeCheckConfig(pt, e, yt), e;
                            }),
                            (t._showElement = function (e) {
                                var t = this,
                                    n = ht(this._element).hasClass(wt);
                                (this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE) || document.body.appendChild(this._element),
                                    (this._element.style.display = "block"),
                                    this._element.removeAttribute("aria-hidden"),
                                    (this._element.scrollTop = 0),
                                n && X.reflow(this._element),
                                    ht(this._element).addClass(jt),
                                this._config.focus && this._enforceFocus();
                                var i = ht.Event(_t.SHOWN, {relatedTarget: e}),
                                    r = function () {
                                        t._config.focus && t._element.focus(), (t._isTransitioning = !1), ht(t._element).trigger(i);
                                    };
                                if (n) {
                                    var o = X.getTransitionDurationFromElement(this._element);
                                    ht(this._dialog).one(X.TRANSITION_END, r).emulateTransitionEnd(o);
                                } else r();
                            }),
                            (t._enforceFocus = function () {
                                var e = this;
                                ht(document)
                                    .off(_t.FOCUSIN)
                                    .on(_t.FOCUSIN, function (t) {
                                        document !== t.target && e._element !== t.target && 0 === ht(e._element).has(t.target).length && e._element.focus();
                                    });
                            }),
                            (t._setEscapeEvent = function () {
                                var e = this;
                                this._isShown && this._config.keyboard
                                    ? ht(this._element).on(_t.KEYDOWN_DISMISS, function (t) {
                                        27 === t.which && (t.preventDefault(), e.hide());
                                    })
                                    : this._isShown || ht(this._element).off(_t.KEYDOWN_DISMISS);
                            }),
                            (t._setResizeEvent = function () {
                                var e = this;
                                this._isShown
                                    ? ht(window).on(_t.RESIZE, function (t) {
                                        return e.handleUpdate(t);
                                    })
                                    : ht(window).off(_t.RESIZE);
                            }),
                            (t._hideModal = function () {
                                var e = this;
                                (this._element.style.display = "none"),
                                    this._element.setAttribute("aria-hidden", !0),
                                    (this._isTransitioning = !1),
                                    this._showBackdrop(function () {
                                        ht(document.body).removeClass(bt), e._resetAdjustments(), e._resetScrollbar(), ht(e._element).trigger(_t.HIDDEN);
                                    });
                            }),
                            (t._removeBackdrop = function () {
                                this._backdrop && (ht(this._backdrop).remove(), (this._backdrop = null));
                            }),
                            (t._showBackdrop = function (e) {
                                var t = this,
                                    n = ht(this._element).hasClass(wt) ? wt : "";
                                if (this._isShown && this._config.backdrop) {
                                    if (
                                        ((this._backdrop = document.createElement("div")),
                                            (this._backdrop.className = "modal-backdrop"),
                                        n && this._backdrop.classList.add(n),
                                            ht(this._backdrop).appendTo(document.body),
                                            ht(this._element).on(_t.CLICK_DISMISS, function (e) {
                                                t._ignoreBackdropClick ? (t._ignoreBackdropClick = !1) : e.target === e.currentTarget && ("static" === t._config.backdrop ? t._element.focus() : t.hide());
                                            }),
                                        n && X.reflow(this._backdrop),
                                            ht(this._backdrop).addClass(jt),
                                            !e)
                                    )
                                        return;
                                    if (!n) return void e();
                                    var i = X.getTransitionDurationFromElement(this._backdrop);
                                    ht(this._backdrop).one(X.TRANSITION_END, e).emulateTransitionEnd(i);
                                } else if (!this._isShown && this._backdrop) {
                                    ht(this._backdrop).removeClass(jt);
                                    var r = function () {
                                        t._removeBackdrop(), e && e();
                                    };
                                    if (ht(this._element).hasClass(wt)) {
                                        var o = X.getTransitionDurationFromElement(this._backdrop);
                                        ht(this._backdrop).one(X.TRANSITION_END, r).emulateTransitionEnd(o);
                                    } else r();
                                } else e && e();
                            }),
                            (t._adjustDialog = function () {
                                var e = this._element.scrollHeight > document.documentElement.clientHeight;
                                !this._isBodyOverflowing && e && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !e && (this._element.style.paddingRight = this._scrollbarWidth + "px");
                            }),
                            (t._resetAdjustments = function () {
                                (this._element.style.paddingLeft = ""), (this._element.style.paddingRight = "");
                            }),
                            (t._checkScrollbar = function () {
                                var e = document.body.getBoundingClientRect();
                                (this._isBodyOverflowing = e.left + e.right < window.innerWidth), (this._scrollbarWidth = this._getScrollbarWidth());
                            }),
                            (t._setScrollbar = function () {
                                var e = this;
                                if (this._isBodyOverflowing) {
                                    var t = [].slice.call(document.querySelectorAll(Ct)),
                                        n = [].slice.call(document.querySelectorAll(Et));
                                    ht(t).each(function (t, n) {
                                        var i = n.style.paddingRight,
                                            r = ht(n).css("padding-right");
                                        ht(n)
                                            .data("padding-right", i)
                                            .css("padding-right", parseFloat(r) + e._scrollbarWidth + "px");
                                    }),
                                        ht(n).each(function (t, n) {
                                            var i = n.style.marginRight,
                                                r = ht(n).css("margin-right");
                                            ht(n)
                                                .data("margin-right", i)
                                                .css("margin-right", parseFloat(r) - e._scrollbarWidth + "px");
                                        });
                                    var i = document.body.style.paddingRight,
                                        r = ht(document.body).css("padding-right");
                                    ht(document.body)
                                        .data("padding-right", i)
                                        .css("padding-right", parseFloat(r) + this._scrollbarWidth + "px");
                                }
                            }),
                            (t._resetScrollbar = function () {
                                var e = [].slice.call(document.querySelectorAll(Ct));
                                ht(e).each(function (e, t) {
                                    var n = ht(t).data("padding-right");
                                    ht(t).removeData("padding-right"), (t.style.paddingRight = n || "");
                                });
                                var t = [].slice.call(document.querySelectorAll("" + Et));
                                ht(t).each(function (e, t) {
                                    var n = ht(t).data("margin-right");
                                    void 0 !== n && ht(t).css("margin-right", n).removeData("margin-right");
                                });
                                var n = ht(document.body).data("padding-right");
                                ht(document.body).removeData("padding-right"), (document.body.style.paddingRight = n || "");
                            }),
                            (t._getScrollbarWidth = function () {
                                var e = document.createElement("div");
                                (e.className = "modal-scrollbar-measure"), document.body.appendChild(e);
                                var t = e.getBoundingClientRect().width - e.clientWidth;
                                return document.body.removeChild(e), t;
                            }),
                            (e._jQueryInterface = function (t, n) {
                                return this.each(function () {
                                    var i = ht(this).data(ft),
                                        o = r({}, vt, ht(this).data(), "object" == typeof t && t ? t : {});
                                    if ((i || ((i = new e(this, o)), ht(this).data(ft, i)), "string" == typeof t)) {
                                        if (void 0 === i[t]) throw new TypeError('No method named "' + t + '"');
                                        i[t](n);
                                    } else o.show && i.show(n);
                                });
                            }),
                            i(e, null, [
                                {
                                    key: "VERSION",
                                    get: function () {
                                        return "4.1.3";
                                    },
                                },
                                {
                                    key: "Default",
                                    get: function () {
                                        return vt;
                                    },
                                },
                            ]),
                            e
                    );
                })()),
                ht(document).on(_t.CLICK_DATA_API, '[data-toggle="modal"]', function (e) {
                    var t,
                        n = this,
                        i = X.getSelectorFromElement(this);
                    i && (t = document.querySelector(i));
                    var o = ht(t).data(ft) ? "toggle" : r({}, ht(t).data(), ht(this).data());
                    ("A" !== this.tagName && "AREA" !== this.tagName) || e.preventDefault();
                    var a = ht(t).one(_t.SHOW, function (e) {
                        e.isDefaultPrevented() ||
                        a.one(_t.HIDDEN, function () {
                            ht(n).is(":visible") && n.focus();
                        });
                    });
                    Qt._jQueryInterface.call(ht(t), o, this);
                }),
                (ht.fn[pt] = Qt._jQueryInterface),
                (ht.fn[pt].Constructor = Qt),
                (ht.fn[pt].noConflict = function () {
                    return (ht.fn[pt] = gt), Qt._jQueryInterface;
                }),
                Qt),
        kn =
            ((St = "tooltip"),
                (At = "." + (kt = "bs.tooltip")),
                (Dt = (Tt = t).fn[St]),
                (Ot = "bs-tooltip"),
                (It = new RegExp("(^|\\s)" + Ot + "\\S+", "g")),
                (Pt = {
                    animation: !0,
                    template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    trigger: "hover focus",
                    title: "",
                    delay: 0,
                    html: !(xt = {AUTO: "auto", TOP: "top", RIGHT: "right", BOTTOM: "bottom", LEFT: "left"}),
                    selector: !(Nt = {
                        animation: "boolean",
                        template: "string",
                        title: "(string|element|function)",
                        trigger: "string",
                        delay: "(number|object)",
                        html: "boolean",
                        selector: "(string|boolean)",
                        placement: "(string|function)",
                        offset: "(number|string)",
                        container: "(string|element|boolean)",
                        fallbackPlacement: "(string|array)",
                        boundary: "(string|element)",
                    }),
                    placement: "top",
                    offset: 0,
                    container: !1,
                    fallbackPlacement: "flip",
                    boundary: "scrollParent",
                }),
                (Ft = "out"),
                (Ht = {
                    HIDE: "hide" + At,
                    HIDDEN: "hidden" + At,
                    SHOW: (Lt = "show") + At,
                    SHOWN: "shown" + At,
                    INSERTED: "inserted" + At,
                    CLICK: "click" + At,
                    FOCUSIN: "focusin" + At,
                    FOCUSOUT: "focusout" + At,
                    MOUSEENTER: "mouseenter" + At,
                    MOUSELEAVE: "mouseleave" + At,
                }),
                (Mt = "fade"),
                (Bt = "show"),
                ".tooltip-inner",
                ".arrow",
                (Wt = "hover"),
                (qt = "focus"),
                "click",
                "manual",
                (Rt = (function () {
                    function e(e, t) {
                        if (void 0 === Ye) throw new TypeError("Bootstrap tooltips require Popper.js (https://popper.js.org)");
                        (this._isEnabled = !0),
                            (this._timeout = 0),
                            (this._hoverState = ""),
                            (this._activeTrigger = {}),
                            (this._popper = null),
                            (this.element = e),
                            (this.config = this._getConfig(t)),
                            (this.tip = null),
                            this._setListeners();
                    }

                    var t = e.prototype;
                    return (
                        (t.enable = function () {
                            this._isEnabled = !0;
                        }),
                            (t.disable = function () {
                                this._isEnabled = !1;
                            }),
                            (t.toggleEnabled = function () {
                                this._isEnabled = !this._isEnabled;
                            }),
                            (t.toggle = function (e) {
                                if (this._isEnabled)
                                    if (e) {
                                        var t = this.constructor.DATA_KEY,
                                            n = Tt(e.currentTarget).data(t);
                                        n || ((n = new this.constructor(e.currentTarget, this._getDelegateConfig())), Tt(e.currentTarget).data(t, n)),
                                            (n._activeTrigger.click = !n._activeTrigger.click),
                                            n._isWithActiveTrigger() ? n._enter(null, n) : n._leave(null, n);
                                    } else {
                                        if (Tt(this.getTipElement()).hasClass(Bt)) return void this._leave(null, this);
                                        this._enter(null, this);
                                    }
                            }),
                            (t.dispose = function () {
                                clearTimeout(this._timeout),
                                    Tt.removeData(this.element, this.constructor.DATA_KEY),
                                    Tt(this.element).off(this.constructor.EVENT_KEY),
                                    Tt(this.element).closest(".modal").off("hide.bs.modal"),
                                this.tip && Tt(this.tip).remove(),
                                    (this._isEnabled = null),
                                    (this._timeout = null),
                                    (this._hoverState = null),
                                (this._activeTrigger = null) !== this._popper && this._popper.destroy(),
                                    (this._popper = null),
                                    (this.element = null),
                                    (this.config = null),
                                    (this.tip = null);
                            }),
                            (t.show = function () {
                                var e = this;
                                if ("none" === Tt(this.element).css("display")) throw new Error("Please use show on visible elements");
                                var t = Tt.Event(this.constructor.Event.SHOW);
                                if (this.isWithContent() && this._isEnabled) {
                                    Tt(this.element).trigger(t);
                                    var n = Tt.contains(this.element.ownerDocument.documentElement, this.element);
                                    if (t.isDefaultPrevented() || !n) return;
                                    var i = this.getTipElement(),
                                        r = X.getUID(this.constructor.NAME);
                                    i.setAttribute("id", r), this.element.setAttribute("aria-describedby", r), this.setContent(), this.config.animation && Tt(i).addClass(Mt);
                                    var o = "function" == typeof this.config.placement ? this.config.placement.call(this, i, this.element) : this.config.placement,
                                        a = this._getAttachment(o);
                                    this.addAttachmentClass(a);
                                    var s = !1 === this.config.container ? document.body : Tt(document).find(this.config.container);
                                    Tt(i).data(this.constructor.DATA_KEY, this),
                                    Tt.contains(this.element.ownerDocument.documentElement, this.tip) || Tt(i).appendTo(s),
                                        Tt(this.element).trigger(this.constructor.Event.INSERTED),
                                        (this._popper = new Ye(this.element, i, {
                                            placement: a,
                                            modifiers: {
                                                offset: {offset: this.config.offset},
                                                flip: {behavior: this.config.fallbackPlacement},
                                                arrow: {element: ".arrow"},
                                                preventOverflow: {boundariesElement: this.config.boundary}
                                            },
                                            onCreate: function (t) {
                                                t.originalPlacement !== t.placement && e._handlePopperPlacementChange(t);
                                            },
                                            onUpdate: function (t) {
                                                e._handlePopperPlacementChange(t);
                                            },
                                        })),
                                        Tt(i).addClass(Bt),
                                    "ontouchstart" in document.documentElement && Tt(document.body).children().on("mouseover", null, Tt.noop);
                                    var l = function () {
                                        e.config.animation && e._fixTransition();
                                        var t = e._hoverState;
                                        (e._hoverState = null), Tt(e.element).trigger(e.constructor.Event.SHOWN), t === Ft && e._leave(null, e);
                                    };
                                    if (Tt(this.tip).hasClass(Mt)) {
                                        var c = X.getTransitionDurationFromElement(this.tip);
                                        Tt(this.tip).one(X.TRANSITION_END, l).emulateTransitionEnd(c);
                                    } else l();
                                }
                            }),
                            (t.hide = function (e) {
                                var t = this,
                                    n = this.getTipElement(),
                                    i = Tt.Event(this.constructor.Event.HIDE),
                                    r = function () {
                                        t._hoverState !== Lt && n.parentNode && n.parentNode.removeChild(n),
                                            t._cleanTipClass(),
                                            t.element.removeAttribute("aria-describedby"),
                                            Tt(t.element).trigger(t.constructor.Event.HIDDEN),
                                        null !== t._popper && t._popper.destroy(),
                                        e && e();
                                    };
                                if ((Tt(this.element).trigger(i), !i.isDefaultPrevented())) {
                                    if (
                                        (Tt(n).removeClass(Bt),
                                        "ontouchstart" in document.documentElement && Tt(document.body).children().off("mouseover", null, Tt.noop),
                                            (this._activeTrigger.click = !1),
                                            (this._activeTrigger[qt] = !1),
                                            (this._activeTrigger[Wt] = !1),
                                            Tt(this.tip).hasClass(Mt))
                                    ) {
                                        var o = X.getTransitionDurationFromElement(n);
                                        Tt(n).one(X.TRANSITION_END, r).emulateTransitionEnd(o);
                                    } else r();
                                    this._hoverState = "";
                                }
                            }),
                            (t.update = function () {
                                null !== this._popper && this._popper.scheduleUpdate();
                            }),
                            (t.isWithContent = function () {
                                return Boolean(this.getTitle());
                            }),
                            (t.addAttachmentClass = function (e) {
                                Tt(this.getTipElement()).addClass(Ot + "-" + e);
                            }),
                            (t.getTipElement = function () {
                                return (this.tip = this.tip || Tt(this.config.template)[0]), this.tip;
                            }),
                            (t.setContent = function () {
                                var e = this.getTipElement();
                                this.setElementContent(Tt(e.querySelectorAll(".tooltip-inner")), this.getTitle()), Tt(e).removeClass(Mt + " " + Bt);
                            }),
                            (t.setElementContent = function (e, t) {
                                var n = this.config.html;
                                "object" == typeof t && (t.nodeType || t.jquery) ? (n ? Tt(t).parent().is(e) || e.empty().append(t) : e.text(Tt(t).text())) : e[n ? "html" : "text"](t);
                            }),
                            (t.getTitle = function () {
                                var e = this.element.getAttribute("data-original-title");
                                return e || (e = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), e;
                            }),
                            (t._getAttachment = function (e) {
                                return xt[e.toUpperCase()];
                            }),
                            (t._setListeners = function () {
                                var e = this;
                                this.config.trigger.split(" ").forEach(function (t) {
                                    if ("click" === t)
                                        Tt(e.element).on(e.constructor.Event.CLICK, e.config.selector, function (t) {
                                            return e.toggle(t);
                                        });
                                    else if ("manual" !== t) {
                                        var n = t === Wt ? e.constructor.Event.MOUSEENTER : e.constructor.Event.FOCUSIN,
                                            i = t === Wt ? e.constructor.Event.MOUSELEAVE : e.constructor.Event.FOCUSOUT;
                                        Tt(e.element)
                                            .on(n, e.config.selector, function (t) {
                                                return e._enter(t);
                                            })
                                            .on(i, e.config.selector, function (t) {
                                                return e._leave(t);
                                            });
                                    }
                                    Tt(e.element)
                                        .closest(".modal")
                                        .on("hide.bs.modal", function () {
                                            return e.hide();
                                        });
                                }),
                                    this.config.selector ? (this.config = r({}, this.config, {
                                        trigger: "manual",
                                        selector: ""
                                    })) : this._fixTitle();
                            }),
                            (t._fixTitle = function () {
                                var e = typeof this.element.getAttribute("data-original-title");
                                (this.element.getAttribute("title") || "string" !== e) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""));
                            }),
                            (t._enter = function (e, t) {
                                var n = this.constructor.DATA_KEY;
                                (t = t || Tt(e.currentTarget).data(n)) || ((t = new this.constructor(e.currentTarget, this._getDelegateConfig())), Tt(e.currentTarget).data(n, t)),
                                e && (t._activeTrigger["focusin" === e.type ? qt : Wt] = !0),
                                    Tt(t.getTipElement()).hasClass(Bt) || t._hoverState === Lt
                                        ? (t._hoverState = Lt)
                                        : (clearTimeout(t._timeout),
                                            (t._hoverState = Lt),
                                            t.config.delay && t.config.delay.show
                                                ? (t._timeout = setTimeout(function () {
                                                    t._hoverState === Lt && t.show();
                                                }, t.config.delay.show))
                                                : t.show());
                            }),
                            (t._leave = function (e, t) {
                                var n = this.constructor.DATA_KEY;
                                (t = t || Tt(e.currentTarget).data(n)) || ((t = new this.constructor(e.currentTarget, this._getDelegateConfig())), Tt(e.currentTarget).data(n, t)),
                                e && (t._activeTrigger["focusout" === e.type ? qt : Wt] = !1),
                                t._isWithActiveTrigger() ||
                                (clearTimeout(t._timeout),
                                    (t._hoverState = Ft),
                                    t.config.delay && t.config.delay.hide
                                        ? (t._timeout = setTimeout(function () {
                                            t._hoverState === Ft && t.hide();
                                        }, t.config.delay.hide))
                                        : t.hide());
                            }),
                            (t._isWithActiveTrigger = function () {
                                for (var e in this._activeTrigger) if (this._activeTrigger[e]) return !0;
                                return !1;
                            }),
                            (t._getConfig = function (e) {
                                return (
                                    "number" == typeof (e = r({}, this.constructor.Default, Tt(this.element).data(), "object" == typeof e && e ? e : {})).delay && (e.delay = {
                                        show: e.delay,
                                        hide: e.delay
                                    }),
                                    "number" == typeof e.title && (e.title = e.title.toString()),
                                    "number" == typeof e.content && (e.content = e.content.toString()),
                                        X.typeCheckConfig(St, e, this.constructor.DefaultType),
                                        e
                                );
                            }),
                            (t._getDelegateConfig = function () {
                                var e = {};
                                if (this.config) for (var t in this.config) this.constructor.Default[t] !== this.config[t] && (e[t] = this.config[t]);
                                return e;
                            }),
                            (t._cleanTipClass = function () {
                                var e = Tt(this.getTipElement()),
                                    t = e.attr("class").match(It);
                                null !== t && t.length && e.removeClass(t.join(""));
                            }),
                            (t._handlePopperPlacementChange = function (e) {
                                var t = e.instance;
                                (this.tip = t.popper), this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(e.placement));
                            }),
                            (t._fixTransition = function () {
                                var e = this.getTipElement(),
                                    t = this.config.animation;
                                null === e.getAttribute("x-placement") && (Tt(e).removeClass(Mt), (this.config.animation = !1), this.hide(), this.show(), (this.config.animation = t));
                            }),
                            (e._jQueryInterface = function (t) {
                                return this.each(function () {
                                    var n = Tt(this).data(kt),
                                        i = "object" == typeof t && t;
                                    if ((n || !/dispose|hide/.test(t)) && (n || ((n = new e(this, i)), Tt(this).data(kt, n)), "string" == typeof t)) {
                                        if (void 0 === n[t]) throw new TypeError('No method named "' + t + '"');
                                        n[t]();
                                    }
                                });
                            }),
                            i(e, null, [
                                {
                                    key: "VERSION",
                                    get: function () {
                                        return "4.1.3";
                                    },
                                },
                                {
                                    key: "Default",
                                    get: function () {
                                        return Pt;
                                    },
                                },
                                {
                                    key: "NAME",
                                    get: function () {
                                        return St;
                                    },
                                },
                                {
                                    key: "DATA_KEY",
                                    get: function () {
                                        return kt;
                                    },
                                },
                                {
                                    key: "Event",
                                    get: function () {
                                        return Ht;
                                    },
                                },
                                {
                                    key: "EVENT_KEY",
                                    get: function () {
                                        return At;
                                    },
                                },
                                {
                                    key: "DefaultType",
                                    get: function () {
                                        return Nt;
                                    },
                                },
                            ]),
                            e
                    );
                })()),
                (Tt.fn[St] = Rt._jQueryInterface),
                (Tt.fn[St].Constructor = Rt),
                (Tt.fn[St].noConflict = function () {
                    return (Tt.fn[St] = Dt), Rt._jQueryInterface;
                }),
                Rt),
        An =
            ((Ut = "popover"),
                (Vt = "." + (Kt = "bs.popover")),
                ($t = (zt = t).fn[Ut]),
                (Yt = "bs-popover"),
                (Jt = new RegExp("(^|\\s)" + Yt + "\\S+", "g")),
                (Zt = r({}, kn.Default, {
                    placement: "right",
                    trigger: "click",
                    content: "",
                    template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                })),
                (Gt = r({}, kn.DefaultType, {content: "(string|element|function)"})),
                "fade",
                ".popover-header",
                ".popover-body",
                (Xt = {
                    HIDE: "hide" + Vt,
                    HIDDEN: "hidden" + Vt,
                    SHOW: "show" + Vt,
                    SHOWN: "shown" + Vt,
                    INSERTED: "inserted" + Vt,
                    CLICK: "click" + Vt,
                    FOCUSIN: "focusin" + Vt,
                    FOCUSOUT: "focusout" + Vt,
                    MOUSEENTER: "mouseenter" + Vt,
                    MOUSELEAVE: "mouseleave" + Vt,
                }),
                (en = (function (e) {
                    var t, n;

                    function r() {
                        return e.apply(this, arguments) || this;
                    }

                    (n = e), ((t = r).prototype = Object.create(n.prototype)), ((t.prototype.constructor = t).__proto__ = n);
                    var o = r.prototype;
                    return (
                        (o.isWithContent = function () {
                            return this.getTitle() || this._getContent();
                        }),
                            (o.addAttachmentClass = function (e) {
                                zt(this.getTipElement()).addClass(Yt + "-" + e);
                            }),
                            (o.getTipElement = function () {
                                return (this.tip = this.tip || zt(this.config.template)[0]), this.tip;
                            }),
                            (o.setContent = function () {
                                var e = zt(this.getTipElement());
                                this.setElementContent(e.find(".popover-header"), this.getTitle());
                                var t = this._getContent();
                                "function" == typeof t && (t = t.call(this.element)), this.setElementContent(e.find(".popover-body"), t), e.removeClass("fade show");
                            }),
                            (o._getContent = function () {
                                return this.element.getAttribute("data-content") || this.config.content;
                            }),
                            (o._cleanTipClass = function () {
                                var e = zt(this.getTipElement()),
                                    t = e.attr("class").match(Jt);
                                null !== t && 0 < t.length && e.removeClass(t.join(""));
                            }),
                            (r._jQueryInterface = function (e) {
                                return this.each(function () {
                                    var t = zt(this).data(Kt),
                                        n = "object" == typeof e ? e : null;
                                    if ((t || !/destroy|hide/.test(e)) && (t || ((t = new r(this, n)), zt(this).data(Kt, t)), "string" == typeof e)) {
                                        if (void 0 === t[e]) throw new TypeError('No method named "' + e + '"');
                                        t[e]();
                                    }
                                });
                            }),
                            i(r, null, [
                                {
                                    key: "VERSION",
                                    get: function () {
                                        return "4.1.3";
                                    },
                                },
                                {
                                    key: "Default",
                                    get: function () {
                                        return Zt;
                                    },
                                },
                                {
                                    key: "NAME",
                                    get: function () {
                                        return Ut;
                                    },
                                },
                                {
                                    key: "DATA_KEY",
                                    get: function () {
                                        return Kt;
                                    },
                                },
                                {
                                    key: "Event",
                                    get: function () {
                                        return Xt;
                                    },
                                },
                                {
                                    key: "EVENT_KEY",
                                    get: function () {
                                        return Vt;
                                    },
                                },
                                {
                                    key: "DefaultType",
                                    get: function () {
                                        return Gt;
                                    },
                                },
                            ]),
                            r
                    );
                })(kn)),
                (zt.fn[Ut] = en._jQueryInterface),
                (zt.fn[Ut].Constructor = en),
                (zt.fn[Ut].noConflict = function () {
                    return (zt.fn[Ut] = $t), en._jQueryInterface;
                }),
                en),
        Dn =
            ((nn = "scrollspy"),
                (on = "." + (rn = "bs.scrollspy")),
                (an = (tn = t).fn[nn]),
                (sn = {offset: 10, method: "auto", target: ""}),
                (ln = {offset: "number", method: "string", target: "(string|element)"}),
                (cn = {ACTIVATE: "activate" + on, SCROLL: "scroll" + on, LOAD_DATA_API: "load" + on + ".data-api"}),
                "dropdown-item",
                (un = "active"),
                '[data-spy="scroll"]',
                ".active",
                (dn = ".nav, .list-group"),
                (hn = ".nav-link"),
                ".nav-item",
                (pn = ".list-group-item"),
                ".dropdown",
                ".dropdown-item",
                ".dropdown-toggle",
                "offset",
                (fn = "position"),
                (mn = (function () {
                    function e(e, t) {
                        var n = this;
                        (this._element = e),
                            (this._scrollElement = "BODY" === e.tagName ? window : e),
                            (this._config = this._getConfig(t)),
                            (this._selector = this._config.target + " " + hn + "," + this._config.target + " " + pn + "," + this._config.target + " .dropdown-item"),
                            (this._offsets = []),
                            (this._targets = []),
                            (this._activeTarget = null),
                            (this._scrollHeight = 0),
                            tn(this._scrollElement).on(cn.SCROLL, function (e) {
                                return n._process(e);
                            }),
                            this.refresh(),
                            this._process();
                    }

                    var t = e.prototype;
                    return (
                        (t.refresh = function () {
                            var e = this,
                                t = this._scrollElement === this._scrollElement.window ? "offset" : fn,
                                n = "auto" === this._config.method ? t : this._config.method,
                                i = n === fn ? this._getScrollTop() : 0;
                            (this._offsets = []),
                                (this._targets = []),
                                (this._scrollHeight = this._getScrollHeight()),
                                [].slice
                                    .call(document.querySelectorAll(this._selector))
                                    .map(function (e) {
                                        var t,
                                            r = X.getSelectorFromElement(e);
                                        if ((r && (t = document.querySelector(r)), t)) {
                                            var o = t.getBoundingClientRect();
                                            if (o.width || o.height) return [tn(t)[n]().top + i, r];
                                        }
                                        return null;
                                    })
                                    .filter(function (e) {
                                        return e;
                                    })
                                    .sort(function (e, t) {
                                        return e[0] - t[0];
                                    })
                                    .forEach(function (t) {
                                        e._offsets.push(t[0]), e._targets.push(t[1]);
                                    });
                        }),
                            (t.dispose = function () {
                                tn.removeData(this._element, rn),
                                    tn(this._scrollElement).off(on),
                                    (this._element = null),
                                    (this._scrollElement = null),
                                    (this._config = null),
                                    (this._selector = null),
                                    (this._offsets = null),
                                    (this._targets = null),
                                    (this._activeTarget = null),
                                    (this._scrollHeight = null);
                            }),
                            (t._getConfig = function (e) {
                                if ("string" != typeof (e = r({}, sn, "object" == typeof e && e ? e : {})).target) {
                                    var t = tn(e.target).attr("id");
                                    t || ((t = X.getUID(nn)), tn(e.target).attr("id", t)), (e.target = "#" + t);
                                }
                                return X.typeCheckConfig(nn, e, ln), e;
                            }),
                            (t._getScrollTop = function () {
                                return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop;
                            }),
                            (t._getScrollHeight = function () {
                                return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
                            }),
                            (t._getOffsetHeight = function () {
                                return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height;
                            }),
                            (t._process = function () {
                                var e = this._getScrollTop() + this._config.offset,
                                    t = this._getScrollHeight(),
                                    n = this._config.offset + t - this._getOffsetHeight();
                                if ((this._scrollHeight !== t && this.refresh(), n <= e)) {
                                    var i = this._targets[this._targets.length - 1];
                                    this._activeTarget !== i && this._activate(i);
                                } else {
                                    if (this._activeTarget && e < this._offsets[0] && 0 < this._offsets[0]) return (this._activeTarget = null), void this._clear();
                                    for (var r = this._offsets.length; r--;) this._activeTarget !== this._targets[r] && e >= this._offsets[r] && (void 0 === this._offsets[r + 1] || e < this._offsets[r + 1]) && this._activate(this._targets[r]);
                                }
                            }),
                            (t._activate = function (e) {
                                (this._activeTarget = e), this._clear();
                                var t = this._selector.split(",");
                                t = t.map(function (t) {
                                    return t + '[data-target="' + e + '"],' + t + '[href="' + e + '"]';
                                });
                                var n = tn([].slice.call(document.querySelectorAll(t.join(","))));
                                n.hasClass("dropdown-item")
                                    ? (n.closest(".dropdown").find(".dropdown-toggle").addClass(un), n.addClass(un))
                                    : (n.addClass(un),
                                        n
                                            .parents(dn)
                                            .prev(hn + ", " + pn)
                                            .addClass(un),
                                        n.parents(dn).prev(".nav-item").children(hn).addClass(un)),
                                    tn(this._scrollElement).trigger(cn.ACTIVATE, {relatedTarget: e});
                            }),
                            (t._clear = function () {
                                var e = [].slice.call(document.querySelectorAll(this._selector));
                                tn(e).filter(".active").removeClass(un);
                            }),
                            (e._jQueryInterface = function (t) {
                                return this.each(function () {
                                    var n = tn(this).data(rn);
                                    if ((n || ((n = new e(this, "object" == typeof t && t)), tn(this).data(rn, n)), "string" == typeof t)) {
                                        if (void 0 === n[t]) throw new TypeError('No method named "' + t + '"');
                                        n[t]();
                                    }
                                });
                            }),
                            i(e, null, [
                                {
                                    key: "VERSION",
                                    get: function () {
                                        return "4.1.3";
                                    },
                                },
                                {
                                    key: "Default",
                                    get: function () {
                                        return sn;
                                    },
                                },
                            ]),
                            e
                    );
                })()),
                tn(window).on(cn.LOAD_DATA_API, function () {
                    for (var e = [].slice.call(document.querySelectorAll('[data-spy="scroll"]')), t = e.length; t--;) {
                        var n = tn(e[t]);
                        mn._jQueryInterface.call(n, n.data());
                    }
                }),
                (tn.fn[nn] = mn._jQueryInterface),
                (tn.fn[nn].Constructor = mn),
                (tn.fn[nn].noConflict = function () {
                    return (tn.fn[nn] = an), mn._jQueryInterface;
                }),
                mn),
        On =
            ((yn = "." + (vn = "bs.tab")),
                (_n = (gn = t).fn.tab),
                (bn = {
                    HIDE: "hide" + yn,
                    HIDDEN: "hidden" + yn,
                    SHOW: "show" + yn,
                    SHOWN: "shown" + yn,
                    CLICK_DATA_API: "click" + yn + ".data-api"
                }),
                "dropdown-menu",
                (wn = "active"),
                "disabled",
                "fade",
                (jn = "show"),
                ".dropdown",
                ".nav, .list-group",
                (Cn = ".active"),
                (En = "> li > .active"),
                '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
                ".dropdown-toggle",
                "> .dropdown-menu .active",
                (Qn = (function () {
                    function e(e) {
                        this._element = e;
                    }

                    var t = e.prototype;
                    return (
                        (t.show = function () {
                            var e = this;
                            if (!((this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && gn(this._element).hasClass(wn)) || gn(this._element).hasClass("disabled"))) {
                                var t,
                                    n,
                                    i = gn(this._element).closest(".nav, .list-group")[0],
                                    r = X.getSelectorFromElement(this._element);
                                if (i) {
                                    var o = "UL" === i.nodeName ? En : Cn;
                                    n = (n = gn.makeArray(gn(i).find(o)))[n.length - 1];
                                }
                                var a = gn.Event(bn.HIDE, {relatedTarget: this._element}),
                                    s = gn.Event(bn.SHOW, {relatedTarget: n});
                                if ((n && gn(n).trigger(a), gn(this._element).trigger(s), !s.isDefaultPrevented() && !a.isDefaultPrevented())) {
                                    r && (t = document.querySelector(r)), this._activate(this._element, i);
                                    var l = function () {
                                        var t = gn.Event(bn.HIDDEN, {relatedTarget: e._element}),
                                            i = gn.Event(bn.SHOWN, {relatedTarget: n});
                                        gn(n).trigger(t), gn(e._element).trigger(i);
                                    };
                                    t ? this._activate(t, t.parentNode, l) : l();
                                }
                            }
                        }),
                            (t.dispose = function () {
                                gn.removeData(this._element, vn), (this._element = null);
                            }),
                            (t._activate = function (e, t, n) {
                                var i = this,
                                    r = ("UL" === t.nodeName ? gn(t).find(En) : gn(t).children(Cn))[0],
                                    o = n && r && gn(r).hasClass("fade"),
                                    a = function () {
                                        return i._transitionComplete(e, r, n);
                                    };
                                if (r && o) {
                                    var s = X.getTransitionDurationFromElement(r);
                                    gn(r).one(X.TRANSITION_END, a).emulateTransitionEnd(s);
                                } else a();
                            }),
                            (t._transitionComplete = function (e, t, n) {
                                if (t) {
                                    gn(t).removeClass(jn + " " + wn);
                                    var i = gn(t.parentNode).find("> .dropdown-menu .active")[0];
                                    i && gn(i).removeClass(wn), "tab" === t.getAttribute("role") && t.setAttribute("aria-selected", !1);
                                }
                                if ((gn(e).addClass(wn), "tab" === e.getAttribute("role") && e.setAttribute("aria-selected", !0), X.reflow(e), gn(e).addClass(jn), e.parentNode && gn(e.parentNode).hasClass("dropdown-menu"))) {
                                    var r = gn(e).closest(".dropdown")[0];
                                    if (r) {
                                        var o = [].slice.call(r.querySelectorAll(".dropdown-toggle"));
                                        gn(o).addClass(wn);
                                    }
                                    e.setAttribute("aria-expanded", !0);
                                }
                                n && n();
                            }),
                            (e._jQueryInterface = function (t) {
                                return this.each(function () {
                                    var n = gn(this),
                                        i = n.data(vn);
                                    if ((i || ((i = new e(this)), n.data(vn, i)), "string" == typeof t)) {
                                        if (void 0 === i[t]) throw new TypeError('No method named "' + t + '"');
                                        i[t]();
                                    }
                                });
                            }),
                            i(e, null, [
                                {
                                    key: "VERSION",
                                    get: function () {
                                        return "4.1.3";
                                    },
                                },
                            ]),
                            e
                    );
                })()),
                gn(document).on(bn.CLICK_DATA_API, '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]', function (e) {
                    e.preventDefault(), Qn._jQueryInterface.call(gn(this), "show");
                }),
                (gn.fn.tab = Qn._jQueryInterface),
                (gn.fn.tab.Constructor = Qn),
                (gn.fn.tab.noConflict = function () {
                    return (gn.fn.tab = _n), Qn._jQueryInterface;
                }),
                Qn);
    !(function (e) {
        if (void 0 === e) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
        var t = e.fn.jquery.split(" ")[0].split(".");
        if ((t[0] < 2 && t[1] < 9) || (1 === t[0] && 9 === t[1] && t[2] < 1) || 4 <= t[0]) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0");
    })(t),
        (e.Util = X),
        (e.Alert = ee),
        (e.Button = te),
        (e.Carousel = ne),
        (e.Collapse = ie),
        (e.Dropdown = Tn),
        (e.Modal = Sn),
        (e.Popover = An),
        (e.Scrollspy = Dn),
        (e.Tab = On),
        (e.Tooltip = kn),
        Object.defineProperty(e, "__esModule", {value: !0});
});


jQuery(document).ready(function () {

    // Tartans
    jQuery(document).on("click", ".options-kilt  .colapseLink", function (event) {

        jQuery('.options-kilt .colapseLink').removeClass("currentlyActive");
        var trigger = jQuery(this);
        if (jQuery(this).hasClass("collapsed")) {

        } else {
            jQuery(this).addClass("currentlyActive");
        }
        ;

        jQuery(".options-kilt .panel-collapse.show").each(function () {

            if (trigger.attr("href") != ("#" + jQuery(this).attr("id"))) {
                jQuery(this).removeClass("show");
            } // condition returns false on iteration on div to be opened
        });
    });
// Neckwear
    jQuery(document).on("click", ".options-neckwear  .colapseLink", function (event) {

        jQuery('.options-neckwear  .colapseLink').removeClass("currentlyActive");
        var trigger = jQuery(this);
        if (jQuery(this).hasClass("collapsed")) {

        } else {
            jQuery(this).addClass("currentlyActive");
        }
        ;

        jQuery(".options-neckwear  .panel-collapse.show").each(function () {

            if (trigger.attr("href") != ("#" + jQuery(this).attr("id"))) {
                jQuery(this).removeClass("show");
            } // condition returns false on iteration on div to be opened
        });
    });

    jQuery(document).on("click", ".options-sporran  .colapseLink", function (event) {

        jQuery('.options-sporran  .colapseLink').removeClass("currentlyActive");
        var trigger = jQuery(this);
        if (jQuery(this).hasClass("collapsed")) {

        } else {
            jQuery(this).addClass("currentlyActive");
        }
        ;

        jQuery(".options-sporran  .panel-collapse.show").each(function () {

            if (trigger.attr("href") != ("#" + jQuery(this).attr("id"))) {
                jQuery(this).removeClass("show");
            } // condition returns false on iteration on div to be opened
        });
    });
});