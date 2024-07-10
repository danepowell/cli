<?php

declare(strict_types=1);

namespace Acquia\Cli\Command\Acsf;

use Acquia\Cli\AcsfApi\AcsfClientService;
use Acquia\Cli\AcsfApi\AcsfCredentials;
use Acquia\Cli\Command\Api\ApiBaseCommand;
use Acquia\Cli\CommandFactoryInterface;
use Acquia\Cli\DataStore\AcquiaCliDatastore;
use Acquia\Cli\DataStore\CloudDataStore;
use Acquia\Cli\Helpers\LocalMachineHelper;
use Acquia\Cli\Helpers\SshHelper;
use Acquia\Cli\Helpers\TelemetryHelper;
use Psr\Log\LoggerInterface;

class AcsfCommandFactory implements CommandFactoryInterface
{
    public function __construct(
        private LocalMachineHelper $localMachineHelper,
        private CloudDataStore $datastoreCloud,
        private AcquiaCliDatastore $datastoreAcli,
        private AcsfCredentials $cloudCredentials,
        private TelemetryHelper $telemetryHelper,
        private string $projectDir,
        private AcsfClientService $cloudApiClientService,
        private SshHelper $sshHelper,
        private string $sshDir,
        private LoggerInterface $logger,
    ) {
    }

    public function createCommand(): ApiBaseCommand
    {
        return new ApiBaseCommand(
            $this->localMachineHelper,
            $this->datastoreCloud,
            $this->datastoreAcli,
            $this->cloudCredentials,
            $this->telemetryHelper,
            $this->projectDir,
            $this->cloudApiClientService,
            $this->sshHelper,
            $this->sshDir,
            $this->logger,
        );
    }

    public function createListCommand(): AcsfListCommand
    {
        return new AcsfListCommand(
            $this->localMachineHelper,
            $this->datastoreCloud,
            $this->datastoreAcli,
            $this->cloudCredentials,
            $this->telemetryHelper,
            $this->projectDir,
            $this->cloudApiClientService,
            $this->sshHelper,
            $this->sshDir,
            $this->logger,
        );
    }
}
