<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">v0.1.0-{{ time() }}</li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        {{ __('messages.footer.copyright', ['year' => date('Y')]) }}
                        <a href="https://tabler.io/" class="link-secondary">Tabler</a>.
                        {{ __('messages.footer.all_rights_reserved') }}
                    </li>
                    <li class="list-inline-item">
                        {{ __('messages.footer.app_developed') }}
                        <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                        </svg>
                        {{ __('messages.footer.developed_by') }} <a class="link" href="https://fatkur.id">Ibnu
                            Mardini</a> {{ __('messages.footer.and_contributors') }} <a class="link"
                            href="https://github.com/ibnumardini/simalu/graphs/contributors"
                            target="_blank">{{ __('messages.footer.contributors') }}</a>.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
