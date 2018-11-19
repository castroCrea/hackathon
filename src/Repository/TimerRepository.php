<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 10/11/2018
 * Time: 15:50
 */

namespace App\Repository;

use App\Entity\Timer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TimerRepository
 *
 * @package App\Repository
 */
class TimerRepository extends ServiceEntityRepository
{
    /**
     * TimerRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Timer::class);
    }

    /**
     * @param Timer $timer
     */
    public function save(Timer $timer){
        $this->_em->persist($timer);
        $this->_em->flush();
    }
}