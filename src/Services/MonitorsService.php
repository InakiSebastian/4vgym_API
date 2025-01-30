<?php 

namespace App\Services;

use App\Entity\Monitor;
use App\Model\MonitorDTO;
use App\Model\MonitorNewDto;
use Doctrine\ORM\EntityManagerInterface;

class MonitorsService{

    public function __construct(private EntityManagerInterface $entityManager)
    {
        
    }

    public function getMonitors(): array
    {
        $list =  $this->entityManager->getRepository(Monitor::class)->findAll();

        $monitorLIst = [];

        foreach($list as $monitor){
            $monitorDTO = new MonitorDTO($monitor->getId(),$monitor->getName(),$monitor->getEmail(),$monitor->getPhone(),$monitor->getPhoto());
            $monitorLIst[] = $monitorDTO;
        }

        return $monitorLIst;
    }

    public function createMonitor(MonitorNewDto $monitorParam):MonitorDTO{
        $monitor = new Monitor();
        $monitor->setName($monitorParam->getName());
        $monitor->setEmail($monitorParam->getEmail());
        $monitor->setPhone($monitorParam->getPhone());
        $monitor->setPhoto($monitorParam->getPhoto());
        $this->entityManager->persist($monitor);
        $this->entityManager->flush();
        
        $monitorDTO = new MonitorDTO($monitor->getId(),$monitor->getName(),$monitor->getEmail(),$monitor->getPhone(),$monitor->getPhoto());

        return $monitorDTO;
    }


    public function updateMonitor(MonitorNewDto $monitorAdd, int $id):MonitorDTO{
        $monitor = $this->entityManager->getRepository(Monitor::class)->find($id);
        if($monitor){
            $monitor->setName($monitorAdd->getName());
            $monitor->setEmail($monitorAdd->getEmail());
            $monitor->setPhone($monitorAdd->getPhone());
            $monitor->setPhoto($monitorAdd->getPhoto());
            $this->entityManager->flush();

            $monitorDTO = new MonitorDTO($monitor->getId(),$monitor->getName(),$monitor->getEmail(),$monitor->getPhone(),$monitor->getPhoto());
            return $monitorDTO;
        }else{
            return null;
        }
    }

    public function deleteMonitor(int $id):bool{
        $monitor = $this->entityManager->getRepository(Monitor::class)->find($id);
        if($monitor){
            $this->entityManager->remove($monitor);
            $this->entityManager->flush();
            return true;
        }else{
            return false;;
        }
    }

}

?>