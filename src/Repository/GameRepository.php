<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 10/11/2018
 * Time: 15:50
 */

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class GameRepository
 *
 * @package App\Repository
 */
class GameRepository extends ServiceEntityRepository
{
    /**
     * TimerRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Game::class);
    }

    /**
     * @param Game $game
     */
    public function save(Game $game){
        $this->_em->persist($game);
        $this->_em->flush();
    }
}