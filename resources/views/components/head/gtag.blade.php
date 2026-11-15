{{-- Google Analytics, consent first: this only declares the measurement ID and denies
     every consent signal. gtag.js itself is requested by resources/js/app.js, and only
     once the visitor has accepted analytics cookies in <x-cookie-consent />. --}}
<meta name="analytics-id" content="G-WW5M9D8J2D" />
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}

    gtag('consent', 'default', {
        ad_storage: 'denied',
        ad_user_data: 'denied',
        ad_personalization: 'denied',
        analytics_storage: 'denied',
    });
</script>
