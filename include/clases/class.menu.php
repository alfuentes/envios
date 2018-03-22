<?php

class Menu
{
    // variables Usuario
    private $home ="Home";
    private $customer ="Clientes";
    private $transport ="Transportes";
    private $pilot ="Pilotos";
    private $salesman ="Vendedores";
    private $send ="Generar Envío";
    private $report ="Reportes";
    private $note1 ="Reportes";
    private $note2 ="Reporte de Envíos";
    private $note3 ="Envios Entregados - Delivery";
    private $note4 ="Envios No Entregados - No Delivery";
    private $exit ="Salir de Sistema";
    private $about ="Acerca de";
    private $users ="Usuarios";

    // variables Administrador
    private $homeAdmin ="Home";
    private $customerAdmin ="Clientes";
    private $transportAdmin ="Transportes";
    private $pilotAdmin ="Pilotos";
    private $salesmanAdmin = "Vendedores";
    private $reportAdmin ="Reportes";
    private $reportSendAdminFC ="Reporte Envios Cliente Final";
    private $reportSendAdminDS ="Reporte Envios Distribucion";

    //reportes
    private $reportCustomer="Reporte Clientes";
    private $reportTransport="Reporte Transportes";
    private $reportSendFC="Reporte Envíos Cliente Final";
    private $reportSendDS="Reporte Envíos Distribución";
    private $reportNoDeliveryDS="Reporte Envios No Entregados Distribucion";
    private $reportNoDeliveryCF="Reporte Envios No Entregados Cliente Final";
    private $reportDeliveryDS="Reporte Envios Entregados Distribucion";
    private $reportDeliveryCF="Reporte Envios Entregados Cliente Final";

    //paths
    private $pathHome ="index.php";
    private $pathCustomer ="clientes.php";
    private $pathTransport ="transportes.php";
    private $pathPilot ="pilotos.php";
    private $pathSalesman ="vendedores.php";
    private $pathSend ="envios.php";
    private $pathReportCustomer ="reporte-clientes.php";
    private $pathReportTransport ="reporte-transportes.php";
    private $pathReportSend ="reporte-envios.php";
    private $pathFC ="?accion=cliente-final";
    private $pathDS ="?accion=distribucion";
    private $pathDeliveryCF ="?delivery=cliente-final";
    private $pathDeliveryDS ="?delivery=distribucion";
    private $pathNoDeliveryCF ="?noDelivery=cliente-final";
    private $pathNoDeliveryDS ="?noDelivery=distribucion";
    private $pathExit ="../salir.php";
    private $pathAbout ="acerca.php";
    private $pathUsers ="usuarios.php";

    public function getCustomer(){
      return $this->customer;
    }

    public function getTransport(){
      return $this->transport;
    }

    public function getPilot(){
      return $this->pilot;
    }

    public function getSalesman(){
      return $this->salesman;
    }

    public function getSend(){
      return $this->send;
    }

    public function printMenuView($directory,$index){
        ?>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if($index==1){ echo "class='active'";  }?>><a href="<?php echo $this->pathHome; ?>"><?php echo $this->home;?> </a></li>
            <li <?php if($index==2){ echo "class='active'";  }?>><a href="<?php echo $this->pathCustomer; ?>"><?php echo $this->customer;?> </a></li>
            <li <?php if($index==3){ echo "class='active'";  }?>><a href="<?php echo $this->pathTransport; ?>"><?php echo $this->transport;?> </a></li>
            <li <?php if($index==4){ echo "class='active'";  }?>><a href="<?php echo $this->pathPilot; ?>"><?php echo $this->pilot;?> </a></li>
            <li <?php if($index==5){ echo "class='active'";  }?>><a href="<?php echo $this->pathSalesman; ?>"><?php echo $this->salesman;?> </a></li>
            <li <?php if($index==6){ echo "class='active'";  }?>><a href="<?php echo $this->pathSend; ?>"><?php echo $this->send;?> </a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->report; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header"><?php echo $this->note1;?></li>
                <li><a href="<?php echo $this->pathReportCustomer;?>"><?php echo $this->reportCustomer;?></a></li>
                <li><a href="<?php echo $this->pathReportTransport;?>"><?php echo $this->reportTransport;?></a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header"><?php echo $this->note2;?></li>
                <li><a href="<?php echo $this->pathReportSend.$this->pathFC;?>"><?php echo $this->reportSendFC;?></a></li>
                <li><a href="<?php echo $this->pathReportSend.$this->pathDS;?>"><?php echo $this->reportSendDS;?></a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header"><?php echo $this->note3;?></li>
                <li><a href="<?php echo $this->pathReportSend.$this->pathDeliveryCF;?>"><?php echo $this->reportDeliveryCF;?></a></li>
                <li><a href="<?php echo $this->pathReportSend.$this->pathDeliveryDS;?>"><?php echo $this->reportDeliveryDS;?></a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header"><?php echo $this->note4;?></li>
                <li><a href="<?php echo $this->pathReportSend.$this->pathNoDeliveryCF;?>"><?php echo $this->reportNoDeliveryCF;?></a></li>
                <li><a href="<?php echo $this->pathReportSend.$this->pathNoDeliveryDS;?>"><?php echo $this->reportNoDeliveryDS;?></a></li>
              </ul>
            </li>
            <li <?php if($index==8){ echo "class='active'";  }?>><a href="<?php echo $this->pathAbout; ?>"><?php echo $this->about;?> </a></li>
            <li <?php if($index==9){ echo "class='active'";  }?>><a href="<?php echo $this->pathExit; ?>"><?php echo $this->exit;?> </a></li>

          </ul>
        </div><!-- fin navegacion -->
        <?php
    }

    public function toggleNavigation(){
      ?>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      <?php
    }

    public function printMenuViewAdmin($directory,$index){
      ?>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php if($index==1){ echo "class='active'";  }?>><a href="<?php echo $this->pathHome; ?>"><?php echo $this->home;?> </a></li>
          <li <?php if($index==2){ echo "class='active'";  }?>><a href="<?php echo $this->pathCustomer; ?>"><?php echo $this->customer;?> </a></li>
          <li <?php if($index==3){ echo "class='active'";  }?>><a href="<?php echo $this->pathTransport; ?>"><?php echo $this->transport;?> </a></li>
          <li <?php if($index==4){ echo "class='active'";  }?>><a href="<?php echo $this->pathPilot; ?>"><?php echo $this->pilot;?> </a></li>
          <li <?php if($index==5){ echo "class='active'";  }?>><a href="<?php echo $this->pathSalesman; ?>"><?php echo $this->salesman;?> </a></li>
          <li <?php if($index==6){ echo "class='active'";  }?>><a href="<?php echo $this->pathUsers; ?>"><?php echo $this->users;?> </a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->report; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header"><?php echo $this->note2;?></li>
              <li><a href="<?php echo $this->pathReportSend.$this->pathFC;?>"><?php echo $this->reportSendFC;?></a></li>
              <li><a href="<?php echo $this->pathReportSend.$this->pathDS;?>"><?php echo $this->reportSendDS;?></a></li>
            </ul>
          </li>
          <li <?php if($index==7){ echo "class='active'";  }?>><a href="<?php echo $this->pathAbout; ?>"><?php echo $this->about;?> </a></li>
          <li <?php if($index==8){ echo "class='active'";  }?>><a href="<?php echo $this->pathExit; ?>"><?php echo $this->exit;?> </a></li>

        </ul>
      </div><!-- fin navegacion -->
      <?php
    }

}

?>
