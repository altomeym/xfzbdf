<div id="new-cookie-consent-container">
    <div class="cookie-consent-banner">
        <div style="cookie-header">
            <a href="{{ url('/') }}" class="cookie-headear-logo">
                <img src="{{ get_logo_url('system', 'logo') }}" height="40px" width="120px" alt="{{ trans('theme.logo') }}" title="{{ trans('theme.logo') }}">
            </a>
            <div class="cookie-header-title">
                Manage Cookie Consent
            </div>
            <i class="fa fa-times cookie-headear-close-ico" id="cookie-cross-button"></i>
        </div>

        <p>
            {!! trans('app.cookie_consent_message') !!}
        </p>

        <div class="clearfix">
            <div class="pull-right">
                <button class="new-style-button mb-2" id="cookie-consent-button" type="button">
                    {{ trans('app.cookie_consent_agree') }}
                </button>

                <button class="new-style-button btn-light-bg mb-2" id="cookie-cancel-button" type="button">
                    {{ trans('app.cancel') }}
                </button>
            </div>
        </div>
        <div class="bottom-link">
            <a href="https://tiejet.com/page/cookie-policy">Cookie Policy</a>
            <a href="https://tiejet.com/page/privacy-policy">Privacy Statement</a>
            <a href="https://tiejet.com/page/disclaimer">Disclaimer</a>
            <a href="https://tiejet.com/page/imprint">Imprint</a>
        </div>
    </div>
</div>

<script>
    window.gdprCookieConsent = (function () {
        const COOKIE_VALUE = 1;
        const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';

        function consentWithCookies() {
            hideCookieDialog();
            setCookie('{{ config('gdpr.cookie.name') }}', COOKIE_VALUE, {{ config('gdpr.cookie.lifetime') }});
        }

        function cookieExists(name) {
            return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
        }

        function hideCookieDialog() {
            const dialogs = document.getElementById('new-cookie-consent-container');

            if(dialogs) {
                dialogs.style.display = 'none';
            }
        }

        function setCookie(name, value, expirationInDays) {
            const date = new Date();
            date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value
                + ';expires=' + date.toUTCString()
                + ';domain=' + COOKIE_DOMAIN
                + ';path=/{{ config('session.secure') ? ';secure' : null }}';
        }

        if (cookieExists('{{ config('gdpr.cookie.name') }}')) {
            hideCookieDialog();
        }

        const consentButton = document.getElementById('cookie-consent-button');
        const cancelButton = document.getElementById('cookie-cancel-button');
        const crossButton = document.getElementById('cookie-cross-button');

        if(consentButton) {
            consentButton.addEventListener('click', consentWithCookies);
        }

        if(cancelButton) {
            cancelButton.addEventListener('click', hideCookieDialog);
        }

        if(crossButton) {
            crossButton.addEventListener('click', hideCookieDialog);
        }

        return {
            consentWithCookies: consentWithCookies,
            hideCookieDialog: hideCookieDialog
        };
    })();
</script>