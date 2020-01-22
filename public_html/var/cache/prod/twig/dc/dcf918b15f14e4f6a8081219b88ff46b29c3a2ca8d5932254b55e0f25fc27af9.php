<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__aef050c62cc4198e291ad77c06be13ca834837b388bcd6ac7edc548e45e8478e */
class __TwigTemplate_765fbb633a2864c8bddf1bb0d52fd12e8f4568fdaca33d9b7608717003350231 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'extra_stylesheets' => [$this, 'block_extra_stylesheets'],
            'content_header' => [$this, 'block_content_header'],
            'content' => [$this, 'block_content'],
            'content_footer' => [$this, 'block_content_footer'],
            'sidebar_right' => [$this, 'block_sidebar_right'],
            'javascripts' => [$this, 'block_javascripts'],
            'extra_javascripts' => [$this, 'block_extra_javascripts'],
            'translate_javascripts' => [$this, 'block_translate_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"pl\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/img/app_icon.png\" />

<title>Moduły • Biznes Elektroniczny</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminModulesManage';
    var iso_user = 'pl';
    var lang_is_rtl = '0';
    var full_language_code = 'pl';
    var full_cldr_language_code = 'pl-PL';
    var country_iso_code = 'PL';
    var _PS_VERSION_ = '1.7.6.1';
    var roundMode = 2;
    var youEditFieldFor = '';
        var new_order_msg = 'Złożono nowe zamówienie w Twoim sklepie.';
    var order_number_msg = 'Numer zamówienia: ';
    var total_msg = 'Razem: ';
    var from_msg = 'Od: ';
    var see_order_msg = 'Zobacz to zamówienie';
    var new_customer_msg = 'Nowy klient zarejestrował się w Twoim sklepie.';
    var customer_name_msg = 'Nazwa klienta: ';
    var new_msg = 'Nowa wiadomość pojawiła się w Twoim sklepie.';
    var see_msg = 'Przeczytaj tą wiadomość';
    var token = '7e6569ff882ce247ce20f356367be5c3';
    var token_admin_orders = 'c8843c9adf503fc28feedd4059a0fbe4';
    var token_admin_customers = '41b96079fe7d56a984cc77f201e2e67d';
    var token_admin_customer_threads = 'c955f385789f382dd04901d3459050a1';
    var currentIndex = 'index.php?controller=AdminModulesManage';
    var employee_token = 'be0d3ce0152655a555d5251d07808882';
    var choose_language_translate = 'Wybierz język';
    var default_language = '1';
    var admin_modules_link = '/admin-zone/index.php/improve/modules/catalog/recommended?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw';
    var admin_notification_get_link = '/admin-zone/index.php/common/notifications?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw';
    var admin_notification_push_link = '/admin-zone/index.php/common/notifications/ack?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw';
    var tab_modules_list = '';
    var update_success_msg = 'Aktualizacja powiodła się';
    var errorLogin = 'PrestaShop nie mógł zalogować się do Dodatków, sprawdź swoje uprawnienia i połączenie internetowe.';
    var search_product_msg = 'Szukaj produktu';
  </script>

      <link href=\"/modules/pmcvg/views/css/back.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/admin-zone/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/admin-zone/themes/default/css/vendor/nv.d3.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/gamification/views/css/gamification.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\/admin-zone\\/\";
var baseDir = \"\\/\";
var changeFormLanguageUrl = \"\\/admin-zone\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\";
var currency = {\"iso_code\":\"PLN\",\"sign\":\"z\\u0142\",\"name\":\"Z\\u0142oty polski\",\"format\":null};
var currency_specifications = {\"symbol\":[\",\",\"\\u00a0\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"PLN\",\"currencySymbol\":\"z\\u0142\",\"positivePattern\":\"#,##0.00\\u00a0\\u00a4\",\"negativePattern\":\"-#,##0.00\\u00a0\\u00a4\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\",\",\"\\u00a0\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var show_new_customers = \"1\";
var show_new_messages = false;
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/modules/ps_faviconnotificationbo/views/js/favico.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_googleanalytics/views/js/GoogleAnalyticActionLib.js\"></script>
<script type=\"text/javascript\" src=\"/admin-zone/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/js/admin.js?v=1.7.6.1\"></script>
<script type=\"text/javascript\" src=\"/admin-zone/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/tools.js?v=1.7.6.1\"></script>
<script type=\"text/javascript\" src=\"/admin-zone/public/bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/vendor/d3.v3.min.js\"></script>
<script type=\"text/javascript\" src=\"/admin-zone/themes/default/js/vendor/nv.d3.min.js\"></script>
<script type=\"text/javascript\" src=\"/modules/gamification/views/js/gamification_bt.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>

  <script type=\"text/javascript\">
/*
 * Return total of notification per checkbox checked
 * @param  int nbNewCustomer
 * @param  int nbNewOrder
 * @param  int nbNewMessage
 * @return int result        Total of Notification
 */
function getNotification(nbNewCustomer, nbNewOrder, nbNewMessage) {
    let result = 0;
    //if radiobutton is checked
     result += nbNewOrder;      result += nbNewCustomer;      result += nbNewMessage; 
    return result;
}

function loadAjax(adminController) {
    \$.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: adminController,
        data: {
            ajax: true,
            action: \"GetNotifications\",
        },

        success: function(data) {

            let nbNewCustomers = parseInt(data.customer.total);
            let nbNewOrders = parseInt(data.order.total);
            let nbNewCustomerMessages = parseInt(data.customer_message.total);

            let nbTotalNotification = getNotification(nbNewCustomers, nbNewOrders, nbNewCustomerMessages);

            favicon.badge(nbTotalNotification);
        },
        error: function(err) {
            console.log(err);
            console.log(adminController);
        },
    });
}

function updateNotifications(type) {
  \$.post(
    baseAdminDir + \"ajax.php\",
    {
      \"updateElementEmployee\": \"1\",
      \"updateElementEmployeeType\": type
    }
  );
}

\$(document).ready(function() {
    adminController = adminController.replace(/\\amp;/g, '');
    //set the configuration of the favicon
    window.favicon = new Favico({
        animation: 'popFade',
        bgColor: BgColor,
        textColor: TxtColor,
    });
    loadAjax(adminController)
    setInterval(function() {
        loadAjax(adminController);
    }, 60000); //refresh notification every 60 seconds

    //update favicon when you click on the customer tab into your backoffice
    \$(document).on('click', '#subtab-AdminCustomers', function (e) {
        updateNotifications('customer');
    });
    //update favicon when you click on the customer service tab into your backoffice
    \$(document).on('click', '#subtab-AdminCustomerThreads', function (e) {
        updateNotifications('customer_message');
    });
    //update favicon when you click on the order tab into your backoffice
    \$(document).on('click', '#subtab-AdminOrders', function (e) {
        updateNotifications('order');
    });
});
</script>

<script type=\"text/javascript\">
    let BgColor = \"#DF0067\";
    let TxtColor = \"#ffffff\";
    let CheckBoxOrder = \"1\";
    let CheckBoxCustomer = \"1\";
    let CheckBoxMessage = \"1\";
    let adminController = \"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminAjaxFaviconBO&amp;token=33124f889211e8087385140ded9c768d\";
</script>

<script>
            var admin_gamification_ajax_url = \"http:\\/\\/bizneselektroniczny.pagedesign.pl\\/admin-zone\\/index.php?controller=AdminGamification&token=2c745888dff722aa94ce523a1955bc86\";
            var current_id_tab = 45;
        </script>
<script type=\"text/javascript\">
\t(window.gaDevIds=window.gaDevIds||[]).push('d6YPbH');
\t(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
\t(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
\tm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
\t})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-156731365-1', 'auto');
                        ga('set', 'nonInteraction', true);
    
    ga('require', 'ec');
</script>

<script>var baimporter_ajax_url = \"/modules/ba_importer/ajax.php\";</script><script>var baimporter_token = \"ccc7f54abb9e2109fb3c584783ea6e174f7f5823\";</script><script>var batoken = \"f49c6505962c94300020694ea71f56f4\";</script><script>var alert_name_setting = \"Name Setting is required\";</script>

";
        // line 190
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>

<body class=\"lang-pl adminmodulesmanage\">

  <header id=\"header\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminDashboard&amp;token=13918cb46afff4c99cb283c75c51bc37\"></a>
      <span id=\"shop_version\">1.7.6.1</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Szybki dostęp
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"
         href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCategories&amp;addcategory&amp;token=acb9804b74cfb07b7e8c4b7cd88b37ff\"
                 data-item=\"Nowa kategoria\"
      >Nowa kategoria</a>
          <a class=\"dropdown-item\"
         href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=338f012408e291dd75583429e86499a6\"
                 data-item=\"Nowy kupon\"
      >Nowy kupon</a>
          <a class=\"dropdown-item\"
         href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php/sell/catalog/products/new?token=4a0ed55003e8448474f2402130b52d1a\"
                 data-item=\"Nowy produkt\"
      >Nowy produkt</a>
          <a class=\"dropdown-item\"
         href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=4052c939445be862e22c6702bf384b67\"
                 data-item=\"Ocena katalogu\"
      >Ocena katalogu</a>
          <a class=\"dropdown-item\"
         href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php/improve/modules/manage?token=4a0ed55003e8448474f2402130b52d1a\"
                 data-item=\"Zainstalowane moduły\"
      >Zainstalowane moduły</a>
          <a class=\"dropdown-item\"
         href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminOrders&amp;token=c8843c9adf503fc28feedd4059a0fbe4\"
                 data-item=\"Zamówienia\"
      >Zamówienia</a>
        <div class=\"dropdown-divider\"></div>
          <a
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"121\"
        data-icon=\"icon-AdminModulesSf\"
        data-method=\"add\"
        data-url=\"index.php/improve/modules/manage?-5Henc927nknKN7XAw\"
        data-post-link=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminQuickAccesses&token=96935d972e55e80e410a5b36ef643850\"
        data-prompt-text=\"Proszę podać nazwę tego skrótu:\"
        data-link=\"Moduły - Lista\"
      >
        <i class=\"material-icons\">add_circle</i>
        Dodaj bieżącą stronę do zakładki
      </a>
        <a class=\"dropdown-item\" href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminQuickAccesses&token=96935d972e55e80e410a5b36ef643850\">
      <i class=\"material-icons\">settings</i>
      Zarządzaj szybkim dostępem
    </a>
  </div>
</div>
      </div>
      <div class=\"component\" id=\"header-search-container\">
        <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/admin-zone/index.php?controller=AdminSearch&amp;token=45c454a30151f7cae2ebc1e0a6597913\"
      role=\"search\">
  <input type=\"hidden\" name=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Szukaj (np.: indeks produktu, nazwa klienta...)\">
    <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Wszędzie
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"Wszędzie\" href=\"#\" data-value=\"0\" data-placeholder=\"Czego szukasz?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> Wszędzie</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Katalog\" href=\"#\" data-value=\"1\" data-placeholder=\"Nazwa produktu, SKU, odniesienie...\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Katalog</a>
        <a class=\"dropdown-item\" data-item=\"Klienci Wg nazwy\" href=\"#\" data-value=\"2\" data-placeholder=\"E-mail, nazwisko...\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Klienci Wg nazwy</a>
        <a class=\"dropdown-item\" data-item=\"Klienci wg adresu IP\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Klienci wg adresu IP</a>
        <a class=\"dropdown-item\" data-item=\"Zamówienia\" href=\"#\" data-value=\"3\" data-placeholder=\"ID zamówienia\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Zamówienia</a>
        <a class=\"dropdown-item\" data-item=\"Faktury\" href=\"#\" data-value=\"4\" data-placeholder=\"Numer faktury\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Faktury</a>
        <a class=\"dropdown-item\" data-item=\"Koszyki\" href=\"#\" data-value=\"5\" data-placeholder=\"ID Koszyka\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopping_cart</i> Koszyki</a>
        <a class=\"dropdown-item\" data-item=\"Moduły\" href=\"#\" data-value=\"7\" data-placeholder=\"Nazwa modułu\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Moduły</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">WYSZUKIWANIE</span><i class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$('#bo_query').one('click', function() {
    \$(this).closest('form').removeClass('collapsed');
  });
});
</script>
      </div>

      
      
      <div class=\"component\" id=\"header-shop-list-container\">
          <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://bizneselektroniczny.pagedesign.pl/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      Zobacz sklep
    </a>
  </div>
      </div>

              <div class=\"component header-right-component\" id=\"header-notifications-container\">
          <div id=\"notif\" class=\"notification-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Zamówienia<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Klienci<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Wiadomości<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Obecnie brak nowych zamówień :(<br>
              Czy sprawdzałeś ostatnio współczynnik konwersji?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Obecnie brak nowych klientów :(<br>
              Czy jesteś aktywny w mediach społecznościowych?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Obecnie brak nowych wiadomości.<br>
              Wydaje się, wszyscy Twoi klienci są zadowoleni :)
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href='order_url'>
      #_id_order_ -
      od <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"notif\" href='customer_url'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - zarejestrowany <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href='message_url'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
        </div>
      
      <div class=\"component\" id=\"header-employee-container\">
        <div class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">
      
      <span class=\"employee_avatar\"><img class=\"avatar rounded-circle\" src=\"http://profile.prestashop.com/tomaszpazik%40gmail.com.jpg\" /></span>
      <span class=\"employee_profile\">Witaj ponownie Tomasz</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin-zone/index.php/configure/advanced/employees/1/edit?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\">
      <i class=\"material-icons\">settings</i>
      Twój profil
    </a>
    </div>
    
    <p class=\"divider\"></p>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/pl/zasoby/dokumentacja\" target=\"_blank\"><i class=\"material-icons\">book</i> Materiały</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/training?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=training-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">school</i> Trening</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/pl/eksperci\" target=\"_blank\"><i class=\"material-icons\">person_pin_circle</i> Znajdź eksperta</a>
    <a class=\"dropdown-item\" href=\"https://addons.prestashop.com/pl/?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=addons-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">extension</i> PrestaShop Marketplace</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/contact?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=help-center-en&amp;utm_content=download17\" target=\"_blank\"><i class=\"material-icons\">help</i> Centrum pomocy</a>
    <p class=\"divider\"></p>
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminLogin&amp;logout=1&amp;token=be5ac9ffb234f83ae84e18d1cf74a43d\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Wyloguj się</span>
    </a>
  </div>
