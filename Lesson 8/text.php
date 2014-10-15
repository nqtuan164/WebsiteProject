<?php
//$page_id = the_ID(); 
if ( !session_id() ) session_start();

 if(!isset($_SESSION['lang']))
			{
				// echo '1';
				 $lang = substr(get_bloginfo ( 'language' ), 0, 2);
				 $_SESSION['lang'] = $lang;
			}
			else
			{  if(isset($_GET['lang'])<>""){ $_SESSION['lang'] = $_GET['lang'];}
			
			        $lang = $_SESSION['lang'];
					$ds_lang = explode('/',$lang);
					$lang = $ds_lang[0]; 
					$_SESSION['lang'] = $lang;     
			}
			
require_once('define_'. $_SESSION['lang'].'.php');

if(is_page(308))  {
	global $post_id,$lng,$lat,$THAContents;

	$post_id = myIsNum_f($_GET['post']);
	if(empty($post_id)) {
		$post_id = myIsNum_f($_GET['p']);
	}
	$lng = get_post_meta($post_id,'bukkenkeido',true);
	$lat = get_post_meta($post_id,'bukkenido',true);

	if(isset($_COOKIE['histories'])==true)
	{
		$post_array2 = '|'.$_COOKIE['histories']; 
		$mangexp = explode('|',$_COOKIE['histories']);
		if(!in_array($post_id,$mangexp))
		{
			$post_array = $post_id.$post_array2; 
			setcookie('histories', $post_array , time()+3600*24*30,'/');
		} 
	} else {
		$post_array = $post_id;
		setcookie('histories', $post_array , time()+3600*24*24*30,'/');
	}

		//echo $_COOKIE['histories'];


	/*$meta_descrption=""; 
	$meta_descrption = $meta_descrption.get_the_title($post_id);

	$type_property             =  get_post_meta($post_id, 'bukkenshubetsu', true);
	if($type_property == '1101')
	{
		$meta_descrption       = $meta_descrption.' , サービスアパート（Service apartment)';
	}
	else if($type_property == '1102')
	{
		$meta_descrption       = $meta_descrption.' , アパート（Apartment)';
	}
	else if($type_property == '1103')
	{
		$meta_descrption      = $meta_descrption.' , 戸建て（Villa)';
	}
	else if($type_property == '1104')
	{
		$meta_descrption     = $meta_descrption.' , オフィス office';
	}
	else if($type_property == '1105')
	{
		$meta_descrption    = $meta_descrption.' , 店舗 store';
	}
	else{
		$meta_descrption     = $meta_descrption.' , レンタルオフィス rental office';
	}*/
	$THAContents = get_post($post_id); 
	if(get_post_data_langues($THAContents->post_title) == '') { 
		header('Location:'. home_url()); exit(); 
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    $lang = $_SESSION['lang'];
	if($lang == 'en'){ $dk = 'bukken_tag_en';}
	else if($lang == 'vi'){ $dk ='bukken_tag_vn';}
	else { $dk ='bukken_tag'; }
	
	$SQL = "SELECT *  FROM   `wp_terms` AS B ,`wp_term_taxonomy` as C , `wp_term_relationships` AS A
 								  WHERE  C.`term_id` = B.`term_id` AND A.`term_taxonomy_id` = C.`term_taxonomy_id`
       							  AND    C.taxonomy = '".$dk."'  AND  A.`object_id` = ".$post_id;
			 
	$ds_tag_apartment  = $wpdb->get_results($SQL);
												//print_r($ds_tag_apartment);
if(count($ds_tag_apartment) >  0)
{
	$name = array();
	foreach($ds_tag_apartment as $row_apart)
	{
		$row_apart->name;
		$name[] = $row_apart->name;
	} 	
	$tags_keyword = implode(',',$name);
} else {
	
	if (  function_exists( 'get_the_title' ) ):
		$tags_keyword =	get_bloginfo('name') .','. get_the_title();
	else :
		$tags_keyword =	get_bloginfo('name') ;
	endif;
} 	

?> 

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-49425450-1']);
  _gaq.push(['_setDomainName', 'creation2010.jp']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-44575133-1', 'creation2010.jp');
	  ga('send', 'pageview');
</script>
<script>
	var docCookies = {
          getItem: function (sKey) {
            if (!sKey) { return null; }
            return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
          },
          setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
            if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
            // var sExpires = "";
            // if (vEnd) {
            //   switch (vEnd.constructor) {
            //     case Number:
            //       sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
            //       break;
            //     case String:
            //       sExpires = "; expires=" + vEnd;
            //       break;
            //     case Date:
            //       sExpires = "; expires=" + vEnd.toUTCString();
            //       break;
            //   }
            // }
            var d = new Date();
            d.setTime(d.getTime() + (vEnd*24*60*60*1000));
            var sExpires = "; expires="+d.toUTCString();

            document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
            return true;
          },
          removeItem: function (sKey, sPath, sDomain) {
            if (!this.hasItem(sKey)) { return false; }
            document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
            return true;
          },
          hasItem: function (sKey) {
            if (!sKey) { return false; }
            return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
          },
          keys: function () {
            var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
            for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) { aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]); }
            return aKeys;
          }
        };

        
        
        
        //var mobile = 
        //console.log(mobile);

        var url = window.location.href;
        
        if (screen.width <= 800) {
            if (!docCookies.hasItem('mobile')) {
                docCookies.setItem('mobile', 'true', 1);
                window.location.href = "http://creation2010.jp/m/";
            } else if (docCookies.hasItem('mobile') && docCookies.getItem('mobile') == "true") {
                window.location.href = "http://creation2010.jp/m/";
            } /*else if (docCookies.hasItem('mobile') && docCookies.getItem('mobile') == "false") {
                window.location.href = "http://creation2010.jp";
            }*/
        }
        console.log(docCookies.getItem('mobile'));
