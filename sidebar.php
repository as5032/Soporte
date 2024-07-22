<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="dropdown">
  <a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
      <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo strtoupper(substr($_SESSION['login_firstname'], 0,1).substr($_SESSION['login_middlename'], 0,1)) ?></span>
      <span class="brand-text font-weight-light"><?php echo ucwords(($_SESSION['login_firstname']).' '.($_SESSION['login_middlename'])) ?></span>

    </a>
    <div class="dropdown-menu" style="">
      <a class="dropdown-item manage_account" href="./index.php?page=datosStaff" > Administrar contraseña</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="ajax.php?action=logout">Salir</a>
    </div>
  </div>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item dropdown">
          <a href="./" class="nav-link nav-home">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Menu
            </p>
          </a>

        </li>
      <?php if($_SESSION['login_type'] == 1): ?>
        <li class="nav-item">
          <a href="#" class="nav-link nav-edit_customer">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Usuarios CJEF
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=listadoCJEFplus" class="nav-link nav-new_customer tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Listado</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="./index.php?page=listadoIPUsuarios" class="nav-link nav-new_customer tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>IP Usuarios</p>
              </a>
            </li>-->
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-edit_staff">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Sistemas
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=staffList" class="nav-link nav-new_staff tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Listado Sistemas</p>
              </a>
            </li>
          </ul>
        </li>
      <?php endif; ?>
        <li class="nav-item">
          <a href="#" class="nav-link nav-edit_ticket nav-view_ticket">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>
              Ticket
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=newTicketStaff" class="nav-link nav-new_ticket tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Agregar Ticket</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=newTicketStaffList" class="nav-link nav-ticket_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Listar Tickets</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link nav-edit_staff">
            <i class="nav-icon fas fa-tools"></i>
            <p>
              Herramientas
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <!--
            <li class="nav-item">
              <a href="./index.php?page=autoTextoListado" class="nav-link nav-new_staff tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Autotexto Listado</p>
              </a>
            </li>
          -->
            <li class="nav-item">
              <a href="./index.php?page=discoDuro" class="nav-link nav-new_staff tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Disco Duro 110</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link nav-edit_ticket nav-view_ticket">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Reportes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=reporteAcumulado" class="nav-link nav-new_ticket tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Acumulado</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reporteRangos" class="nav-link nav-ticket_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Rango de Fecha</p>
              </a>
            </li>
          </ul>
        </li>




      </ul>
    </nav>
  </div>
</aside>
<script>
  $(document).ready(function(){
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if($('.nav-link.nav-'+page).length > 0){
      $('.nav-link.nav-'+page).addClass('active')
        console.log($('.nav-link.nav-'+page).hasClass('tree-item'))
      if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
        $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
      }
    }

  })
</script>
