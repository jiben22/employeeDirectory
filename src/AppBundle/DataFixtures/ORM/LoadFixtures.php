<?php
// src/DataFixtures/AppFixtures.php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Employee;
use AppBundle\Entity\Environment;
use AppBundle\Entity\Skill;
//use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 3874; $i++) {
            $employee = new Employee();
            $employee->setLastname('Lastname');
            $employee->setFirstname('Firstname');
            $employee->setAge(mt_rand(10, 100));
            $employee->setJob('Job');
            $employee->setPhone('0678549587');
            $employee->setDateDebut(new \Datetime('01/01/2013'));
            $employee->setDateFin(new \Datetime('01/01/2020'));

            $environment = new Environment();
            $environment->setBuilding('Building');
            $environment->setPostalCode(22000);
            $environment->setDeskroom('Deskroom');

            $employee->setEnvironment($environment);

            $skill1 = new Skill();
            $skill1->setDenomination('Symfony');

            $skill2 = new Skill();
            $skill2->setDenomination('Doctrine');

            $employee->addSkill($skill1);
            $employee->addSkill($skill2);
            
            $manager->persist($skill1);
            $manager->persist($skill2);

            $manager->persist($environment);
            $manager->persist($employee);
        }

        $manager->flush();
    }
}
