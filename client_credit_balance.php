<?php
/**
 * WHMCS - Client Credit Manager
 * 
 * Adding a "Credit Manager" panel to the client area home page.
 * @version    1.1.1

 */

use WHMCS\View\Menu\Item as Item;

add_hook('ClientAreaHomepagePanels', 1, function (Item $homePagePanels) {
  $client = Menu::context( "client" );
  $clientid = intval( $client->id );
  if ($client->credit > 0) {
    $currencyData = getCurrency($clientid);
    $bodyhtml = '<p>'.sprintf(Lang::trans('availcreditbaldesc'),formatCurrency($client->credit, $currencyData)).'.</p>';
    $creditPanel = $homePagePanels->addChild( 'Credit Balance', array(
      'label' => Lang::trans('availcreditbal'),
      'icon' => 'fa-money-bill-alt',
      'order' => '100',
      'extras' => array(
        'color' => 'green',
        'btn-link' => 'clientarea.php?action=addfunds',
        'btn-text' => Lang::trans('addfunds'),
        'btn-icon' => 'fa-plus',
      ),
      'bodyHtml' => $bodyhtml
    ));
  }
});
