directorio.controller('directorioController', ['$scope', '$http','$mdDialog', function($scope, $http,$mdDialog){
  $scope.test = "asd";
  $scope.personal = BDdirectorio.result;
  $scope.getArreglo = function(size){
      return new Array(size);
  }
  console.log($scope.personal);
  // $http.get("js/data.json").then(function(res){
  //   console.log(res);
  // });
  jQuery.fn.center = function () {
      this.css("position","absolute");
      this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +   $(window).scrollTop()) + "px");
      this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +   $(window).scrollLeft()) + "px");
      return this;
  }

  var calculateCenterScreen = function(){
    return {
      top: Math.max(0, (($(window).height() - $("#bigger-card").outerHeight()) / 2) +   $(window).scrollTop()),
      left: Math.max(0, (($(window).width() - $("#bigger-card").outerWidth()) / 2) +   $(window).scrollLeft())
    }
  }

  $scope.showMiembro = function($event){
    // console.log($event);
    objPos = $($event.target).offset();


    $container = $("#bigger-card");
    // $($container).center();
    var centerScreen = calculateCenterScreen();
    $container.css({
      top: (objPos.top - 300),
      left: (objPos.left - 250),
      // height: 0,
      // width: 0,
      padding: "300px"
    });
    $container.animate({
        opacity: 1,
        padding: "0px",
        left: centerScreen.left,
        top: centerScreen.top
        // width: "600px",
        // height: "400px",
      }, {
            duration: 400
      });
    // $container.left(objPos.left);
    // $container.top(objPos.top);
    console.log(objPos);
  }





  // Create list of font-icon names with color overrides
    var iconData = [
          {name: 'icon-home'        , color: "#777" },
          {name: 'icon-user-plus'   , color: "rgb(89, 226, 168)" },
          {name: 'icon-google-plus2', color: "#A00" },
          {name: 'icon-youtube4'    , color:"#00A" },
           // Use theming to color the font-icon
          {name: 'icon-settings'    , color:"#A00", theme:"md-warn md-hue-5"}
        ];

    // Create a set of sizes...
    $scope.sizes = [
      {size:48,padding:10},
      {size:36,padding:6},
      {size:24,padding:2},
      {size:12,padding:0}
    ];

    $scope.fonts = [].concat(iconData);
    $scope.selectedRowCallback = function(rows){
           $mdToast.show(
               $mdToast.simple()
                   .content('Selected row id(s): '+rows)
                   .hideDelay(3000)
           );
       };


       var originatorEv;

       this.openMenu = function($mdOpenMenu, ev) {
         console.log("Open menu");
         originatorEv = ev;
         $mdOpenMenu(ev);
       };

       this.notificationsEnabled = true;
       this.toggleNotifications = function() {
         this.notificationsEnabled = !this.notificationsEnabled;
       };

       this.redial = function() {
         $mdDialog.show(
           $mdDialog.alert()
             .targetEvent(originatorEv)
             .clickOutsideToClose(true)
             .parent('body')
             .title('Suddenly, a redial')
             .textContent('You just called a friend; who told you the most amazing story. Have a cookie!')
             .ok('That was easy')
         );

         originatorEv = null;
       };

       this.checkVoicemail = function() {
         // This never happens.
       };




}]);
directorio.config(function($mdThemingProvider){
   // Update the theme colors to use themes on font-icons
   $mdThemingProvider.theme('default')
         .primaryPalette("red")
         .accentPalette('indigo')
         .warnPalette('blue');
 });
