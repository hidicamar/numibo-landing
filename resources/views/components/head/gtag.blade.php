@if (config('services.google.analytics_id'))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag(){
            dataLayer.push(arguments);
        }

        {{-- Consent Mode defaults to denied; the CookieYes banner updates consent on acceptance. --}}
        gtag('consent', 'default', {
            ad_storage: 'denied',
            ad_user_data: 'denied',
            ad_personalization: 'denied',
            analytics_storage: 'denied',
        });

        gtag('js', new Date());

        gtag('config', '{{ config('services.google.analytics_id') }}');
    </script>
@endif
