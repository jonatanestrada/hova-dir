<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sistema/class/Menu.class.php";
Menu::start(); //Inicia el menú
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/lib/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/lib/angular-material/angular-material.min.css">
    <link rel="stylesheet" href="/lib/md-data-table/dist/md-data-table-style.css">
    <link rel="stylesheet" href="/lib/SimpleGrid/simplegrid.css">
    <link rel="stylesheet" href="css/directorio.min.css">


    <title>Directorio corportativo</title>

    <script type="text/javascript" src="/lib/jquery-3.1.1.min.js"></script>

    <!-- Dependencias W/AngularJS -->
    <script type="text/javascript" src="/lib/angular/angular.min.js"></script>
    <script type="text/javascript" src="/lib/lodash/lodash.min.js"></script>
    <script type="text/javascript" src="/lib/angular-animate/angular-animate.min.js"></script>
    <script type="text/javascript" src="/lib/angular-aria/angular-aria.min.js"></script>
    <script type="text/javascript" src="/lib/angular-material/angular-material.min.js"></script>
    <script type="text/javascript" src="/lib/angular-material-icons/angular-material-icons.min.js"></script>
    <script type="text/javascript" src="/lib/angular-sanitize/angular-sanitize.min.js"></script>

    <script type="text/javascript" src="/lib/md-data-table/dist/md-data-table-templates.js"></script>
    <script type="text/javascript" src="/lib/md-data-table/dist/md-data-table.js"></script>


    <script type="text/javascript" src="js/directorio.db.js"></script>
    <script type="text/javascript" src="js/directorio.app.js"></script>
    <script type="text/javascript" src="js/directorio.controller.js"></script>

  </head>
  <body ng-app="Directorio" ng-controller="directorioController as ctrl">
    <div  class="grid containerCards" ng-cloak>
          <div class="col-1-1">
            <md-input-container style="margin:15px;" md-theme="forest">
                <label>Filter by search</label>
                <input type="text" ng-model="filterName">
            </md-input-container>
            <md-switch ng-model="theme_dark" ng-true-value="1" ng-false-value="0" class="md-warn">
              Dark: {{ theme_dark }}
            </md-switch>
          </div>
          <div class="col-1-1">




            <div class="card-miembro" ng-repeat="p in personal track by $index" ng-click="showMiembro($event)">
              <div class="contenido" ng-class="{'dark': theme_dark}">
              <!-- <div class="contenido dark"> -->

                <div class="menu-container">
                <md-menu md-position-mode="target-right target">
                  <md-button aria-label="Open phone interactions menu" class="md-icon-button" ng-click="ctrl.openMenu($mdOpenMenu, $event)">
                   <i class="fa fa-bars btn-menu" aria-hidden="true"></i>
                  </md-button>
                  <md-menu-content width="4">
                    <md-menu-item>
                      <md-button ng-click="ctrl.redial($event)">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        Redial
                      </md-button>
                    </md-menu-item>
                    <md-menu-item>
                      <md-button disabled="disabled" ng-click="ctrl.checkVoicemail()">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        Check voicemail
                      </md-button>
                    </md-menu-item>
                    <md-menu-divider></md-menu-divider>
                    <md-menu-item>
                      <md-button ng-click="ctrl.toggleNotifications()">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        {{ctrl.notificationsEnabled ? 'Disable' : 'Enable' }} notifications
                      </md-button>
                    </md-menu-item>
                  </md-menu-content>
                </md-menu>
                  </div>
                <div class="foto">
                  <!-- <img src="img/businessman.png" alt=""> -->
                  <img src="img/man.png" alt="" ng-if="p.miembro.nombre.slice(-1)[0] != 'a'">
                  <!-- <img src="img/man-2.png" alt=""> -->
                  <img src="img/social-1.png" alt="" ng-if="p.miembro.nombre.slice(-1)[0] == 'a'">

                  <!-- <img src="  http://octodex.github.com/images/octobiwan.jpg" alt=""> -->

                </div>
                <div class="info">
                  <span class="nombre">{{p.miembro.nombre}}   {{p.miembro.nombre_sec}} {{p.miembro.apaterno}}  {{p.miembro.amaterno}}</span><br>
                  <span class="puesto">{{p.nombre}}</span>
                  <!-- <img class="birthday-img" src="img/birthday-cake.png" alt=""> -->

                </div>
              </div>
            </div>

          </div>






      <!-- <md-tabs md-dynamic-height md-border-bottom>
        <md-tab label="two">
          <md-content >
            <mdt-table
                  animate-sort-icon="true"
                  selectable-rows="true"
                  paginated-rows="{isEnabled: true, rowsPerPageValues: [10,20,100]}"
                >
           <mdt-header-row>
             <mdt-column align-rule="left" column-sort="true">Nombre</mdt-column>
             <mdt-column align-rule="left" column-sort="true">Nombre Sec.</mdt-column>
             <mdt-column align-rule="left" column-sort="true">A.Paterno</mdt-column>
             <mdt-column align-rule="left" column-sort="true">A.Materno</mdt-column>
             <mdt-column align-rule="left" column-sort="true">Puesto</mdt-column>
             <mdt-column align-rule="center" column-sort="true">Activo</mdt-column>
           </mdt-header-row>
           <mdt-row ng-repeat="item in filteredItems">
              <mdt-cell>{{item.miembro.nombre}}</mdt-cell>
              <mdt-cell>{{item.miembro.nombre_sec}}</mdt-cell>
              <mdt-cell>{{item.miembro.apaterno}}</mdt-cell>
              <mdt-cell>{{item.miembro.amaterno}}</mdt-cell>
              <mdt-cell>{{item.nombre}}</mdt-cell>
              <mdt-cell>{{item.miembro.active}}</mdt-cell>
              <mdt-cell><md-checkbox ng-model="active" aria-label="active"></md-checkbox></mdt-cell>

            </mdt-row>
         </mdt-table>
          </md-content>
        </md-tab>
        <md-tab label="one">
          <md-content class="md-padding">
            <h1 class="md-display-2">Tab One</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis ante augue. Phasellus volutpat neque ac dui mattis vulputate. Etiam consequat aliquam cursus. In sodales pretium ultrices. Maecenas lectus est, sollicitudin consectetur felis nec, feugiat ultricies mi.</p>
          </md-content>
        </md-tab>
        <md-tab label="three">
          <md-content class="md-padding">
            <h1 class="md-display-2">Tab Three</h1>
            <p>Integer turpis erat, porttitor vitae mi faucibus, laoreet interdum tellus. Curabitur posuere molestie dictum. Morbi eget congue risus, quis rhoncus quam. Suspendisse vitae hendrerit erat, at posuere mi. Cras eu fermentum nunc. Sed id ante eu orci commodo volutpat non ac est. Praesent ligula diam, congue eu enim scelerisque, finibus commodo lectus.</p>
          </md-content>
        </md-tab>
      </md-tabs> -->




    <!-- <mdt-table paginated-rows="{isEnabled: true, rowsPerPageValues: [10,20,100]}"
          mdt-row="{
                     data: personal,
                     'column-keys': [
                         'miembro.nombre' + 'miembro.apaterno',
                         'nombre',
                         'miembro.nombre'
                     ]
                     }">
   <mdt-header-row>
     <mdt-column align-rule="left"
                 column-sort="true">Nombre</mdt-column>
     <mdt-column align-rule="right"
                 column-sort="true">Puesto</mdt-column>
     <mdt-column align-rule="center"
                 column-sort="true">Activo</mdt-column>
   </mdt-header-row>
 </mdt-table> -->


  </div>

  <div id="bigger-card">
    <div class="contenido_">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>
  </div>
  </body>
</html>
<?php
/**** Aquí va todo el contenido, recomendable usar include_once ****/
include_once $_SERVER['DOCUMENT_ROOT']."/dev/directorio/paginas/miembros.php";
Menu::end(); // Esto despues del contenido
?>