</script>

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="keywords" content="<?php echo $tags_keyword;?>" />
<?php if(!is_page(308) ) { ?>
<?php $meta_descrption = is_home() ? get_bloginfo('name') : get_the_title() ; ?>
<meta name="description" content="<?php echo $meta_descrption. " | ベトナム、ホーチミンやハノイの賃貸サービスアパート、賃貸オフィス、店舗物件、工業団地 は不動産のクリエイション"; ?>" />

<title><?php echo $meta_descrption. " | ベトナム、ホーチミンやハノイの賃貸サービスアパート、賃貸オフィス、店舗物件、工業団地 は不動産のクリエイション"; ?></title>

<?php } else { ?>


<?php  $follow_title = get_post_data_langues($THAContents->post_title); ?>
<!--<meta name="keywords" content="<?php //echo replace_note_langue($follow_title)." | ベトナム、ホーチミンやハノイの賃貸サービスアパート、賃貸オフィス、店舗物件、工業団地 は不動産のクリエイション"; ?>" />
--><meta name="description" content="<?php echo replace_note_langue($follow_title)." | ベトナム、ホーチミンやハノイの賃貸サービスアパート、賃貸オフィス、店舗物件、工業団地 は不動産のクリエイション"; ?>" />
<title><?php echo replace_note_langue($follow_title) ;?> | ベトナム賃貸のクリエイション </title>

<?php } ?>
<link href="<?php bloginfo('stylesheet_url' ); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css.css" />

<?php if(!is_page(308) )  { ?>

<script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>

<?php } else { ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/galleriffic-3.css" type="text/css" />

<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/pngfix.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/jquery.history.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/jquery.galleriffic.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/jquery.opacityrollover.js"></script>

<!-- We only want the thunbnails to display when javascript is disabled -->
<!--<script type="text/javascript">
	document.write('<style type="text/css">.noscript { display: none; }</style>');
</script>-->
<style type="text/css">.noscript { display: none; }</style>
<?php } ?>
<script src="<?php bloginfo('home');?>/wp-content/plugins/slideshow-gallery/js/gallery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/java.js"></script>

<style type="text/css">
#ttop {
      width: 50px; height: 50px;
      position: fixed; bottom: 10px; right: 45px;
      text-indent: -99999px;
      cursor: pointer;
      background: url(<?php echo get_bloginfo( 'template_url' );?>/back-to-top_r4_c4.png) no-repeat 0 0;
}
#fudo_top_r-2 h3
{
	display:none;
}
.side_bg_03
{
	display:none;
}
.side_bg_04{ display:none;}
.side_bg_05{display:none;}
.side_bg_06 { display:none;}
.fudo_tag-2{display:none;}

#fudo_tag-2
{
	display:none;
}
.img5 img
{
	width:60px;
	height:auto;
}
</style>	
<link href="<?php echo  get_site_url(); ?>/wp-content/themes/creation/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-44575133-1', 'creation2010.jp');
	  ga('send', 'pageview');
