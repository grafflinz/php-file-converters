<?php
namespace Witti\FileConverter\Engine\Optimize;

use Witti\FileConverter\Engine\EngineBase;
use Witti\FileConverter\Util\Shell;
class JpegOptim extends EngineBase {
  protected $cmd_options = array(
    array(
      'name' => 'quiet',
      'mode' => Shell::SHELL_ARG_BOOL_DBL,
      'default' => FALSE,
    ),
    array(
      'name' => 'strip-all',
      'mode' => Shell::SHELL_ARG_BOOL_DBL,
      'default' => FALSE,
    ),
  );

  public function getConvertFileShell($source, &$destination) {
    $destination = $source;
    return array(
      $this->cmd,
      Shell::argOptions($this->cmd_options, $this->configuration, NULL),
      $source,
    );
  }

  public function getHelpInstallation($os, $os_version) {
    $output = "JpegOptim is maintained at http://freecode.com/projects/jpegoptim\n";
    switch ($os) {
      case 'Ubuntu':
        $output .= " Ubuntu (12.04)\n";
        $output .= "  sudo apt-get install jpegoptim\n";
        return $output;
    }

    return $output .= parent::getHelpInstallation();
  }

  public function isAvailable() {
    $this->cmd = $this->shellWhich('jpegoptim');
    return isset($this->cmd);
  }
}