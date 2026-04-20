(function (d,w,o) {

    const outfitBuilderForm = d.getElementById("outfit-builder-contact-form");

    if(!outfitBuilderForm) {
        return false;
    }

    if(w.Shopify && w.Shopify.captcha) {
        w.Shopify.captcha.protect = outfitBuilderForm;
    }

    outfitBuilderForm.addEventListener("submit", (e)=> {

    });
    console.log("FORM HANDLER LOADED!");

})(document, window, OB_CONFIG);