</script>
</head>
<body>
<div id="header">
        <div class="header1">
        <div  class="div_center_content">
        <div id="logo">
        	<!-- <div class="seo_h1"> ベトナムのアパート不動産情報＆ライフサポートサイト </div> -->
            <a href="<?php bloginfo('home');?>"><img title="logo_creation" src="<?php echo bloginfo('template_directory');?>/imgs/creation_logo.png" alt="logo creation" /></a>
        </div>
         <div class="phone_contact" style="width:554px">
       
        <div style="float:left;margin-top: 15px;">
          <div class="textchu_top1" style="margin-top:10px;"><h1  style="font-size:14px;width: 444px;margin-left: -100px;" > 
		  <?php 
		   
		 // echo 'define_'. $_SESSION['lang'] .'.php';
		
		   $hien = 1;
		   if( is_single() || is_page() )  { 
		  	$IDp=$post->ID;
			if(isset($_GET['post'])) $IDp = $_GET['post'];
			     
				
			  	$Hone =  get_post_meta( $IDp, 'Hone', true );
			   // echo 'AAAAAAAAAAAAA'.$Hone;
			   if($Hone == "<!--:en--><!--:--><!--:vi--><!--:--><!--:ja--><!--:-->")
				{
					// echo 'AAA';
					 $hien = 1;
				}
				else
				{
					//echo 'BBB';
				   $Hone =  explode('<!--:-->',get_post_meta( $IDp, 'Hone', true ));
					$hien = 0;
					if($lang == 'en'){
					echo $Hone[0];  if( $Hone[0]==""){$hien =1 ;}}
					else if($lang == 'vi'){ echo $Hone[1];  if( $Hone[1]==""){$hien =1 ;} }
					else { echo  $Hone[2];   if( $Hone[2]==""){$hien =1 ;}}
					
				}
				if($hien == 1)
				{   if($lang == "ja")
					{
						echo 'Creationはベトナム・ホーチミン市ハノイ市の不動産専門業者です。<br />ベトナム在住歴の長い担当者が最適な物件をご案内致します'; 
					}
					else if($lang == "en")
					{
						echo 'Creationはベトナム・ホーチミン市ハノイ市の不動産専門業者です。<br />ベトナム在住歴の長い担当者が最適な物件をご案内致します';
					}
					else
					{
						echo 'Creationはベトナム・ホーチミン市ハノイ市の不動産専門業者です。<br />ベトナム在住歴の長い担当者が最適な物件をご案内致します';
					}
				}
           } 
		   		else 
		   {if($lang == "ja")
					{
						echo 'Creationはベトナム・ホーチミン市ハノイ市の不動産専門業者です。<br />ベトナム在住歴の長い担当者が最適な物件をご案内致します'; 
					}
					else if($lang == "en")
					{
						echo 'Creationはベトナム・ホーチミン市ハノイ市の不動産専門業者です。<br />ベトナム在住歴の長い担当者が最適な物件をご案内致します';
					}
					else
					{
						echo 'Creationはベトナム・ホーチミン市ハノイ市の不動産専門業者です。<br />ベトナム在住歴の長い担当者が最適な物件をご案内致します';
					} 
		   }?></h1>
           </div>
           <?php
		   if($hien == 1)
		   {
		    ?>
           
            <?php
		   }
		  ?>
        </div>
        <?php 
			$htg1_link = $_SERVER['REQUEST_URI'];
			$htg1_link = str_replace('?lang=en',"",$htg1_link);
			$htg1_link = str_replace('&lang=en',"",$htg1_link);
			$htg1_link = str_replace('?lang=vi',"",$htg1_link);
			$htg1_link = str_replace('&lang=vi',"",$htg1_link);
			$htg1_link = str_replace('?lang=ja',"",$htg1_link);
			$htg1_link = str_replace('&lang=ja',"",$htg1_link);
			$htg1_link = str_replace("&","&amp;",$htg1_link);
		
		?>
        
        <div style="float:right;margin-top: 17px;margin-left: 7px;">
        	<a href="<?php
			  if(strpos($htg1_link,'?') == "") { echo $htg1_link.'?lang=en' ; }
			  else{echo $htg1_link.'&amp;lang=en' ;} ?>"><img src="<?php echo bloginfo('template_directory');?>/imgs/co_anh.png" alt="co_viet_creation" /></a>
        </div>
        <div style="float:right;margin-top: 17px;margin-left: 7px;">
        	<a href="<?php if(strpos($htg1_link,'?') == "") { echo $htg1_link.'?lang=vi' ; }
			               else{ echo $htg1_link.'&amp;lang=vi' ; } ?>" ><img src="<?php echo bloginfo('template_directory');?>/imgs/co_viet.png" alt="co_viet" /></a>
        </div>
        <div style="float: right;margin-top: 16px;">
            <a href="<?php  if(strpos($htg1_link,'?') == "") { echo $htg1_link.'?lang=ja' ; } else{echo $htg1_link.'&amp;lang=ja' ;} ?>" >
            <img src="<?php echo bloginfo('template_directory');?>/imgs/co_japan.png" alt="co_japan" /></a>
        </div>
       <div style="float:right;margin: 5px 0 10px 0;">
            <img src="<?php echo bloginfo('template_directory');?>/imgs/banner_top.png" width="194" height="44" alt="banner_top"> </div>
       
        </div>
        
        </div>
     
       
        </div>
        <div class="clear"></div>
    
    </div>
 <div id="menu-menutop" style="background:url(<?php echo bloginfo('template_directory');?>/imgs/header/bg_menu.png);">
          <div  class="div_center_content" style="width:992px; ">
            
		<?php if($lang=='ja') { wp_nav_menu(array('menu'=>'Menutop')); 
			} else if($lang=='en') {
                 wp_nav_menu(array('menu'=>'MenuEnglish')); 
			} else {  wp_nav_menu(array('menu'=>'MenuVIETNAM'));  } 
		?> 
                </div>
          </div>
      <div class="clear"></div>      
<div id="contentner">
	
   
    <div id="content">
<div id="col_left">