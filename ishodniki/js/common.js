
$(document).ready(function(){
    // $('#owl_first').owlCarousel({
    //     margin:1,
    //     loop:true,
    //     autoWidth:true,
    //     items:2,
    //     autoplay:true,
    //     autoplaySpeed: 1000,
    //     autoplayTimeout:4000,
    //     autoplayHoverPause:true
    // });

    


    // Скрытие/отображение меню для моб. версии
    var $toggleButton = $('.toggle-button'),
    	$menuWrap = $('.menu-wrap'),
    	$sidebarArrow = $('.sidebar-menu-arrow');

	// Hamburger button

	$toggleButton.on('click', function() {
		$(this).toggleClass('button-open');
        $menuWrap.toggleClass('menu-show');
        
    });
    
	// Sidebar navigation arrows
	$sidebarArrow.click(function() {
        $sidebarArrow.not(this).next().hide(300);
        $(this).next().slideToggle(300);
    });
    
    // Отображение полной исторической справки
    $('.meta-more p').on('click', function() {
		$(this).parents().find('.history-article').toggleClass('hist-open');
		$(this).toggleClass('meta-more-active');
		// $(this).css('display', 'inline-block');;
    });

    //Скрытые/отображение списка игроков в виджете на странице Команда
    $playersList = $('h3.widget-body-players-list-title');
    $playersList.click(function() {
        $playersList.not(this).next().hide(300);
        $(this).next().slideToggle(300);
        $playersList.not(this).removeClass('special');
        $(this).toggleClass('special');
    });

    //Отображение подсказки при клике по-достижениям игрока
    $playerItem = $('.team-single-subheader-middle div');
    $playerItem.click(function() {
        $(this).find('span').toggleClass('opacity_none');
        $playerItem.not(this).find('span').removeClass('opacity_none');
    });

    // Плавный переход между разделами сайта при клике на пункты меню
    $("#menu").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });

    
    // Кнпка "Наверх" с появлением
    var top_show = 550; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
    var delay = 1000; // Задержка прокрутки
    $(document).ready(function() {
        $(window).scroll(function () { // При прокрутке попадаем в эту функцию
        /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
        if ($(this).scrollTop() > top_show) $('#back-top').fadeIn();
        else $('#back-top').fadeOut();
        });
        $('#back-top').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
        /* Плавная прокрутка наверх */
        $('body, html').animate({
            scrollTop: 0
        }, delay);
        });
    });

    //Переход между табами на странице с протоколом матча с сохраненим активного таба при перезагрузке страницы
    $(function() {

        $('ul.tabs__caption').each(function(i) {
            var storage = localStorage.getItem('tab' + i);
            if (storage) {
                $(this).find('li').removeClass('active').eq(storage).addClass('active')
                    .closest('div.tabs').find('div.tabs__content').removeClass('active').eq(storage).addClass('active');
            }
        });
    
        $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
            var ulIndex = $('ul.tabs__caption').index($(this).parents('ul.tabs__caption'));
            localStorage.removeItem('tab' + ulIndex);
            localStorage.setItem('tab' + ulIndex, $(this).index());
        });
    
    });
   
  });

  