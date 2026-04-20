const OB_CONFIG = {
    'base_url': 'https://outfitbuilder.mccalls.co.uk/apps/',
    'host': 'outfitbuilder.mccalls.co.uk'
};

const BUILDNO = "v=1.0.14";

(function () {

    /**
     * This script calls outfit builder endpoint and
     * replaces #outfit-builder-anchor with API response
     *
     * @type {HTMLElement}
     */
    const anchor = document.getElementById('outfit-builder-anchor');

    const scriptsJS = [
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        OB_CONFIG.base_url + 'assets/js/mccalls.js?'+BUILDNO,
        OB_CONFIG.base_url + 'assets/js/designers-min.js?'+BUILDNO,
        'https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js'/*,
        OB_CONFIG.base_url + 'assets/js/form-handlers.js'*/
    ]

    if(!window.jQuery) {
        scriptsJS.unshift('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js');
    }

    const scriptsCSS = [
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap-grid.min.css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
         OB_CONFIG.base_url + 'assets/css/fonts.css?'+BUILDNO,
         OB_CONFIG.base_url + 'assets/css/designer.css?'+BUILDNO
    ];

    if (anchor) {
        const contentF = async () => {
            try {
                // Load markup
                const response = await fetch(OB_CONFIG.base_url + "shopify");
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                const result = await response.text();
                anchor.innerHTML = result;

                // load CSS
                scriptsCSS.forEach((s) => {
                    let file = document.createElement("link");
                    file.setAttribute("rel", "stylesheet");
                    file.setAttribute("type", "text/css");
                    file.async = true;
                    file.setAttribute("href", s);

                    document.head.appendChild(file);
                });

                // load JS code
                scriptsJS.forEach((s) => {
                    let file = document.createElement("script");
                    file.setAttribute("type", "text/javascript");
                    file.async = false;
                    file.src = s;

                    document.body.appendChild(file);
                });
            } catch (error) {
                console.error(error);
            }
        };

        window.addEventListener("load", () => {
            contentF();
        });


    } else {
        console.log("Anchor container is missing");
    }
})();