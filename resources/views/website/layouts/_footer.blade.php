<!-- START Page Footer -->
<footer id="main-footer">
    <div class="container">
        <div class="footer-wrap">
            <div>
                <div class="footer-logo"><img src=" {!! asset('design/images/logo-word.png') !!}" alt="Tabaieb Logo">
                </div>
                <div class="footer-menu">
                    <a href="{{route('about')}}">{{ __('about tabaieb')}}</a>
                    <a href="{{route('contact.show')}}">{{ __('contact us')}}</a>
                    <a href="{{route('policy')}}">{{ __('terms & conditions')}}</a>
                </div>
            </div>
            <div class="footer-social">
                <a href="{!! $settings['facebook Link'] !!}"><i class="fab fa-facebook-f"></i></a>
                <a href="{!! $settings['twitter Link'] !!}"><i class="fab fa-twitter"></i></a>
                <a href=" {!! $settings['snapchat Link'] !!}"><i class="fab fa-snapchat-ghost"></i></a>
            </div>

        </div>
    </div>
    <div id="copyright">
        <div class="container">
            <p class="py-2 mb-0 text-capitalize">
                All rights reserved © Tabaieb 2020 | Developed BY
                <a href="http://quicky-soft.com" target="_blank" class="text-secondary">Quicky Soft</a>
            </p>
        </div>
    </div>
</footer>
<!-- END Page Footer -->