</div>
      </div>
    </nav>

      </header>

  <nav class=\"nav-bar d-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin-zone/index.php/configure/advanced/employees/toggle-navigation?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <ul class=\"main-menu\">

          
                
                
        
          <li class=\"link-levelone \" data-submenu=\"1\" id=\"tab-AdminDashboard\">
            <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminDashboard&amp;token=13918cb46afff4c99cb283c75c51bc37\" class=\"link\" >
              <i class=\"material-icons\">trending_up</i> <span>Pulpit</span>
            </a>
          </li>

        
                
                                  
                
        
          <li class=\"category-title \" data-submenu=\"2\" id=\"tab-SELL\">
              <span class=\"title\">Sprzedaż</span>
          </li>

                          
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminOrders&amp;token=c8843c9adf503fc28feedd4059a0fbe4\" class=\"link\">
                    <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                    <span>
                    Zamówienia
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-3\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminOrders&amp;token=c8843c9adf503fc28feedd4059a0fbe4\" class=\"link\"> Zamówienia
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                              <a href=\"/admin-zone/index.php/sell/orders/invoices/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Faktury
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminSlip&amp;token=1d40641455b42e519aedf315c51a97a7\" class=\"link\"> Druki kredytowe
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                              <a href=\"/admin-zone/index.php/sell/orders/delivery-slips/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Druk wysyłki
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCarts&amp;token=d210e721f48f39b98b11a9e70b9e815e\" class=\"link\"> Koszyki zakupowe
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                  <a href=\"/admin-zone/index.php/sell/catalog/products?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-store\">store</i>
                    <span>
                    Katalog
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                              <a href=\"/admin-zone/index.php/sell/catalog/products?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Produkty
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                              <a href=\"/admin-zone/index.php/sell/catalog/categories?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Kategorie
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminTracking&amp;token=79a045062f08914096e5a046633c69b7\" class=\"link\"> Monitorowanie
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminAttributesGroups&amp;token=57a117d336bf5fa147f75403fa050d84\" class=\"link\"> Atrybuty &amp; Cechy
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                              <a href=\"/admin-zone/index.php/sell/catalog/brands/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Marki &amp; Dostawcy
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminAttachments&amp;token=8868336a76b9678f0fa30eca781fb8ec\" class=\"link\"> Pliki
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCartRules&amp;token=338f012408e291dd75583429e86499a6\" class=\"link\"> Rabaty
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                              <a href=\"/admin-zone/index.php/sell/stocks/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Stocks
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                  <a href=\"/admin-zone/index.php/sell/customers/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-account_circle\">account_circle</i>
                    <span>
                    Klienci
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-24\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"25\" id=\"subtab-AdminCustomers\">
                              <a href=\"/admin-zone/index.php/sell/customers/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Klienci
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminAddresses&amp;token=144b6bea40bae61de4d024e394984965\" class=\"link\"> Adresy
                              </a>
                            </li>

                                                                                                                          </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCustomerThreads&amp;token=c955f385789f382dd04901d3459050a1\" class=\"link\">
                    <i class=\"material-icons mi-chat\">chat</i>
                    <span>
                    Obsługa klienta
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"29\" id=\"subtab-AdminCustomerThreads\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCustomerThreads&amp;token=c955f385789f382dd04901d3459050a1\" class=\"link\"> Obsługa klienta
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminOrderMessage&amp;token=64ccc4ad664895aba1e4e821d0257e39\" class=\"link\"> Wiadomości zamówienia
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminReturn&amp;token=bba47a22d077fe4a1b67ae38ba16dfc0\" class=\"link\"> Zwroty produktów
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminStats&amp;token=4052c939445be862e22c6702bf384b67\" class=\"link\">
                    <i class=\"material-icons mi-assessment\">assessment</i>
                    <span>
                    Statystyki
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                    </li>
                          
        
                
                                  
                
        
          <li class=\"category-title -active\" data-submenu=\"42\" id=\"tab-IMPROVE\">
              <span class=\"title\">Ulepszenia</span>
          </li>

                          
                
                                                
                                                    
                <li class=\"link-levelone has_submenu -active open ul-open\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                  <a href=\"/admin-zone/index.php/improve/modules/manage?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-extension\">extension</i>
                    <span>
                    Moduły
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_up
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-43\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo -active\" data-submenu=\"44\" id=\"subtab-AdminModulesSf\">
                              <a href=\"/admin-zone/index.php/improve/modules/manage?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Module Manager
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminPsMboModule&amp;token=82065a6258d4643e8844b9589a53098d\" class=\"link\"> Katalog
                              </a>
                            </li>

                                                                                                                          </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                  <a href=\"/admin-zone/index.php/improve/design/themes/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                    <span>
                    Wygląd
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-52\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"126\" id=\"subtab-AdminThemesParent\">
                              <a href=\"/admin-zone/index.php/improve/design/themes/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Szablony
                              </a>
                            </li>

                                                                                                                              
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"134\" id=\"subtab-AdminPsMboTheme\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminPsMboTheme&amp;token=742452545a7dd45ee9471e31b95015ec\" class=\"link\"> Katalog
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"55\" id=\"subtab-AdminMailThemeParent\">
                              <a href=\"/admin-zone/index.php/improve/design/mail_theme/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Szablon maila
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                              <a href=\"/admin-zone/index.php/improve/design/cms-pages/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Strony
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                              <a href=\"/admin-zone/index.php/improve/design/modules/positions/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Pozycje
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"59\" id=\"subtab-AdminImages\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminImages&amp;token=596324d5128c19534ef05874f70ebffe\" class=\"link\"> Zdjęcia
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                              <a href=\"/admin-zone/index.php/modules/link-widget/list?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Link Widget
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCarriers&amp;token=7fd1f1d9454964ed858083b5a3a4627e\" class=\"link\">
                    <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                    <span>
                    Wysyłka
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-60\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"61\" id=\"subtab-AdminCarriers\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminCarriers&amp;token=7fd1f1d9454964ed858083b5a3a4627e\" class=\"link\"> Przewoźnicy
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                              <a href=\"/admin-zone/index.php/improve/shipping/preferences?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Preferencje
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                  <a href=\"/admin-zone/index.php/improve/payment/payment_methods?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-payment\">payment</i>
                    <span>
                    Płatność
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-63\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"64\" id=\"subtab-AdminPayment\">
                              <a href=\"/admin-zone/index.php/improve/payment/payment_methods?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Płatności
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                              <a href=\"/admin-zone/index.php/improve/payment/preferences?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Preferencje
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                  <a href=\"/admin-zone/index.php/improve/international/localization/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-language\">language</i>
                    <span>
                    Międzynarodowy
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-66\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"67\" id=\"subtab-AdminParentLocalization\">
                              <a href=\"/admin-zone/index.php/improve/international/localization/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Lokalizacja
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminZones&amp;token=f3e709f857bd934251d65902e650d2ce\" class=\"link\"> Położenie
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                              <a href=\"/admin-zone/index.php/improve/international/taxes/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Podatki
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                              <a href=\"/admin-zone/index.php/improve/international/translations/settings?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Tłumaczenia
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                          
        
                
                                  
                
        
          <li class=\"category-title \" data-submenu=\"80\" id=\"tab-CONFIGURE\">
              <span class=\"title\">Konfiguruj</span>
          </li>

                          
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                  <a href=\"/admin-zone/index.php/configure/shop/preferences/preferences?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-settings\">settings</i>
                    <span>
                    Preferencje
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-81\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"82\" id=\"subtab-AdminParentPreferences\">
                              <a href=\"/admin-zone/index.php/configure/shop/preferences/preferences?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Ogólny
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                              <a href=\"/admin-zone/index.php/configure/shop/order-preferences/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Zamówienia
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                              <a href=\"/admin-zone/index.php/configure/shop/product-preferences/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Produkty
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                              <a href=\"/admin-zone/index.php/configure/shop/customer-preferences/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Klienci
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                              <a href=\"/admin-zone/index.php/configure/shop/contacts/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Kontakt
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                              <a href=\"/admin-zone/index.php/configure/shop/seo-urls/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Ruch
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminSearchConf&amp;token=57cc1e7230cdf84e7e65d966670f04ad\" class=\"link\"> Szukaj
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"130\" id=\"subtab-AdminGamification\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminGamification&amp;token=2c745888dff722aa94ce523a1955bc86\" class=\"link\"> Merchant Expertise
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                  <a href=\"/admin-zone/index.php/configure/advanced/system-information/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\">
                    <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                    <span>
                    Zaawansowane
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-103\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"104\" id=\"subtab-AdminInformation\">
                              <a href=\"/admin-zone/index.php/configure/advanced/system-information/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Informacja
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                              <a href=\"/admin-zone/index.php/configure/advanced/performance/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Wydajność
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                              <a href=\"/admin-zone/index.php/configure/advanced/administration/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Administracja
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                              <a href=\"/admin-zone/index.php/configure/advanced/emails/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Adres e-mail
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"108\" id=\"subtab-AdminImport\">
                              <a href=\"/admin-zone/index.php/configure/advanced/import/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Importuj
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                              <a href=\"/admin-zone/index.php/configure/advanced/employees/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Zespół
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                              <a href=\"/admin-zone/index.php/configure/advanced/sql-requests/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Baza danych
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                              <a href=\"/admin-zone/index.php/configure/advanced/logs/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> Logi
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                              <a href=\"/admin-zone/index.php/configure/advanced/webservice-keys/?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" class=\"link\"> API
                              </a>
                            </li>

                                                                                                                                                                            </ul>
                                    </li>
                          
        
                
                                  
                
        
          <li class=\"category-title \" data-submenu=\"136\" id=\"tab-JMS-MODULES\">
              <span class=\"title\">Jms Modules</span>
          </li>

                          
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"137\" id=\"subtab-AdminJmsmegamenuDashboard\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsmegamenuManager&amp;token=8963cd2c59e05504aa1cf9709c21a1e1\" class=\"link\">
                    <i class=\"material-icons mi-menu\">menu</i>
                    <span>
                    Jms MegaMenu
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-137\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"138\" id=\"subtab-AdminJmsmegamenuManager\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsmegamenuManager&amp;token=8963cd2c59e05504aa1cf9709c21a1e1\" class=\"link\"> Menu Manager
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"139\" id=\"subtab-AdminJmsmegamenuStyle\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsmegamenuStyle&amp;token=ee5acd46c8072599956a102fd91f4cb2\" class=\"link\"> Menu Style
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"140\" id=\"subtab-AdminJmsvermegamenuDashboard\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsvermegamenuManager&amp;token=1f50e844b029c573de9e7e1994c1857b\" class=\"link\">
                    <i class=\"material-icons mi-menu\">menu</i>
                    <span>
                    Jms Vertical MegaMenu
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-140\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"141\" id=\"subtab-AdminJmsvermegamenuManager\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsvermegamenuManager&amp;token=1f50e844b029c573de9e7e1994c1857b\" class=\"link\"> Menu Manager
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"142\" id=\"subtab-AdminJmsvermegamenuStyle\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsvermegamenuStyle&amp;token=6dd434fb4688a81ea52894e463b177d9\" class=\"link\"> Menu Style
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"143\" id=\"subtab-AdminJmsblogDashboard\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsblogCategories&amp;token=e6758794320bee86791a2c37a0702ffa\" class=\"link\">
                    <i class=\"material-icons mi-\"></i>
                    <span>
                    Jms Blog
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-143\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"144\" id=\"subtab-AdminJmsblogCategories\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsblogCategories&amp;token=e6758794320bee86791a2c37a0702ffa\" class=\"link\"> Kategorie
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"145\" id=\"subtab-AdminJmsblogPost\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsblogPost&amp;token=fbc2c8e9cf2518a36f666f01edf75dc8\" class=\"link\"> Post
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"146\" id=\"subtab-AdminJmsblogComment\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsblogComment&amp;token=341dc78e18fafdf5aa5bf13035e823fd\" class=\"link\"> Comments
                              </a>
                            </li>

                                                                            
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"147\" id=\"subtab-AdminJmsblogSetting\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmsblogSetting&amp;token=36f29445fb98443310a93086ff8e2a6c\" class=\"link\"> Setting
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone has_submenu\" data-submenu=\"148\" id=\"subtab-AdminJmspagebuilderDashboard\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmspagebuilderHomepages&amp;token=eeb02335b2a82e0c993fcb84ac501a01\" class=\"link\">
                    <i class=\"material-icons mi-\"></i>
                    <span>
                    Jms Page Builder
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                          <ul id=\"collapse-148\" class=\"submenu panel-collapse\">
                                                  
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"149\" id=\"subtab-AdminJmspagebuilderHomepages\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmspagebuilderHomepages&amp;token=eeb02335b2a82e0c993fcb84ac501a01\" class=\"link\"> Home Pages
                              </a>
                            </li>

                                                                                                                              
                            
                                                        
                            <li class=\"link-leveltwo \" data-submenu=\"151\" id=\"subtab-AdminJmspagebuilderSetting\">
                              <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminJmspagebuilderSetting&amp;token=2e25df1517b054ae6813423133163238\" class=\"link\"> Setting
                              </a>
                            </li>

                                                                        </ul>
                                    </li>
                          
        
                
                                  
                
        
          <li class=\"category-title \" data-submenu=\"153\" id=\"tab-AdminConditions\">
              <span class=\"title\">Zarządzanie prywatnością</span>
          </li>

                          
                
                                                
                
                <li class=\"link-levelone\" data-submenu=\"154\" id=\"subtab-AdminConditions\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminConditions&amp;token=8cfa6fab82beb703abfbc7cfbbae793e\" class=\"link\">
                    <i class=\"material-icons mi-extension\">extension</i>
                    <span>
                    Treść zgód
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone\" data-submenu=\"155\" id=\"subtab-AdminNotification\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminNotification&amp;token=525dc8ca8a70e6fbffea9b6efdd21db5\" class=\"link\">
                    <i class=\"material-icons mi-extension\">extension</i>
                    <span>
                    Zgłoszenia
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone\" data-submenu=\"156\" id=\"subtab-AdminHistory\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminHistory&amp;token=ba476ee11ff276a06c05f1c0356ad1b3\" class=\"link\">
                    <i class=\"material-icons mi-extension\">extension</i>
                    <span>
                    Zmiany
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                    </li>
                                        
                
                                                
                
                <li class=\"link-levelone\" data-submenu=\"157\" id=\"subtab-AdminRemove\">
                  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminRemove&amp;token=c587f860e4b5a7523c9f5b8ec49956ff\" class=\"link\">
                    <i class=\"material-icons mi-extension\">extension</i>
                    <span>
                    Usuwanie klientów ręcznie
                    </span>
                                                <i class=\"material-icons sub-tabs-arrow\">
                                                                keyboard_arrow_down
                                                        </i>
                                        </a>
                                    </li>
                          
        
            </ul>
  
