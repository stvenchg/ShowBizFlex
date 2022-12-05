topbar.config({
    autoRun      : true, 
    barThickness : 3,
    barColors    : {
      '0'        : '#25aae1',
      '.3'       : '#4481eb',
      '1.0'      : '#04befe'
    },
    shadowBlur   : 5,
    shadowColor  : 'rgba(0, 0, 0, .5)',
    className    : 'topbar',
  })
  topbar.show();
  (function step() {
    setTimeout(function() {  
      if (topbar.progress('+.01') < 1) step()
    }, 16)
})()

$(window).ready(function () {
    topbar.hide();
});

$(window).bind('beforeunload',function(){
    topbar.show();
 });

 /*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/