<? acf_form_head();?>
<? get_header();?>
<? the_post(); ?>
<?
$age_group = "";
$age_group_id = get_the_terms(get_the_ID(), 'age-group')[0]->term_id;
if ($age_group_id === 262) $age_group = " U-21";
elseif ($age_group_id === 263) $age_group = " U-19";

?>
<!-- Основное содержимое страниц -->
<main>
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb"><a href="/">Головна</a> / <span>Матчі / Календар</span> </div>
        </div>
        <section class="main-container container">
            <h1 class="page-header page-header__matches-calendar">Календар</h1>

            <div class="team-header team-header__matches-standings">
                <ul>
                    <li><a href='matches-calendar.html' class="active">ФК Олександрія</a></li>
                    <li><a href="matches-calendar.html">ФК Олександрія U-21</a></li>
                    <li><a href="matches-calendar.html">ФК Олександрія U-19</a></li>
                </ul>
            </div>
            <section class="info-block-wrap">
                <div class="info-block">
                    <div class="info-block-container info-block-container__wo-top-border">
                        <div class="info-block__header">
                            <h3>Попередній матч</h3>
                        </div>
                        <div class="info-block__body">
                            <div class="info-block__logo">
                                <div class="info-block__logo--tur">
                                    8-й тур</br>сезон 2019/2020
                                </div>
                                <img src="img/upl.png" alt="">
                            </div>
                            <div class="info-block__meta">
                                <span class="info-block__date">
                                    14 Вересня 2019р.
                                </span>
                                <span class="info-block__stadium">
                                    КСК "Ніка", м.Олександрія
                                </span>

                            </div>
                            <div class="info-block__kickoff-container">
                                <div class="info-block__team-container">
                                    <span class="info-block__team-title info-block__team-title--home">
                                        Олександрія
                                    </span>
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/olexandriya.png"
                                            alt="">
                                    </div>
                                </div>
                                <div class="info-block__score">
                                    <span>2</span>
                                    <span>0</span>

                                </div>
                                <div class="info-block__team-container">
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/desna_0.png"
                                            alt="">
                                    </div>
                                    <span class="info-block__team-title info-block__team-title--away">
                                        Дніпро-1
                                    </span>

                                </div>
                            </div>
                            <div class="info-block__btn-container">
                                <a href="matches-center.html" class="btn info-block__btn info-block__btn--single">
                                    <span class="match-center">Матч центр</span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="info-block-container info-block-container__wo-top-border">
                        <div class="info-block__header">
                            <h3>Наступний матч</h3>
                        </div>
                        <div class="info-block__body">
                            <div class="info-block__logo">
                                <div class="info-block__logo--tur">
                                    9-й тур</br>сезон 2019/2020
                                </div>
                                <img src="img/upl.png" alt="">
                            </div>
                            <div class="info-block__meta">
                                <span class="info-block__date">
                                    21 вересня 2019р
                                </span>
                                <span class="info-block__stadium">
                                    КСК "Олімпійський", м.Київ
                                </span>

                            </div>
                            <div class="info-block__kickoff-container">
                                <div class="info-block__team-container">
                                    <span class="info-block__team-title info-block__team-title--home">
                                        Колос
                                    </span>
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/desna_0.png"
                                            alt="">
                                    </div>
                                </div>
                                <div class="info-block__time">
                                    <span class="clock-icon"></span>
                                    <span class="knock_time">21:45</span>
                                </div>
                                <div class="info-block__team-container">
                                    <div class="info-block__team-img">
                                        <img src="https://fco.com.ua/sites/default/files/styles/original/public/opponent/olexandriya.png"
                                            alt="">
                                    </div>
                                    <span class="info-block__team-title info-block__team-title--away">
                                        Олександрія
                                    </span>

                                </div>
                            </div>
                            <div class="info-block__btn-container">
                                <a href="#" class="btn info-block__btn info-block__btn--single">
                                    <span class="buy-ticket">Купити квіток</span>
                                </a>
                                <a href="#" class="btn info-block__btn info-block__btn--single">
                                    <span class="match-center">Матч центр</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </section>


            

            <section class="matches-calendar">
                <div class="matches-standings__filter">
                    <div class="matches-standings__filter-item">
                        <form action="">
                            <select name="date" id="date">
                                <option value="0">2017/2018</option>
                                <option value="0">2018/2019</option>
                                <option value="0">2019/2020</option>
                            </select>
                        </form>
                    </div>
                    <div class="matches-standings__filter-item">
                        <form action="">
                            <select name="tournament" id="tournament">
                                <option value="0">Турнір</option>
                                <option value="0">Кубок України</option>
                                <option value="0">Ліга Європи</option>
                                <option value="0" selected>Українська Прем'єр Ліга</option>
                            </select>
                        </form>
                    </div>
                </div>
                <table class="matches-calendar-table">
                    <caption class="matches-calendar-table__caption">Липень 2019</caption>
                    <tbody>
                        <tr>
                            <td class="matches-calendar-table__td--where">
                                <span class="home">Д</span>
                            </td>
                            <td class="matches-calendar-table__td--when">
                                31.07.2019
                            </td>
                            <td class="matches-calendar-table__td--time">
                                19:00
                            </td>
                            <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                <span class="club-name">Олександрія
                                </span>
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                    alt="">
                            </td>
                            <td class="matches-calendar-table__td--score">
                                <a href="matches-center.html"><span>3-1</span></a>
                            </td>
                            <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                    alt="">
                                <span>Шахтар
                                </span>
                            </td>
                            <td class="matches-calendar-table__td--tournament">
                                Українська Прем'єр - Ліга
                            </td>
                        </tr>
                        <tr>
                            <td class="matches-calendar-table__td--where">
                                <span>В</span>
                            </td>
                            <td class="matches-calendar-table__td--when">
                                31.07.2019
                            </td>
                            <td class="matches-calendar-table__td--time">
                                19:00
                            </td>
                            <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                <span>Шахтар
                                </span>
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                    alt="">
                            </td>
                            <td class="matches-calendar-table__td--score">
                                <a href="matches-center.html">0-2</a>
                            </td>
                            <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                    alt="">
                                <span class="club-name">Олександрія
                                </span>

                            </td>
                            <td class="matches-calendar-table__td--tournament">
                                Українська Прем'єр - Ліга
                            </td>
                        </tr>
                        <tr>
                            <td class="matches-calendar-table__td--where">
                                <span class="home">Д</span>
                            </td>
                            <td class="matches-calendar-table__td--when">
                                31.07.2019
                            </td>
                            <td class="matches-calendar-table__td--time">
                                19:00
                            </td>
                            <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                <span class="club-name">Олександрія
                                </span>
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                    alt="">
                            </td>
                            <td class="matches-calendar-table__td--score">
                                <a href="matches-center.html">3-1</a>
                            </td>
                            <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                    alt="">
                                <span>Шахтар
                                </span>
                            </td>
                            <td class="matches-calendar-table__td--tournament">
                                Українська Прем'єр - Ліга
                            </td>
                        </tr>
                        <tr>
                            <td class="matches-calendar-table__td--where">
                                <span>В</span>
                            </td>
                            <td class="matches-calendar-table__td--when">
                                31.07.2019
                            </td>
                            <td class="matches-calendar-table__td--time">
                                19:00
                            </td>
                            <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                <span>Шахтар
                                </span>
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                    alt="">
                            </td>
                            <td class="matches-calendar-table__td--score">
                                <a href="matches-center.html">_-_</a>
                            </td>
                            <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                    alt="">
                                <span class="club-name">Олександрія
                                </span>

                            </td>
                            <td class="matches-calendar-table__td--tournament">
                                Українська Прем'єр - Ліга
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="matches-calendar-table">
                        <caption class="matches-calendar-table__caption">Липень 2019</caption>
                        <tbody>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span class="home">Д</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span class="club-name">Олександрія
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html"><span>3-1</span></a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                    <span>Шахтар
                                    </span>
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span>В</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span>Шахтар
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html">0-2</a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                    <span class="club-name">Олександрія
                                    </span>
    
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span class="home">Д</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span class="club-name">Олександрія
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html">3-1</a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                    <span>Шахтар
                                    </span>
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span>В</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span>Шахтар
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html">_-_</a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                    <span class="club-name">Олександрія
                                    </span>
    
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                        </tbody>
                </table>
                <table class="matches-calendar-table">
                        <caption class="matches-calendar-table__caption">Липень 2019</caption>
                        <tbody>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span class="home">Д</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span class="club-name">Олександрія
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html"><span>3-1</span></a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                    <span>Шахтар
                                    </span>
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span>В</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span>Шахтар
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html">0-2</a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                    <span class="club-name">Олександрія
                                    </span>
    
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span class="home">Д</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span class="club-name">Олександрія
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html">3-1</a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                    <span>Шахтар
                                    </span>
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                            <tr>
                                <td class="matches-calendar-table__td--where">
                                    <span>В</span>
                                </td>
                                <td class="matches-calendar-table__td--when">
                                    31.07.2019
                                </td>
                                <td class="matches-calendar-table__td--time">
                                    19:00
                                </td>
                                <td class="matches-calendar-table__td--command matches-calendar-table__td--command-home">
                                    <span>Шахтар
                                    </span>
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/shakhtar.png"
                                        alt="">
                                </td>
                                <td class="matches-calendar-table__td--score">
                                    <a href="matches-center.html">_-_</a>
                                </td>
                                <td class=" matches-calendar-table__td--command matches-calendar-table__td--command-away">
                                    <img src="https://fco.com.ua/sites/default/files/styles/small/public/opponent/olexandriya.png"
                                        alt="">
                                    <span class="club-name">Олександрія
                                    </span>
    
                                </td>
                                <td class="matches-calendar-table__td--tournament">
                                    Українська Прем'єр - Ліга
                                </td>
                            </tr>
                        </tbody>
                </table>
            </section>
            
            
        </section>


        <div class="ads-block-top">
            <img src="img/banner/baner_na_sayt.jpg" alt="">
        </div>


    </main>
<? get_footer(); ?>