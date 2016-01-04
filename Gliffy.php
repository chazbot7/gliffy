<?php
$wgExtensionCredits['parserhook'][] = array(
  'name'         => 'Gliffy',
  'version'      => '1.0',
  'author'       => 'Nick Townsend', 
  'url'          => 'http://www.mediawiki.org/wiki/Extension:Gliffy',
  'description'  => 'Render public Gliffy diagrams'
);
 
if ( defined( 'MW_SUPPORTS_PARSERFIRSTCALLINIT' ) ) {
  $wgHooks['ParserFirstCallInit'][] = 'gliffySetup';
} else {
  $wgExtensionFunctions[] = 'gliffySetup';
}
 
function gliffySetup() {
  global $wgParser;
  $wgParser->setHook( 'gliffy', 'gliffyRender' );
  return true;
}
 
function gliffyRender( $input, $args, $parser) {
  $parser->disableCache();

  if( isset( $args['did'] ) ) {
    $did= $args['did'];
    $html = <<<HTML
<script src="/extensions/Gliffy/embedGliffy.js" type="text/javascript"></script>
<script type="text/javascript"> embedGliffy('$did'); </script>
<br>
<a href="https://www.gliffy.com/go/html5/$did" target="_blank"><img class="gliffyDiagram" src="/extensions/Gliffy/gliffy.gif" width="100px" style="margin:0;" align="left" /></a>
<br>
HTML;
  }
  else
    $html = "<b>Gliffy drawing ID (did) not supplied</b>";

  return array( $html, "markerType" => 'nowiki' );
 
}
// vim: set ts=8 sw=2 sts=2:
?>