</nav>

<div id=\"main-div\">
          
<div class=\"header-toolbar\">
  <div class=\"container-fluid\">

    
      <nav aria-label=\"Breadcrumb\">
        <ol class=\"breadcrumb\">
                      <li class=\"breadcrumb-item\">Module Manager</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/admin-zone/index.php/improve/modules/manage?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" aria-current=\"page\">Moduły</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Moduły          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
             

<script>
    
    var isSymfonyContext = true;
    var admin_module_ajax_url_psmbo = 'http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminPsMboModule&token=82065a6258d4643e8844b9589a53098d';
    var controller = 'AdminModulesManage';
    
    if (isSymfonyContext === false) {
        
        \$(document).ready(function() {
            
            \$('.process-icon-modules-list').parent('a').prop('href', admin_module_ajax_url_psmbo);
            
            \$('.fancybox-quick-view').fancybox({
                type: 'ajax',
                autoDimensions: false,
                autoSize: false,
                width: 600,
                height: 'auto',
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
        });
    }
\t
\t\$(document).on('click', '#page-header-desc-configuration-modules-list', function(event) {
\t\tevent.preventDefault();
\t\topenModalOrRedirect(isSymfonyContext);
\t});
\t
\t\$('.process-icon-modules-list').parent('a').unbind().bind('click', function (event) {
\t\tevent.preventDefault();
\t\topenModalOrRedirect(isSymfonyContext);
\t});
    
    function openModalOrRedirect(isSymfonyContext) {
        if (isSymfonyContext === false) {
            \$('#modules_list_container').modal('show');
            openModulesList();
        } else {
            window.location.href = admin_module_ajax_url_psmbo;
        }
    }
\t
    function openModulesList() {
        \$.ajax({
            type: 'POST',
            url: admin_module_ajax_url_psmbo,
            data: {
                ajax : true,
                action : 'GetTabModulesList',
                controllerName: controller
            },
            success : function(data) {
                \$('#modules_list_container_tab_modal').html(data).slideDown();
                \$('#modules_list_loader').hide();
            },
        });
    }
\t
\t
</script>

                                                          <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-add_module\"
                  href=\"#\"                  title=\"Załaduj moduł\"                  data-toggle=\"pstooltip\"
                  data-placement=\"bottom\"                >
                  <i class=\"material-icons\">cloud_upload</i>                  Załaduj moduł
                </a>
                                                                        <a
                  class=\"btn btn-primary  pointer\"                  id=\"page-header-desc-configuration-addons_connect\"
                  href=\"#\"                  title=\"Połącz z Addons marketplace\"                  data-toggle=\"pstooltip\"
                  data-placement=\"bottom\"                >
                  <i class=\"material-icons\">vpn_key</i>                  Połącz z Addons marketplace
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Pomoc\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin-zone/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fpl%252Fdoc%252FAdminModules%253Fversion%253D1.7.6.1%2526country%253Dpl/Pomoc?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\"
                   id=\"product_form_open_help\"
                >
                  Pomoc
                </a>
                                    </div>
        </div>
      
    </div>
  </div>

  
      <div class=\"page-head-tabs\" id=\"head_tabs\">
      <ul class=\"nav nav-pills\">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <li class=\"nav-item\">
                    <a href=\"/admin-zone/index.php/improve/modules/manage?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" id=\"subtab-AdminModulesManage\" class=\"nav-link tab active current\" data-submenu=\"45\">
                      Moduły
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"/admin-zone/index.php/improve/modules/alerts?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" id=\"subtab-AdminModulesNotifications\" class=\"nav-link tab \" data-submenu=\"46\">
                      Powiadomienia
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"/admin-zone/index.php/improve/modules/updates?_token=WEamrGMsyL9j7ZvzEZg48cexd-5Henc927nknKN7XAw\" id=\"subtab-AdminModulesUpdates\" class=\"nav-link tab \" data-submenu=\"47\">
                      Aktualizacje
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              </ul>
    </div>
    
</div>
      
      <div class=\"content-div  with-tabs\">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1500
        $this->displayBlock('content_header', $context, $blocks);
        // line 1501
        echo "                 ";
        $this->displayBlock('content', $context, $blocks);
        // line 1502
        echo "                 ";
        $this->displayBlock('content_footer', $context, $blocks);
        // line 1503
        echo "                 ";
        $this->displayBlock('sidebar_right', $context, $blocks);
        // line 1504
        echo "
             
<div class=\"modal fade\" id=\"modules_list_container\">
\t<div class=\"modal-dialog\">
\t\t<div class=\"modal-content\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
\t\t\t\t<h3 class=\"modal-title\">Zalecane moduły i usługi</h3>
\t\t\t</div>
\t\t\t<div class=\"modal-body\">
\t\t\t\t<div id=\"modules_list_container_tab_modal\" style=\"display:none;\"></div>
\t\t\t\t<div id=\"modules_list_loader\"><i class=\"icon-refresh icon-spin\"></i></div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
          </div>
        </div>

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>O nie!</h1>
  <p class=\"mt-3\">
    Wersja mobilna tej strony nie jest jeszcze dostępna.
  </p>
  <p class=\"mt-2\">
    Prosimy korzystać z komputera stacjonarnego, aby uzyskać dostęp do tej strony, dopóki nie zostanie zoptymalizowana pod kątem urządzeń mobilnych.
  </p>
  <p class=\"mt-2\">
    Dziękujemy.
  </p>
  <a href=\"http://bizneselektroniczny.pagedesign.pl/admin-zone/index.php?controller=AdminDashboard&amp;token=13918cb46afff4c99cb283c75c51bc37\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons\">arrow_back</i>
    Wstecz
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  

      <div class=\"bootstrap\">
      <div class=\"modal fade\" id=\"modal_addons_connect\" tabindex=\"-1\">
\t<div class=\"modal-dialog modal-md\">
\t\t<div class=\"modal-content\">
\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\"><i class=\"icon-puzzle-piece\"></i> <a target=\"_blank\" href=\"https://addons.prestashop.com/?utm_source=back-office&utm_medium=modules&utm_campaign=back-office-PL&utm_content=download\">PrestaShop Addons</a></h4>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t<!--start addons login-->
\t\t\t<form id=\"addons_login_form\" method=\"post\" >
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://addons.prestashop.com/pl/login?email=tomaszpazik%40gmail.com&amp;firstname=Tomasz&amp;lastname=Pazik&amp;website=http%3A%2F%2Fbizneselektroniczny.pagedesign.pl%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-PL&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/admin-zone/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
\t\t\t\t\t<h3 class=\"text-center\">Połącz swój sklep z rynkiem PrestaShop, żeby automatycznie importować wszystkie zakupione dodatki.</h3>
\t\t\t\t\t<hr />
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Nie masz konta ?</h4>
\t\t\t\t\t\t<p class='text-justify'>Odkryj siłę PrestaShop Addons! Przeglądaj Oficjalny Rynek PrestaShop i znajdź ponad 3500 innowacyjnych modułów i szablonów, które optymalizują stopnie konwersji, zwiększają ruch, budują lojalność klientów i zwiększają Twoją produktywność</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Połącz się z PrestaShop Addons</h4>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-user\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"username_addons\" name=\"username_addons\" type=\"text\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-key\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"password_addons\" name=\"password_addons\" type=\"password\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<a class=\"btn btn-link float-right _blank\" href=\"//addons.prestashop.com/pl/forgot-your-password\">Zapomniałem hasła</a>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"row row-padding-top\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/pl/login?email=tomaszpazik%40gmail.com&amp;firstname=Tomasz&amp;lastname=Pazik&amp;website=http%3A%2F%2Fbizneselektroniczny.pagedesign.pl%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-PL&amp;utm_content=download#createnow\">
\t\t\t\t\t\t\t\tUtwórz konto
\t\t\t\t\t\t\t\t<i class=\"icon-external-link\"></i>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<button id=\"addons_login_button\" class=\"btn btn-primary btn-block btn-lg\" type=\"submit\">
\t\t\t\t\t\t\t\t<i class=\"icon-unlock\"></i> Zaloguj się
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"addons_loading\" class=\"help-block\"></div>

\t\t\t</form>
\t\t\t<!--end addons login-->
\t\t\t</div>


\t\t\t\t\t</div>
\t</div>
</div>

    </div>
  
";
        // line 1625
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>
</html>";
    }

    // line 190
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1500
    public function block_content_header($context, array $blocks = [])
    {
    }

    // line 1501
    public function block_content($context, array $blocks = [])
    {
    }

    // line 1502
    public function block_content_footer($context, array $blocks = [])
    {
    }

    // line 1503
    public function block_sidebar_right($context, array $blocks = [])
    {
    }

    // line 1625
    public function block_javascripts($context, array $blocks = [])
    {
    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "__string_template__aef050c62cc4198e291ad77c06be13ca834837b388bcd6ac7edc548e45e8478e";
    }

    public function getDebugInfo()
    {
        return array (  1715 => 1625,  1710 => 1503,  1705 => 1502,  1700 => 1501,  1695 => 1500,  1686 => 190,  1678 => 1625,  1555 => 1504,  1552 => 1503,  1549 => 1502,  1546 => 1501,  1544 => 1500,  230 => 190,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__aef050c62cc4198e291ad77c06be13ca834837b388bcd6ac7edc548e45e8478e", "");
    }
}
