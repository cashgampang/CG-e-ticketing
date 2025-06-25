	/* Matomo */

/*	var _paq = window._paq = window._paq || [];
	   tracker methods like "setCustomDimension" should be called before "trackPageView" 
	  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	  (function() {
	    var u="https://useranalytics1.trade.gov.in/";
	    _paq.push(['setTrackerUrl', u+'matomo.php']);
	    _paq.push(['setSiteId', '1']);
	    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
	    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
	  })();
	*/



/* Matomo */
function matomo(){
var _paq = window._paq = window._paq || [];
/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
_paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
  var u="https://useranalytics.trade.gov.in/";
  _paq.push(['setTrackerUrl', u+'matomo.php']);
  _paq.push(['setSiteId', '1']);
  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
  g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
})();
}
function sourceFromIndiaBreadcrumb(){
	$('title').html('Source from India');
	$('.template-title').html('Source from India');
	$('.template-desc').html('India makes for the world! Find verified information on Indian exporters to source from India.');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Exporter_showcase_img.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function productGuideBreadcrumb(){
	$('title').html('Product Guide');
	$('.template-title').html('Product Guide');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Product_guide_img.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	$('.template-desc').html('Product guide provides detailed information about global demand, international standards, foreign buyer information and opportunities for your product.');
	matomo();
}

function eximPaathshaalaBreadcrumb(){
	$('title').html('EXIM Paathshaala');
	$('.template-title').html('EXIM Paathshaala');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/exim_paathshaala.webp';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	$('.template-desc').html('Access comprehensive resources and training on exporting from India to international markets. Get certified in international trade via EXIM Paathshaala.');
	matomo();
}

function eximDetailsScreenBreadcrumb(){
	$('title').html('EXIM Paathsaala');
	$('.template-title').html($("#courseName").html());
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/exim_paathshaala.webp';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	$('.template-desc').html($("#courseDescription").html());
	var eximLongDesc = '<div class="text-white">'+$("#courseDescriptionLong").html()+'</div>';
    $(eximLongDesc).insertAfter(".template-desc");
    var checkmydata ='<h4 class="trade-headercustom-title my-3">What you’ll learn</h4>';
    $(checkmydata).insertBefore('.template-desc');
    matomo();
}

function cooBreadcrumb(){
	$('title').html('Certificate of Origin');
	$('.template-title').html('Certificate of Origin');
	$('.template-desc').html('Certificate of Origin establishes the origin of products and provides duty and origin related benefits under various trade agreements. Trade Connect brings all CoO issuance on a single platform.');
	
	var bannerImg = 'https://content.trade.gov.in/module_icon/coo/banner/Certificate-of-Origin.webp';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function askAnExpertBreadcrumb(){
	$('title').html('TCP | Ask an Expert');
	$('.template-title').html('Ask an expert');
	$('.template-desc').html('Trade connect brings government institutions Indian mission abroad and a host of experts to answer queries of registered Indian entrepreneurs and exporters on international trade.');
	
	var bannerImg = 'https://content.trade.gov.in/module_icon/ask-an-expert/banner/Ask-an-expert.webp';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function tradeEventBreadcrumb(){
	$('title').html('Trade Event');
	$('.template-title').html('Trade Events Worldwide');
	$('.template-desc').html('Stay updated on upcoming trade events within India and internationally for your sector and products.');
	
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Trade_Events_Banner.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}
function ftaBreadcrumb(){
	$('title').html('Trade Agreements and Tariff Explorer');
	$('.template-title').html('Trade Agreements and Tariff Explorer');
	$('.template-desc').html('Explore opportunities created by agreements signed by India with various countries and country groups to expand and diversify trade.');
	
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Trade_Agreements_and_Tariff_Explorer.webp';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function eCommerceBreadcrumb(){
	$('title').html('ECommerce');
	$('.template-title').html('Global E-commerce Guide');
	$('.template-desc').html('Discover online marketplace to export your products to consumers around the world. Find the best markets and platforms for your products');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/exim_paathshaala.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function countryGuideBreadcrumb(){
	$('title').html('Country Guide');
	$('.template-title').html('Country Guide');
	$('.template-desc').html('Country guide brings in depth information on tariffs, standards and opportunities in key markets for Indian products.');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Country_guide_img.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}
	  
function HSNFinderBreadcrumb(){
	$('title').html('HSN Finder');
	$('.template-title').html('HSN Finder');
	$('.template-desc').html('Guide to identify HSN code applicable to your product in over 100 markets worldwide.');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Product_guide_img.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function qcoBreadcrumb(){
	$('title').html('Quality Control Orders');
	$('.template-title').html('Quality Control Orders');
	$('.template-desc').html('Quality Control Orders');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Product_guide_img.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function tradeAdvisoryBreadcrumb(){
	$('title').html('Trade Advisory and Trade Updates Management Module');
	$('.template-title').html('Trade Advisory and Trade Updates Management Module');
	$('.template-desc').html('Publish Trade Advisories and Trade Updates for consumption of Indian industry on Trade Connect ePlatform. Published advisories/updates will be available in the "Country Guide" service for public viewing.');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/Product_guide_img.png';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	matomo();
}

function eximPaathshaalaMngtBreadcrumb(){
	$('title').html('EXIM Paathshaala Management');
	$('.template-title').html('EXIM Paathshaala Management');
	var bannerImg = 'https://content.trade.gov.in/TCP_LANDING_PAGE_IMG/exim_paathshaala.webp';
	$('.template-head-section').css({background: "linear-gradient(124deg, rgba(21, 29, 76, 1), rgba(48, 50, 100, 1), rgba(170, 174, 199, .4)) fixed, url(" + bannerImg + ")"});
	$('.template-desc').html('Manage EXIM Paathshaala Categories and Courses here.');
	matomo();
}