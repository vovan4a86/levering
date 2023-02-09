@extends('template')
@section('content')
    <title>Политика конфиденциальности</title>
    <nav class="breadcrumbs {{ isset($headerIsBlack) ? 'breadcrumbs--black' : null }}">
        <div class="breadcrumbs__container container">
            <ul class="breadcrumbs__list list-reset" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a class="breadcrumbs__link" href="{{ route('main') }}" itemprop="item">
                        <span itemprop="name">Главная</span>
                        <meta itemprop="position" content="1">
                    </a>
                </li>
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a class="breadcrumbs__link breadcrumbs__link"
                       href="{{ route('policy')}}" itemprop="item">
                        <span itemprop="name">Политика конфиденциальности</span>
                        <meta itemprop="position" content="2">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <section class="policy">
            <div class="policy__container container">
                <h1 class="policy__title">Политика конфиденциальности</h1>
                <h2>Общие положения</h2>
                <p>1.1 Настоящая политика обработки персональных данных составлена в соответствии с требованиями Федерального закона от 27.07.2006. №152-ФЗ «О персональных данных» и определяет порядок обработки персональных данных и меры по обеспечению безопасности
                    персональных данных "ЛеверингУрал" (далее – Оператор).</p>
                <p>1.2 Оператор ставит своей важнейшей целью и условием осуществления своей деятельности соблюдение прав и свобод человека и гражданина при обработке его персональных данных, в том числе защиты прав на неприкосновенность частной жизни, личную и семейную
                    тайну.</p>
                <p>1.3 Настоящая политика Оператора в отношении обработки персональных данных (далее – Политика) применяется ко всей информации, которую Оператор может получить о посетителях веб-сайта</p>
                <h2>Основные используемые понятия</h2>
                <p>2.1 Автоматизированная обработка персональных данных – обработка персональных данных с помощью средств вычислительной техники;</p>
                <p>2.2 Блокирование персональных данных – временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных);</p>
                <p>2.3 Веб-сайт – совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу</p>
                <h2>Оператор может обрабатывать следующие персональные данные пользователя</h2>
                <p>2.1 Автоматизированная обработка персональных данных – обработка персональных данных с помощью средств вычислительной техники;</p>
                <p>2.2 Блокирование персональных данных – временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных);</p>
                <p>2.3 Веб-сайт – совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу</p>
                <h2>Цели обработки персональных данных</h2>
                <p>2.1 Автоматизированная обработка персональных данных – обработка персональных данных с помощью средств вычислительной техники;</p>
                <p>2.2 Блокирование персональных данных – временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных);</p>
                <p>2.3 Веб-сайт – совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу</p>
                <h2>Правовые основания обработки персональных данных</h2>
                <p>2.1 Автоматизированная обработка персональных данных – обработка персональных данных с помощью средств вычислительной техники;</p>
                <p>2.2 Блокирование персональных данных – временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных);</p>
                <p>2.3 Веб-сайт – совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу</p>
                <h2>Порядок сбора, хранения, передачи и других видов обработки персональных данных</h2>
                <p>2.1 Автоматизированная обработка персональных данных – обработка персональных данных с помощью средств вычислительной техники;</p>
                <p>2.2 Блокирование персональных данных – временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных);</p>
                <p>2.3 Веб-сайт – совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу</p>
                <h2>Трансграничная передача персональных данных</h2>
                <p>2.1 Автоматизированная обработка персональных данных – обработка персональных данных с помощью средств вычислительной техники;</p>
                <p>2.2 Блокирование персональных данных – временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных);</p>
                <p>2.3 Веб-сайт – совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу</p>
                <h2>Заключительные положения</h2>
                <p>2.1 Автоматизированная обработка персональных данных – обработка персональных данных с помощью средств вычислительной техники;</p>
                <p>2.2 Блокирование персональных данных – временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных);</p>
                <p>2.3 Веб-сайт – совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу</p>
            </div>
        </section>
    </main>
@stop