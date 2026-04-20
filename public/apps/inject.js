(function () {
    const NETLIFY = 'https://jolly-baklava-1fd510.netlify.app';

    const OB_CONFIG = {
        base_url: NETLIFY + '/proxy/',
        host: 'outfitbuilder.mccalls.co.uk'
    };

    // Make OB_CONFIG available globally for designers-min.js
    window.OB_CONFIG = OB_CONFIG;

    const anchor = document.getElementById('outfit-builder-anchor');
    if (!anchor) return;

    const scriptsJS = [
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js',
        'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js',
        NETLIFY + '/assets/js/mccalls.js',
        NETLIFY + '/assets/js/designers-min.js'
    ];

    const scriptsCSS = [
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap-grid.min.css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
        NETLIFY + '/assets/css/fonts.css',
        NETLIFY + '/assets/css/designer.css'
    ];

    const loadScript = (src) => new Promise((resolve) => {
        const s = document.createElement('script');
        s.src = src;
        s.async = false;
        s.onload = resolve;
        s.onerror = resolve;
        document.body.appendChild(s);
    });

    const loadCSS = (href) => {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = href;
        document.head.appendChild(link);
    };

    const init = async () => {
        try {
            scriptsCSS.forEach(loadCSS);

            const response = await fetch(NETLIFY + '/proxy/shopify');
            const html = await response.text();
            anchor.innerHTML = html;

            for (const src of scriptsJS) {
                await loadScript(src);
            }
        } catch (err) {
            console.error('Outfit builder load error:', err);
        }
    };

    init();
})();
