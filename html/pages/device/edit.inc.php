<?php

if ($_SESSION['userlevel'] < '7')
{
  print_error("Insufficient Privileges");
} else {

  $panes['device']   = 'Device Settings';
  $panes['snmp']     = 'SNMP';
  $panes['ports']    = 'Port Settings';
  $panes['apps']     = 'Applications';
  $panes['alerts']   = 'Alerts';

  if ($config['enable_services'])
  {
    $panes['services'] = 'Services';
  }

  $panes['ipmi']     = 'IPMI';

  print_optionbar_start();

  unset($sep);
  foreach ($panes as $type => $text)
  {
    if (!isset($_GET['opta'])) { $_GET['opta'] = $type; }
    echo($sep);
    if ($_GET['opta'] == $type)
    {
      echo("<span class='pagemenu-selected'>");
      #echo('<img src="images/icons/'.$type.'.png" class="optionicon" />');
    } else {
      #echo('<img src="images/icons/greyscale/'.$type.'.png" class="optionicon" />');
    }

    echo("<a href='device/".$device['device_id']."/edit/" . $type . ($_GET['optb'] ? "/" . $_GET['optb'] : ''). "/'> " . $text ."</a>");
    if ($_GET['opta'] == $type) { echo("</span>"); }
    $sep = " | ";
  }

  print_optionbar_end();

  if (is_file("pages/device/edit/".mres($_GET['opta']).".inc.php"))
  {
    include("pages/device/edit/".mres($_GET['opta']).".inc.php");
  }
}

?>
