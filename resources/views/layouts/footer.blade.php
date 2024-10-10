<div class="sticky-bottom bg-light">
    <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item me-2">
                            &copy; {{ date('Y') }}
                            <a href="{{ config('app.url') }}" class="link-secondary">{{ config('app.name') }}</a>
                        </li>
                        <li class="list-inline-item me-2">
                            Версия 1.0.0
                        </li>
                        <li class="list-inline-item">
                            {{ now()->format('H:i') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
