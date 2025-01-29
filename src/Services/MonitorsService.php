<?php 

namespace App\Services;

use App\Entity\Monitor;
use App\Model\MonitorNewDto;
use Doctrine\ORM\EntityManagerInterface;

class MonitorsService{

    public function __construct(private EntityManagerInterface $entityManager)
    {
        
    }

    public function getMonitors(): array
    {
        return $this->entityManager->getRepository(Monitor::class)->findAll();
    }

    public function crearMonitors(MonitorNewDto $monitorParam):Monitor{
        $monitor = new Monitor();
        $monitor->setName($monitorParam->getName());
        $monitor->setEmail($monitorParam->getEmail());
        $monitor->setPhone($monitorParam->getPhone());
        $monitor->setPhoto($monitorParam->getPhoto());
        $this->entityManager->persist($monitor);
        $this->entityManager->flush();
        return $monitor;
    }

}

?>