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


    public function updateMonitor(MonitorNewDto $monitorAdd, int $id):Monitor{
        $monitor = $this->entityManager->getRepository(Monitor::class)->find($id);
        if($monitor){
            $monitor->setName($monitorAdd->getName());
            $monitor->setEmail($monitorAdd->getEmail());
            $monitor->setPhone($monitorAdd->getPhone());
            $monitor->setPhoto($monitorAdd->getPhoto());
            $this->entityManager->flush();
            return $monitor;
        }else{
            return ["message"=>"Monitor no encontrado"];
        }
    }

    public function deleteMonitor(int $id):string{
        $monitor = $this->entityManager->getRepository(Monitor::class)->find($id);
        if($monitor){
            $this->entityManager->remove($monitor);
            $this->entityManager->flush();
            return "Monitor eliminado";
        }else{
            return "Monitor no encontrado";
        }
    }

}

?>