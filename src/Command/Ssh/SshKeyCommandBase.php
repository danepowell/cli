<?php

namespace Acquia\Cli\Command\Ssh;

use Acquia\Cli\Command\CommandBase;

/**
 * Class SshKeyCommandBase.
 */
abstract class SshKeyCommandBase extends CommandBase {

  /**
   * @return \Symfony\Component\Finder\SplFileInfo[]
   */
  protected function findLocalSshKeys(): array {
    $finder = $this->getApplication()->getContainer()->get('local_machine_helper')->getFinder();
    $finder->files()->in($this->getApplication()->getSshKeysDir())->name('*.pub')->ignoreUnreadableDirs();
    return iterator_to_array($finder);
  }

  /**
   * @param $label
   *
   * @return string|string[]|null
   */
  public static function normalizeSshKeyLabel($label) {
    // It may only contain letters, numbers and underscores,.
    $label = preg_replace('/[^A-Za-z0-9_]/', '', $label);

    return $label;
  }

}
